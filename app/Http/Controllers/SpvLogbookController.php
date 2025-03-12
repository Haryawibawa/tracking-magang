<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use App\Models\Supervisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SpvLogbookController extends Controller
{
    public function index() {
        $pegawai = Supervisi::where('id_spv', auth()->user()->id_spv)->first();
        $loogbookQuery = LogBook::where('id_spv', $pegawai->id_spv);
        $loogbook = new LogBook;
        $loogbook = [
            'total' => $loogbookQuery->count(),
            'pending' => $loogbookQuery->where('status', 2)->count(),
            'diterima' => $loogbookQuery->where('status', 1)->count(),
            'ditolak' => $loogbookQuery->where('status', 0)->count(),
        ]; 
        return view('spv.logbook', compact('loogbook'));
    }
    public function show(Request $request)  {
        $loogbookQuery = LogBook::with('nimmhs')->where('id_spv', Auth::user()->id_spv);
        if ($request->type == "pending") {
            $loogbookQuery->where('status', 2);
        } elseif ($request->type == 'diterima') {
            $loogbookQuery->where('status', 1);
        } elseif ($request->type == 'ditolak') {
            $loogbookQuery->where('status', 0);
        }
        $loogbook = $loogbookQuery->orderBy('created_at', 'desc')->get();
        return DataTables::of($loogbook)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d/m/y');
            })
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->format('d/m/y');
            })
            ->editColumn('picture', function ($row) {
                $url = Storage::url('' . $row->picture);
                return "<img src='$url' alt='Picture' style='width: 50px; height: 50px; object-fit: cover;'>";
            })
            ->editColumn('status', function ($row){
                if ($row->status == 0){
                    return "<div class='badge rounded-pill bg-label-danger'>" . "Ditolak" . "</div>";
                } elseif ($row->status == 1 ){
                    return "<div class='badge rounded-pill bg-label-success'>" . "Disetujui" . "</div>";
                } else {
                    return "<div class='badge rounded-pill bg-label-warning'>" . "Belum Disetujui" . "</div>";
                }
            })
            ->rawColumns(['action', 'picture', 'status'])
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                if ($row->status !== 0) {
                $btn = "<a class='btn-icon btn-approve' data-status='{$row->status}' data-url='loogbook/approve/$row->id_loogbook' data-id='{$row->id_loogbook}'>
                            <i class='ti ti-file-check text-success'></i>
                        </a>
                        <a class='btn-icon btn-reject' data-status='{$row->status}' data-url='loogbook/tolak/$row->id_loogbook' data-id='{$row->id_loogbook}'>
                            <i class='ti ti-file-x text-danger'></i>
                        </a>";
                return $btn;
                }
            })
            ->make(true);
    }
}
