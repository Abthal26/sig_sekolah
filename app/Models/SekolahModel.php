<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SekolahModel extends Model
{
    public function AllData()
    {
        return DB::table('sekolah')->get();
    }

    public function InsertData($data)
    {
        DB::table('sekolah')->insert($data);
    }

    public function DetailData($id_sekolah)
    {
        return DB::table('sekolah')->where('id_sekolah', $id_sekolah)->first();
    }

    public function UpdateData($data, $id_sekolah)
    {
        DB::table('sekolah')->where('id_sekolah', $id_sekolah)->update($data);
    }

    public function DeleteData($id_sekolah)
    {
        DB::table('sekolah')->where('id_sekolah', $id_sekolah)->delete();
    }
    
}
