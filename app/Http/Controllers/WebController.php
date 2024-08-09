<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;

class WebController extends Controller
{
    public function __construct()
    {
        $this->WebModel = new WebModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Pemetaan',
            'sekolah' => $this->WebModel->AllDataSekolah(),
        ];
        return view('web', $data);
    }

    public function detailsekolah($id_sekolah)
    {

        $sekolah = $this->WebModel->DetailDataSekolah($id_sekolah);
        $data = [
            'title' => 'Detail' . $sekolah->nama_sekolah,
            'sekolah' => $sekolah,
        ];
        return view('detailsekolah', $data);
    }

}
