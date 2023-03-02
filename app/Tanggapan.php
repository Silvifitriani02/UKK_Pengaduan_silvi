<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    public $timestamps = false;
    protected $table = "tb_tanggapan";
    protected $fillable = ['id_pengaduan','tgl_tanggapan','tanggapan','nik'];
}
