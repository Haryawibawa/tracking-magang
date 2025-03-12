@extends('vue.template')
@section('content')
<div class="col-12 mt-4">
    <div class="card h-100">
        <div class="card-header">
            <h5>Dashboard</h5>
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <!-- Mahasiswa Magang -->
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-success me-3 p-2">
                            <i class="ti ti-users ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0"></h5>
                            <p class="mb-0" style="font-size:18px;">Peserta Magang</p>
                        </div>
                    </div>
                </div>
                <!-- Universitas -->
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-success me-3 p-2">
                            <i class="ti ti-smart-home ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0"></h5>
                            <p class="mb-0" style="font-size:18px;">Universitas</p>
                        </div>
                    </div>
                </div>
                <!-- Universitas -->
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-warning me-3 p-2">
                            <i class="ti ti-home ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0"></h5>
                            <p class="mb-0" style="font-size:18px;">Sekolah</p>
                        </div>
                    </div>
                </div>
                <!-- Universitas -->
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-label-warning me-3 p-2">
                            <i class="ti ti-pencil ti-sm" style="font-size: 30px !important;"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0"></h5>
                            <p class="mb-0" style="font-size:18px;">Jurusan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection