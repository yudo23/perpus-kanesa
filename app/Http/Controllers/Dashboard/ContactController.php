<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        $this->route = "dashboard.contacts.";
        $this->view = "dashboard.contacts.";
        $this->contactService = new ContactService();
    }

    public function index(Request $request)
    {
        $response = $this->contactService->index($request);
        $response = $response->data;

        $data = [
            'table' => $response,
        ];

        return view($this->view . 'index', $data);
    }

    public function show($id)
    {
        $result = $this->contactService->show($id);
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
}
