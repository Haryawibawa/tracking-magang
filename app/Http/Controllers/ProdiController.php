<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdiRequest;
use App\Models\Prodi;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdiController extends Controller
{
    public function index(){
        return view('admin.jurusan');
    }

    public function show(){
        $jurusan = Prodi::orderBy('id_jurusan', 'desc')->get();
        return DataTables::of($jurusan)
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

            $btn = "<a data-bs-toggle='modal' data-id='{$row->id_jurusan}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i>
            <a data-status='{$row->status}' data-id='{$row->id_jurusan}' data-url='prodi/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }

    public function store(ProdiRequest $request){
        try {
            $prodi = Prodi::create([
                'jurusan' => $request->jurusan,
                'status' => 1,
            ]);
            return response()->json([
                'error' => false,
                'message' => 'prodi successfully Created!',
                'modal' => '#modal-master-prodi',
                'table' => '#table-master-prodi'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }   

    public function edit(String $id) {
        $prodi = prodi::Where('id_jurusan', $id)->first();
        return $prodi;
    }

    public function update(prodiRequest $request, $id){
        try {
            $prodi = Prodi::Where('id_jurusan', $id)->first();
            $prodi->jurusan = $request->jurusan;
            $prodi->save();
            return response()->json([
                'error' => false,
                'message' => 'prodi successfully Updated!',
                'modal' => '#modal-master-prodi',
                'table' => '#table-master-prodi'
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
            $prodi = Prodi::where('id_jurusan', $id)->first();
            $prodi->status = ($prodi->status) ? false : true;
            $prodi->save();

            return response()->json([
                'error' => false,
                'message' => 'Status prodi successfully Updated!',
                'table' => '#table-master-prodi'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    } 
}
