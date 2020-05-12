<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Siswa;
use App\Post;

class SiteController extends Controller
{
    public function home(){
        return view('sites.home');
    }

    public function about(){
        return view('sites.about');
    }

    public function register(){
        return view('sites.register');
    }

    public function postregister(Request $request){
        // dd($request->all());
         // insert ke table user
         $user = new User;
         $user->role='siswa';
         $user->name=$request->nama_depan;
         $user->email=$request->email;
         $user->password=bcrypt($request->password);
         $user->remember_token=('qwertyuiop');
         $user->save();

         // insert ke table siswa
        $request->request->add(['user_id' => $user->id]);
        Siswa::create($request->all());

        return redirect('/')->with('sukses','Data pendaftarn berhasil dikirim');
    }

    public function singlepost($slug){
        $post=Post::where('slug','=',$slug)->first();
        return view('sites.singlepost',compact('post'));
    }
}
