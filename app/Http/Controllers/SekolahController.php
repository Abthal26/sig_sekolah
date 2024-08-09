<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SekolahModel;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->SekolahModel = new SekolahModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Sekolah',
            'sekolah' => $this->SekolahModel->AllData(),
        ];

        return view('admin.sekolah/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Data Sekolah',
        ];

        return view('admin.sekolah/add', $data);
    }

    public function insert()
    {
        Request()->validate(
            [
                'nama_sekolah' => 'required',
                'alamat' => 'required',
                'kecamatan' => 'required',
                'posisi' => 'required',
                'foto' => 'required|max:1024',
            ],
            [
                'nama_sekolah.required' => 'Wajib di isi',
                'alamat.required' => 'Wajib di isi',
                'kecamatan.required' => 'Wajib di',
                'posisi.required' => 'Wajib di',
                'foto.required' => 'Wajib di',
                'foto.max' => 'Foto max 1024kb',
            ],
        );
        //jika validasi tidak ada
        $file = Request()->foto;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('foto'), $filename);
        $data = [
            'nama_sekolah' => Request()->nama_sekolah,
            'alamat' => Request()->alamat,
            'kecamatan' => Request()->kecamatan,
            'posisi' => Request()->posisi,
            'foto' => $filename,
        ];

        $this->SekolahModel->InsertData($data);
        return redirect()->route('sekolah')->with('pesan', 'Data berhasil di input');
    }

    public function edit($id_sekolah)
    {
        $data = [
            'title' => 'Edit Data Sekolah',
            'sekolah' => $this->SekolahModel->DetailData($id_sekolah),
        ];

        return view('admin.sekolah/edit', $data);
    }

    public function update($id_sekolah)
    {
        Request()->validate(
            [
                'nama_sekolah' => 'required',
                'alamat' => 'required',
                'kecamatan' => 'required',
                'posisi' => 'required',
                'foto' => 'max:1024',
            ],
            [
                'nama_sekolah.required' => 'Wajib di isi',
                'alamat.required' => 'Wajib di isi',
                'kecamatan.required' => 'Wajib di',
                'posisi.required' => 'Wajib di',
                'foto.max' => 'Foto max 1024kb',
            ],
        );
        //jika validasi tidak ada
        if (Request()->foto <> "") {
            $sekolah = $this->SekolahModel->DetailData($id_sekolah);
            if ($sekolah->foto <> "") {
                unlink(public_path('foto') . '/' . $sekolah->foto);
            }
            $file = Request()->foto;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);

            $data = [
                'nama_sekolah' => Request()->nama_sekolah,
                'alamat' => Request()->alamat,
                'kecamatan' => Request()->kecamatan,
                'posisi' => Request()->posisi,
                'foto' => $filename,
            ];
            $this->SekolahModel->UpdateData($id_sekolah, $data);
        } else {
            $data = [
                'nama_sekolah' => Request()->nama_sekolah,
                'alamat' => Request()->alamat,
                'kecamatan' => Request()->kecamatan,
                'posisi' => Request()->posisi,
            ];
            $this->SekolahModel->UpdateData($id_sekolah, $data);
        }

        
        return redirect()->route('sekolah')->with('pesan', 'Data berhasil di update');
    }

    public function delete($id_sekolah)
    {
        
        $this->SekolahModel->DeleteData($id_sekolah);
        return redirect()->route('sekolah')->with('pesan', 'Data berhasil di delete');
    }
}
