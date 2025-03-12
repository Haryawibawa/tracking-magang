@extends('vue.template')

@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
    <div class="col-md-8 col-12">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
            List Mahasiswa Bimbingan
        </h4>
        <div class="btn btn-warning" onclick="history.back()" style="cursor: pointer;">
            <span>Kembali</span>
        </div>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-detail-mhs-bbg">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>Fakultas</th>
                                <th>Universitas</th>
                            </tr>
                        </thead>
                    </table>
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

    var spv = '{{ $spv->id_spv }}'; // Ambil id_spv dari view
    var table = $('#table-detail-mhs-bbg').DataTable({
        ajax: `/pegawai/detail-show/${spv}`,
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [
            {
                data: 'DT_RowIndex'
            },
            {
                data: "namamhs",
                name: "namamhs"
            },
            {
                data: "emailmhs",
                name: "emailmhs"
            },
            {
                data: "jurusan.jurusan",
                name: "jurusan"
            },
            {
                data: "fakultas.fakultas",
                name: "fakultas"
            },
            {
                data: "univ.namauniv",
                name: "namauniv"
            },
        ]
    });

    jQuery(function() {
        jQuery('.showSingle').click(function() {
            jQuery('.targetDiv').hide('.cnt');
            jQuery('#div' + $(this).attr('target')).slideToggle();
        });
    });

    function validatePassword() {
        const passwordInput = document.getElementById('password');
        const feedback = passwordInput.nextElementSibling;

        if (passwordInput.value.length >= 8) {
            passwordInput.classList.remove('is-invalid');
            feedback.style.display = 'none';
        } else {
            passwordInput.classList.add('is-invalid');
            feedback.style.display = 'block';
        }
    }
</script>

<script src="{{url('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{url('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection
