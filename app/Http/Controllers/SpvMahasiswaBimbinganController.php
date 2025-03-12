<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Supervisi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SpvMahasiswaBimbinganController extends Controller
{
    public function index() {
        $jurusan = Prodi::all();
        $pegawai = Supervisi::where('id_spv', auth()->user()->id_spv)->with('spv')->first();
        $mahasiswa = Mahasiswa::where('nim')->with('spv', 'jurusan')->first();
        return view('spv.mhs-bimbingan', compact('jurusan', 'mahasiswa', 'pegawai'));
    }

    public function show(){

        $mahasiswa = Mahasiswa::where('id_spv', auth()->user()->id_spv)->with('jurusan')->orderBy('created_at', 'asc')->get();
        return DataTables::of($mahasiswa)
        ->addIndexColumn()
        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return "<div'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
            } else {
                return "<div'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
            }
        })
        ->addColumn('action', function ($row) {
            $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
            $color = ($row->status) ? "danger" : "success";
            $btn = "
            <a data-bs-toggle='modal' data-id='{$row->nim}' onclick=detail($(this)) class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>
            <a data-status='{$row->status}' data-id='{$row->nim}' data-url='mahasiswa/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
            return $btn;
        })
        ->rawColumns(['action', 'status'])

        ->make(true);
    }
}
