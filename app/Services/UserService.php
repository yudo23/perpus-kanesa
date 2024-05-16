<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Services\BaseService;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Helpers\UploadHelper;
use App\Enums\ImageEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use DB;
use Illuminate\Http\Response;
use Throwable;

class UserService extends BaseService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(Request $request, bool $paginate = true,array $column = [])
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));
        $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
        $roles = (empty($request->roles)) ? null : trim(strip_tags($request->roles));

        if(!$roles){
            $roles = [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR];
        }

        $table = $this->user;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
                $query2->orWhere('username', 'like', '%' . $search . '%');
            });
        }
        if($status){
            $table = $table->where("status",$status);
        }
        $table = $table->role($roles);
        
        if(count($column) >= 1){
            $table = $table->select($column);
        }
        $table = $table->orderBy('created_at', 'DESC');

        if ($paginate) {
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->get();
        }

        return $this->response(true, 'Berhasil mendapatkan data', $table);
    }

    public function show($id)
    {
        try {
            $result = $this->user;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                return $this->response(false, "Data tidak ditemukan");
            }

            return $this->response(true, 'Berhasil mendapatkan data', $result);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $username = (empty($request->username)) ? null : trim(strip_tags($request->username));
            $password = (empty($request->password)) ? null : trim(strip_tags($request->password));
            $roles = (empty($request->roles)) ? null : trim(strip_tags($request->roles));
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $avatar = $request->file("avatar");

            if ($avatar) {
                $upload = UploadHelper::upload_file($avatar, 'users', ImageEnum::EXT, 2097152, true, true, 500, null, true);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $avatar = $upload["Path"];
            }

            $create = $this->user->create([
                'name' => $name,
                'username' => $username,
                'password' => bcrypt($password),
                'avatar' => $avatar,
                'status' => $status,
            ]);

            $create->assignRole($roles);

            DB::commit();

            return $this->response(true, 'Berhasil menambahkan data',$create);
        } catch (Throwable $th) {
            DB::rollback();
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $username = (empty($request->username)) ? null : trim(strip_tags($request->username));
            $password = (empty($request->password)) ? null : trim(strip_tags($request->password));
            $roles = (empty($request->roles)) ? null : trim(strip_tags($request->roles));
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $avatar = $request->file("avatar");

            $result = $this->user;
            $result = $result->findOrFail($id);

            if ($password) {
                $password = bcrypt($password);
            } else {
                $password = $result->password;
            }

            if ($avatar) {
                $upload = UploadHelper::upload_file($avatar, 'users', ImageEnum::EXT, 2097152, true, true, 500, null, true);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $avatar = $upload["Path"];
            } else {
                $avatar = $result->avatar;
            }

            $result->update([
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'avatar' => $avatar,
                'status' => $status,
            ]);

            $result->syncRoles($roles);

            DB::commit();

            return $this->response(true, 'Berhasil mengubah data',$result);
        } catch (Throwable $th) {
            DB::rollback();;
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->user->findOrFail($id);
            $result->delete();

            return $this->response(true, 'Berhasil menghapus data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
