<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\User;
use App\Mapel;
use PDF;

use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_siswa=Siswa::all();
        return view('siswa.index',['data_siswa'=>$data_siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // insert ke table user
        $user = new User;
        $user->role='siswa';
        $user->name=$request->nama_depan;
        $user->email=$request->email;
        $user->password=bcrypt('rahasia');
        $user->remember_token=('qwertyuiop');
        $user->save();

        // insert ke table siswa
        $request->request->add(['user_id' => $user->id]);
        Siswa::create($request->all());

        return redirect('/siswa')->with('sukses','Data Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(siswa $siswa)
    {
        return view('siswa.edit',compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswa $siswa)
    {
        // dd($request->all());
        Siswa::where('id',$siswa->id)
                ->update([
                    'nama_depan'    =>$request->nama_depan,
                    'nama_belakang' =>$request->nama_belakang,
                    'jenis_kelamin' =>$request->jenis_kelamin,
                    'agama'         =>$request->agama,
                    'alamat'        =>$request->alamat,
                    'avatar'        =>$request->avatar
                ]);

        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar=$request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('/siswa')->with('sukses','data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        return redirect('/siswa')->with('sukses','Data Berhasil Dihapus');
    }

    public function profile(Siswa $siswa){
        $matapelajaran = Mapel::all();
        $categories=[];
        $data=[];

        foreach ($matapelajaran as $mp) {
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[]=$mp->nama;
                $data[]=$siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }
            // dd($data);
        return view('siswa.profile',['siswa' => $siswa, 'matapelajaran' => $matapelajaran,'categories' => $categories,'data'=>$data]);
    }

    public function addnilai(Request $request,Siswa $siswa){
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$siswa.'/profile')->with('error','Data nilai sudah ada');
        }
        $siswa->mapel()->attach($request->mapel,['nilai'=>$request->nilai]);

        return redirect('siswa/'.$siswa->id.'/profile')->with('sukses','Data nilai berhasil dimasukan');
    }

    public function deletenilai(Siswa $siswa,Mapel $mapel){
        $siswa->mapel()->detach($mapel);
        return redirect()->back()->with('sukses','data berhasil di hapus');
    }

    public function exportExcel() 
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function exportPdf(){
        $siswa = Siswa::all();
        $pdf = PDF::loadView('exports.siswa', ['siswa'=>$siswa]);
        return $pdf->download('invoice.pdf');
    }
}
