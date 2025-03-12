<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Models\Mahasiswa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    protected function store(SigninRequest $request)
    {

        try {
            DB::beginTransaction();
            $mahasiswa = Mahasiswa::create([
                'nim' => $request['nim'],
                'namamhs' => $request['name'],
                'emailmhs' => $request['email'],
                'status' => 0,
            ]);

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'nim' => $mahasiswa->nim
            ]);
            $user->assignRole('mahasiswa');
            DB::commit();
            return response()->json([
                'error' => false,
                'message' => 'Account successfully Created!',
                'url' => '/login'
            ]);
            
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
