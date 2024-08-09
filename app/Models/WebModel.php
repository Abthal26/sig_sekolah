<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebModel extends Model
{
   public function AllDataSekolah(){
    return DB::table('sekolah')->get();
   }

   public function DetailSekolah(){
    return DB::table('sekolah')->when('id_sekolah', $id_sekolah)->get();
   }
   
   
    use HasFactory;
}
