<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;

class GuruController extends Controller
{
    public function profile(Guru $guru){
        return view('guru.profile',['guru'=>$guru]);
    }
}
