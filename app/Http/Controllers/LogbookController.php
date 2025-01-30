<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index(){
        return view ('admin.logbook');
    }
       
    public function show(){
        return view ('');
    }
    
    
    public function approve(){
        return view ('');
    }   

    public function rejected(){
        return view ('');
    }   


}
