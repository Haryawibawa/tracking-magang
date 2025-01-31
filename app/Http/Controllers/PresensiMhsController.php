<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PresensiMhsController extends Controller
{
    public function index() {

        return view('admin.master-presensi');
    }
    public function show() {
        $mahasiswa = Mahasiswa::with('jurusan', 'univ', 'fakultas')->orderBy('created_at', 'asc')->get();

        return DataTables::of($mahasiswa)
        ->addIndexColumn()
        ->addColumn('detail', function ($row) {
            $btn =
            "<a href='/presensi-mhs/detail/$row->nim' data-id='{$row->nim}' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i></a>";
            return $btn;
        })
        ->rawColumns(['detail'])

        ->make(true);
    }
    public function detail($id) {
        $mahasiswa = Mahasiswa::where('nim', $id)->first(); 
        return view('admin.detail-master-presensi', compact('mahasiswa'));
    }

    public function tbldetail($id) {
       // Filter data presensi berdasarkan nim
       $detailpresensi = Presensi::where('nim', $id)
       ->with('mahasiswa') // Ambil data relasi mahasiswa
       ->orderBy('tgl', 'desc')
       ->get();

        // Kembalikan data dalam format DataTables
        return DataTables::of($detailpresensi)
            ->addIndexColumn()
            ->editColumn('tgl', function ($row) {
                // Format tanggal sesuai kebutuhan
                return Carbon::parse($row->tgl)->format('d/m/y');
            })
            ->editColumn('status', function ($row) {
                // Tampilkan status Hadir/Tidak Hadir
                return $row->status == 1 ? 'Hadir' : 'Tidak Hadir';
            })
            ->make(true);
    }
   
}
