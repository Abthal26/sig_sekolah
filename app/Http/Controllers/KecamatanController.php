<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Kecamatan',];
        return view('admin.kecamatan/index',$data);
    }
}
