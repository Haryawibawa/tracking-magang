<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversitasRequest;
use App\Models\Universitas;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UniversitasController extends Controller
{
    public function index(){
        return view ('admin.universitas');
    }
       
    public function show(){
        $univ = Universitas::orderBy('created_at', 'desc')->get();
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

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_univ}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_univ}' data-url='universitas/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }
    
    
    public function store(UniversitasRequest $request){
        try {
            $univ = Universitas::create([
                'namauniv' => $request->namauniv,
                'status' => 1,
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Universitas successfully Created!',
                'modal' => '#modal-master-universitas',
                'table' => '#table-master-universitas'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }   

    public function edit(String $id) {
        $universitas = Universitas::Where('id_univ', $id)->first();
        return $universitas;
    }

    public function update(UniversitasRequest $request, $id){
        try {
            $universitas = Universitas::Where('id_univ', $id)->first();
            $universitas->namauniv = $request->namauniv;
            $universitas->save();
            return response()->json([
                'error' => false,
                'message' => 'Universitas successfully Updated!',
                'modal' => '#modal-master-universitas',
                'table' => '#table-master-universitas'
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
            $univ = Universitas::where('id_univ', $id)->first();
            $univ->status = ($univ->status) ? false : true;
            $univ->save();

            return response()->json([
                'error' => false,
                'message' => 'Status univ successfully Updated!',
                'table' => '#table-master-universitas'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    } 
}
