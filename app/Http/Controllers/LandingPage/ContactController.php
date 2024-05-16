<?php

namespace App\Http\Controllers\LandingPage;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreRequest;
use Illuminate\Http\Request;
use App\Services\ContactService;
use Illuminate\Http\Response;
use Log;
use PDF;

class ContactController extends Controller
{
    protected $route;
    protected $view;
    protected $contactService;

    public function __construct()
    {
        $this->route = "landing-page.contacts.";
        $this->view = "landing-page.contacts.";
        $this->contactService = new ContactService();
    }

    public function index(Request $request){
        return view($this->view."index");
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->contactService->store($request);
            if (!$response->success) {
                alert()->error('Gagal', $response->message);
                return redirect()->route($this->route . 'index')->withInput();
            }

            alert()->html('Berhasil', $response->message, 'success');
            return redirect()->route($this->route . 'index');
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            alert()->error('Gagal', $th->getMessage());
            return redirect()->route($this->route . 'index')->withInput();
        }
    }
}
