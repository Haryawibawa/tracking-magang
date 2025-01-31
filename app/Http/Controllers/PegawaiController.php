<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Models\Supervisi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index(){
        return view('admin.pegawai');
    }

    public function show(){
        $univ = Supervisi::orderBy('created_at', 'asc')->get();
        return DataTables::of($univ)
        ->addIndexColumn()
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
            } else {
                return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
            }
        })
        ->addColumn('action', function ($row) {
            $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
            $color = ($row->status) ? "danger" : "success";

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_spv}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_spv}' data-url='pegawai/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }
    
    public function store(PegawaiRequest $request) {
        try {
            $spv = Supervisi::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'pangkat' => $request->pangkat,
                'status' => 1
            ]);
            $users = User::create([
                'id_spv' => $spv->id_spv,
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $users->assignRole('supervisi');
            return $users;

            return response()->json([
                'error' => false,
                'message' => 'Pegawai successfully Created!',
                'modal' => '#modal-master-pegawai',
                'table' => '#table-master-pegawai'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function status(String $id)
    {
        try {
            $spv = Supervisi::where('id_spv', $id)->first();
            $spv->status = ($spv->status) ? false : true;
            $spv->save();

            return response()->json([
                'error' => false,
                'message' => 'Status pegawai successfully Updated!',
                'table' => '#table-master-pegawai'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function edit(String $id) {
        $spv = Supervisi::Where('id_spv', $id)->first();
        return $spv;
    }

    public function update(PegawaiRequest $request, $id) {
        try {
            $user = User::where('id_spv', $id)->first();
            if ($user) {
                $user->name = $request->nama;
                $user->email = $request->email;
                if ($request->filled('password')) {
                    $user->password = bcrypt($request->password);
                }
                $user->save();
            }
            $spv = Supervisi::Where('id_spv', $id)->with('spv', 'pegawai')->first();
            $spv->nama = $request->nama;
            $spv->email = $request->email;
            $spv->pangkat = $request->pangkat;
            $spv->save();
            return response()->json([
                'error' => false,
                'message' => 'Pegawai successfully Updated!',
                'table' => '#table-master-pegawai'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
