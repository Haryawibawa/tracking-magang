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
            Master Fakultas
        </h4>
    </div>
    <div class="col-md-2 col-12 mb-3 ps-5 d-flex justify-content-between">
    </div>
    <div class="col-md-2 col-12 text-end">
        <button class="btn btn-warning waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-master-fakultas">Tambah Fakultas</button>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-fakultas">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th >Nama fakultas</th>
                                <th >Status</th>
                                <th style="min-width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal edit --}}
<div class="modal fade" id="modal-master-fakultas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah fakultas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" enctype="multipart/form-data" action="{{ route('super.fakultas.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="fakultas" class="form-label">Nama Fakultas</label>
                            <input type="text" id="fakultas" name="fakultas" class="form-control" placeholder="Masukkan fakultas" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modal-button" class="btn btn-warning">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal Alert --}}
<div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../../assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin menonaktifkan fakultas</h5>
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
                    Data yang dipilih akan non-aktif</div>
            </div>
            <div class="modal-footer" style="display: flex; justify-content:center;">
                <button type="submit" id="modal-button" class="btn btn-success">Ya, Yakin</button>
                <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{url('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{url('assets/js/forms-extras.js')}}"></script>
<script>

    var table = $('#table-master-fakultas').DataTable({
        // "data": jsonData,
        ajax: '{{ route("super.fakultas.show")}}',
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
                data: "fakultas",
                name: "fakultas"
            },
            {
                data: "status",
                name: "status"
            },
            {
                data: 'action',
                name: 'action'
            }

        ]
    });

    function edit(e) {
        let id = e.attr('data-id');
        let action = `{{ url('fakultas/update') }}/${id}`;
        var url = `{{ url('fakultas/edit') }}/${id}`;

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Aktifitas");
                $("#modal-button").html("Update Data");
                $('#modal-master-fakultas form').attr('action', action);
                $('#fakultas').val(response.fakultas);
                $('#kategori').val(response.kategori);
                $('#modal-master-fakultas').modal('show');
            }
        });
    }

    $("#modal-master-fakultas").on("hide.bs.modal", function() {
    $("#modal-title").html("Tambah Akifitas");
    $("#modal-button").html("Simpan")
    $('#modal-master-fakultas form')[0].reset();
    $('#modal-master-fakultas form #role').val('').trigger('change');
    $('#modal-master-fakultas form').attr('action', "{{ url('fakultas/store') }}");
    $('.invalid-feedback').removeClass('d-block');
    $('.form-control').removeClass('is-invalid');
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