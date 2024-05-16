<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\Contact\StoreRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

class ContactService extends BaseService
{
    protected $contact;

    public function __construct()
    {
        $this->contact = new Contact();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $table = $this->contact;
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
            $result = $this->contact;
            $result = $result->where("id",$id);
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

    public function store(StoreRequest $request)
    {
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $email = (empty($request->email)) ? null : trim(strip_tags($request->email));
            $phone = (empty($request->phone)) ? null : trim(strip_tags($request->phone));
            $subject = (empty($request->subject)) ? null : trim(strip_tags($request->subject));
            $message = (empty($request->message)) ? null : trim(strip_tags($request->message));

            $create = $this->contact->create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject,
                'message' => $message,
            ]);

            return $this->response(true, 'Pesan berhasil dikirimkan',$create);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
