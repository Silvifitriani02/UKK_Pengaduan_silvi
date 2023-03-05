<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Regency;
use App\Models\Villages;
use Illuminate\Http\Request;

class IndoRegionController extends Controller
{
    public function Regency(Request $request)
    {
        $province_id = $request->province_id;

        $regencies = Regency::where('province_id', $province_id)->get();

        $options = "<option value=''>--Pilih Kabupaten/Kota--</option>";

        foreach($regencies as $regency){

            $options .= "<option value='$k->id'>$k->name</option>";
        }

        echo $options;
    }
    
    public function getdistrict(Request $request)
    {
        $regency_id = $request->regency_id;

        $district = District::where('regency_id', $regency_id)->get();

        $options = "<option value=''>--Pilih Kecamatan--</option>";

        foreach($district as $district){
            $options .= "<option value='$k->id'>$k->name</option>";
        }

        echo $options;
    }

    public function getvillage(Request $request)
    {
        $district_id = $request->district_id;

        $village = Village::where('district_id', $district_id)->get();

        $options = "<option value=''>--Pilih Desa--</option>";

        foreach($village as $village){
            $options .= "<option value='$d->id'>$d->name</option>";
        }

        echo $options;
    }
}
