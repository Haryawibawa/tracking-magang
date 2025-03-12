<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasaMagangController extends Controller
{
    public function index(){
        return view('admin.masa-magang');
    }
}
