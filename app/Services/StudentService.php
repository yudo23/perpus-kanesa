<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Services\BaseService;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Helpers\UploadHelper;
use App\Enums\ImageEnum;
use App\Http\Requests\Student\ImportRequest;
use App\Jobs\StudentImportJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use DB;
use Illuminate\Http\Response;
use Throwable;

class StudentService extends BaseService
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
        if(count($column) >= 1){
            $table = $table->select($column);
        }
        $table = $table->role(RoleEnum::STUDENT);
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
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $study_program = (!isset($request->study_program)) ? null : trim(strip_tags($request->study_program));
            $offering = (!isset($request->offering)) ? null : trim(strip_tags($request->offering));
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
                'study_program' => $study_program,
                'offering' => $offering,
            ]);

            $create->assignRole(RoleEnum::STUDENT);

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
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $study_program = (!isset($request->study_program)) ? null : trim(strip_tags($request->study_program));
            $offering = (!isset($request->offering)) ? null : trim(strip_tags($request->offering));
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
                'study_program' => $study_program,
                'offering' => $offering,
            ]);

            $result->syncRoles(RoleEnum::STUDENT);

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

    public function importExcel(ImportRequest $request)
    {
        try {
            $file = $request->file('file');

            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->storeAs('public/import/students', $filename);

            StudentImportJob::dispatch($filename, Auth::user());

            return $this->response(true, 'Import data telah selesai');
        } catch (Throwable $e) {
            Log::emergency($e->getMessage());

            return $this->response(false, $e->getMessage());
        }
    }
}
