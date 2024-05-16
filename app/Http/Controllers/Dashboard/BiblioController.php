<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biblio\UpdateSynopsisRequest;
use Illuminate\Http\Request;
use App\Services\BiblioService;
use App\Services\PublisherService;
use Illuminate\Http\Response;
use Log;
use PDF;

class BiblioController extends Controller
{
    protected $route;
    protected $view;
    protected $biblioService;
    protected $publisherService;

    public function __construct()
    {
        $this->route = "dashboard.biblios.";
        $this->view = "dashboard.biblios.";
        $this->biblioService = new BiblioService();
        $this->publisherService = new PublisherService();
    }

    public function index(Request $request)
    {
        $response = $this->biblioService->index($request);
        $response = $response->data;

        $publishers = $this->publisherService->index($request,false);
        $publishers = $publishers->data;

        $data = [
            'table' => $response,
            'publishers' => $publishers
        ];

        return view($this->view . 'index', $data);
    }

    public function show($id)
    {
        $result = $this->biblioService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $data = [
            'result' => $result
        ];

        return view($this->view . "show", $data);
    }

    public function qrcode($id)
    {
        $result = $this->biblioService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $data = [
            'result' => $result
        ];

        return view($this->view . "qrcode", $data);
    }

    public function updateSynopsis(UpdateSynopsisRequest $request, $id)
    {
        try {
            $response = $this->biblioService->updateSynopsis($request, $id);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, null, $response->code);
            }
            
            return ResponseHelper::apiResponse(true, $response->message , $response->data , null, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function exportPDF(Request $request)
    {
        $table = $this->biblioService->index($request,false);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $table = $table->data;

        $data = [
            'table' => $table
        ];

        $pdf = PDF::loadview($this->view . 'print-pdf', $data)->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
