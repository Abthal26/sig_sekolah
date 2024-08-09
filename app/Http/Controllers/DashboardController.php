<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
          //$this->middleware('auth');
         // $this->SekolahModel = new SekolahModel();

    }

    public function index()
    {
        $data = ['title' => 'Dashboard',];
        return view('dashboard', $data);
    }
}
