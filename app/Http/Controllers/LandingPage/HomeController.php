<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $route;
    protected $view;

    public function __construct()
    {
        $this->route = "landing-page.home.";
        $this->view = "landing-page.home.";
    }

    public function index(Request $request){
        return view($this->view."index");
    }
}
