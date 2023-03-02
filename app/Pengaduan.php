<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    public $timestamps = false;
    protected $table = "tb_pengaduan";
    protected $fillable = ['unique_id ','tgl_pengaduan','nik','isi_laporan','status'];
}
