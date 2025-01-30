<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(){
        return view('admin.fakultas');
    }

    public function show(){
        // return view('admin.fakultas');
    }

    public function edit(){
        // return view('admin.fakultas');
    }
}
