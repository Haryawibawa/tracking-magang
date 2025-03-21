@extends('vue.template')
@section('page_style')
<link rel="stylesheet" href="{{url('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<style>
    .tooltip-inner {
        max-width: 210px;
        /* If max-width does not work, try using width instead */
        width: 900px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-12 g-4">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
        Daftar Presensi Mahasiswa
        </h4>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-master-presensi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="min-width: 125px;">Nama</th>
                                    <th>Universitas</th>
                                    {{-- <th>Total Presensi</th> --}}
                                    <th>Jurusan</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>

    var table = $('#table-master-presensi').DataTable({
        ajax: '{{ url("presensi-mhs/show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: "namamhs",
                name: "namamhs"
            },
            {
                data: "univ.namauniv",
                name: "namauniv"
            },
            {
                data: "jurusan.jurusan",
                name: "jurusan"
            },
            {
                data: "detail",
                name: "detail"
            },
        ]
    });
</script>

<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection
