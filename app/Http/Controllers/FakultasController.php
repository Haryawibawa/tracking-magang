<?php

namespace App\Http\Controllers;

use App\Http\Requests\FakultasRequest;
use App\Models\Fakultas;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    public function index(){
        return view('admin.fakultas');
    }

    public function show(){
        $fakultas = Fakultas::orderBy('created_at', 'desc')->get();
        return DataTables::of($fakultas)
        ->addIndexColumn()
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return "<div class='text-center'><div class='badge bg-label-success'>" . "Active" . "</div></div>";
            } else {
                return "<div class='text-center'><div class='badge bg-label-danger'>" . "Inactive" . "</div></div>";
            }
        })
        ->addColumn('action', function ($row) {
            $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
            $color = ($row->status) ? "danger" : "success";

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_fakultas}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_fakultas}' data-url='fakultas/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }

    public function store(FakultasRequest $request){
        try {
            $fakultas = Fakultas::create([
                'fakultas' => $request->fakultas,
                'status' => 1,
            ]);
            return response()->json([
                'error' => false,
                'message' => 'fakultas successfully Created!',
                'modal' => '#modal-master-fakultas',
                'table' => '#table-master-fakultas'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }   

    public function edit(String $id) {
        $fakultas = Fakultas::Where('id_fakultas', $id)->first();
        return $fakultas;
    }

    public function update(FakultasRequest $request, $id){
        try {
            $fakultas = Fakultas::Where('id_fakultas', $id)->first();
            $fakultas->fakultas = $request->fakultas;
            $fakultas->save();
            return response()->json([
                'error' => false,
                'message' => 'fakultas successfully Updated!',
                'modal' => '#modal-master-fakultas',
                'table' => '#table-master-fakultas'
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
            $fakultas = Fakultas::where('id_fakultas', $id)->first();
            $fakultas->status = ($fakultas->status) ? false : true;
            $fakultas->save();

            return response()->json([
                'error' => false,
                'message' => 'Status fakultas successfully Updated!',
                'table' => '#table-master-fakultas'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    } 
}
