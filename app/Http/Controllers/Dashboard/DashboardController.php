<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = "dashboard.dashboard";
    }

    public function index(Request $request){
        return view($this->view);
    }
}
