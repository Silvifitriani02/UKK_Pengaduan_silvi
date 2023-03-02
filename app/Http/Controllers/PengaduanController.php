<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;

use App\Pengaduanimage;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

    		'tgl_pengaduan' => 'required',
    		'nik' => 'required',
            'isi_laporan' => 'required',
            'foto.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000|required',
    	]);

        // $nm = $request->foto;
        $uniqID = Carbon::now()->timestamp . uniqid();

        //$item = time().rand(100,999).".".$nm->getClientOriginalName();

        $data = new Pengaduan;
        $data->unique_id  = $uniqID;
        $data->tgl_pengaduan = $request->tgl_pengaduan;
        $data->nik = $request->nik;
        $data->isi_laporan = $request->isi_laporan;

        foreach ($request->foto as $key => $image) {
            $pimage = new Pengaduanimage();
            $pimage->pengaduan_unique_id = $uniqID;

            $imageName = Carbon::now()->timestamp . $key . '.' . $request->foto[$key]->extension();
            $request->foto[$key]->move(public_path("images"), $imageName);

            $pimage->image = $imageName;
            $pimage->save();
        }

        $data->save();
        return redirect('/pengaduan');

        /* $data['foto']=
        $request->file('foto')->store('assets/pengaduan','public');

        $data->save(); */
 
        // Pengaduan::create([
    	// 	'tgl_pengaduan' => $request->tgl_pengaduan,
    	// 	'nik' => $request->nik,
        //     'isi_laporan' => $request->isi_laporan,
        //     'foto' => $request->foto,
        //     'status' => $request->status
    	// ]);

    	
    
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengaduan = Pengaduan::where('id_pengaduan',$id)->first();

        return view('pengaduan.edit', compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengaduan::where('id_pengaduan',$id)->delete();
        return redirect()->route('pengaduan')->with('Data Berhasil di Hapus');
    }

    public function status($id)
    {
        $pengaduan = Pengaduan::where('id_pengaduan',$id)->first();

        $status_sekarang = $pengaduan->status;

        if($status_sekarang == 1){
            Pengaduan::where('id_pengaduan',$id)->update([
                'status'=>0
            ]);
        }else{
            Pengaduan::where('id_pengaduan',$id)->update([
                'status'=>1
            ]);
        }

        return redirect()->route('pengaduan')->with('Data diubah', 'Data berhasil diubah');

    }

}
