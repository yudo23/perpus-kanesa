<?php

namespace App\Services;

use App\Helpers\UploadHelper;
use App\Services\BaseService;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Log;
use Auth;

class PublisherService extends BaseService
{
    protected $publisher;

    public function __construct()
    {
        $this->publisher = new Publisher();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

        $table = $this->publisher;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('publisher_name', 'like', '%' . $search . '%');
            });
        }
        $table = $table->orderBy('publisher_name', 'ASC');

        if ($paginate) {
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->get();
        }

        return $this->response(true, 'Berhasil mendapatkan data', $table);
    }
}
