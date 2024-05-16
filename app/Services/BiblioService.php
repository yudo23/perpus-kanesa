<?php

namespace App\Services;

use App\Helpers\UploadHelper;
use App\Http\Requests\Biblio\UpdateSynopsisRequest;
use App\Services\BaseService;
use App\Models\Biblio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Log;
use Auth;

class BiblioService extends BaseService
{
    protected $biblio;

    public function __construct()
    {
        $this->biblio = new Biblio();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));
        $publisher_id = (empty($request->publisher_id)) ? null : trim(strip_tags($request->publisher_id));

        $table = $this->biblio;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('title', 'like', '%' . $search . '%');
            });
        }
        if(!empty($publisher_id)){
            $table = $table->where("publisher_id",$publisher_id);
        }
        $table = $table->with(['publisher','items']);
        $table = $table->orderBy('input_date', 'DESC');

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
            $result = $this->biblio;
            $result = $result->where("biblio_id",$id);
            $result = $result->with(['publisher','items']);
            $result = $result->first();

            if(!$result){
                return $this->response(false, "Data tidak ditemukan");
            }

            return $this->response(true, 'Berhasil mendapatkan data', $result);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateSynopsis(UpdateSynopsisRequest $request, $id)
    {
        try {
            $synopsis_url = (empty($request->synopsis_url)) ? null : trim(strip_tags($request->synopsis_url));

            $result = $this->biblio;
            $result = $result->where('biblio_id',$id);
            $result = $result->first();

            if(!$result){
                return $this->response(false, "Data tidak ditemukan");
            }

            $result->update([
                'synopsis_url' => $synopsis_url,
            ]);

            return $this->response(true, 'Berhasil mengubah data',$result);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
