<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniversitasController extends Controller
{
    public function index(){
        return view ('admin.universitas');
    }
       
    public function show(){
        return view ('');
    }
    
    
    public function store(){
        return view ('');
    }   

    public function edit(){
        return view ('');
    }   

    public function update(){
        return view ('');
    }   

    public function status(){
        return view ('');
    }   
}
