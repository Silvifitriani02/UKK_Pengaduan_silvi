<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduanimage extends Model
{
    public $timestamps = false;
    protected $table = "pengaduan_image";
    protected $fillable = ['pengaduan_unique_id','image'];
}
