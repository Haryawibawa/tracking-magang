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
            Master Mahasiswa
        </h4>
    </div>
    <div class="col-md-2 col-12 mb-3 ps-5 d-flex justify-content-between">
    </div>
    {{-- <div class="col-md-2 col-12 text-end">
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#spv-mahasiswa">Add Mahasiswa</button>
    </div> --}}
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-mahasiswa">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width: 125px;">Nama Mahasiswa</th>
                                <th>Email</th>
                                <th>Instansi</th>
                                <th>Jurusan</th>
                                <th>Status</th>
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
<div class="modal fade" id="spv-mahasiswa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" enctype="multipart/form-data" action="#">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="namamhs" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" name="namamhs" class="form-control" placeholder="Masukkan Nama" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nim" onkeyup="this.value = this.value.replace(/[^0-9]+/g, '');" name="nim" class="form-control" placeholder="Masukkan NIM" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="emailmhs" name="emailmhs" class="form-control" placeholder="Masukkan Email" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label">Jurusan</label>
                            <select class="form-select select2" id="jurusan" name="jurusan"
                                data-placeholder="Pilih Jurusan">
                                <option disabled selected>Pilih Jurusan</option>
                                @foreach ($jurusan as $u)
                                    <option value="{{ $u->id_jurusan }}">{{ $u->jurusan }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                minlength="8"
                                onkeyup="validatePassword()"
                            />
                            <div class="invalid-feedback">
                                Password harus minimal 8 karakter.
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Informasi Pribadi -->
<div class="modal fade" id="detail-profile-mhs" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Detail Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
        <div class="modal-body">
            <div class="d-flex justify-content-center align-items-start align-items-sm-center gap-4">
              @if ($mahasiswa?->foto)
                  <img src="{{ Storage::url($mahasiswa->foto) }}" alt="user-avatar"
                      class="mb-3 pt-1 mt-4" name="foto" id="imgPreview" >
              @else
                  <img src="{{ url('assets/img/avatars/14.png') }}" alt="user-avatar"
                      class="mb-3 pt-1 mt-4" id="imgPreview" >
              @endif
            </div>
            {{-- @dd($mahasiswa?->foto) --}}
            <div class="border-top">
              <div class="row mt-4">
                <div class="mb-3 col-md-6 form-input">
                  <label for="posisi" class="form-label">Division</label>
                  <input class="form-control" type="text" disabled id="posisi" name="posisi" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control" type="text" disabled id="email" name="email" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label class="form-label" for="nim">Nim</label>
                  <input disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" type="text" disabled id="nimmhs" name="nim" class="form-control" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="namamahasiswa" class="form-label">Nama</label>
                  <input class="form-control" type="text" disabled id="namamahasiswa" name="namamahasiswa" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="supervisor" class="form-label">Supervisor</label>
                  <input class="form-control" type="text" disabled id="supervisor" name="supervisor" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="religion" class="form-label">Religion </label>
                  <input class="form-control" type="text" disabled id="agama" name="agama" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="place" class="form-label">Place Of Birth</label>
                  <input class="form-control" type="text" disabled id="tempatlahirmhs" name="tempatlahirmhs"   />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="birth" class="form-label">Date Of Birth</label>
                  <input class="form-control" type="date" disabled id="tanggallahirmhs" name="tanggallahirmhs" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label class="form-label" for="phoneNumber">Phone Number</label>
                  <input disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" type="text" disabled id="nohpmhs" name="nohpmhs" class="form-control" />
                  <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-4 form-input">
                  <label for="address" class="form-label">Address </label>
                  <input class="form-control" type="text" disabled id="alamatmhs" name="alamatmhs" placeholder="Bandung" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6 form-input">
                  <label for="gender" id="gender" class="form-label">Gender</label>
                  <div class="form-check">
                      <div class="row">
                          <div class="col-3">
                              <input name="jeniskelamin" class="form-check-input" type="radio" value="Laki-Laki" id="laki-laki">
                              <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                          </div>
                          <div class="col-3 ms-2">
                              <input name="jeniskelamin" class="form-check-input" type="radio" value="Perempuan" id="perempuan">
                              <label class="form-check-label" for="perempuan">Perempuan</label>
                          </div>
                      </div>
                      <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>
          </div>
        <!-- /Account -->
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
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin menonaktifkan Mahasiswa</h5>
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

    var table = $('#table-master-mahasiswa').DataTable({
        ajax: '{{ url("spv-mhs-bimbingan/show")}}',
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
                name: "namamhs",
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },
            {
                data: "emailmhs",
                name: "emailmhs",
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },
            {
                data: "nim",
                name: "nim",
                render: function(data, type, row) {
                    return data ? data : '-';
                }
            },

            {
                data: 'jurusan.jurusan',
                name: 'jurusan' ,
                render: function(data, type, row) {
                    return data ? data : '-';
                }
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

    function detail(e) {
        let id = e.attr('data-id');
        var url = `{{ url('supervisor/mahasiswa/show-detail') }}/${id}`;
        
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
            $('#imgPreview').attr('src', response.foto ? `{{ Storage::url('') }}` + response.foto : `{{ url('assets/img/avatars/14.png') }}`);

            $('#email').val(response.emailmhs);
            $('#posisi').val(response.posisi);
            $('#namamahasiswa').val(response.namamhs);
            $('#supervisor').val(response.spv.nama);
            $('#agama').val(response.agama);
            $('#tempatlahirmhs').val(response.tempatlahirmhs);
            $('#nimmhs').val(response.nim);
            $('#tanggallahirmhs').val(response.tanggallahirmhs);
            $('#nohpmhs').val(response.nohpmhs);
            $('#alamatmhs').val(response.alamatmhs);
            $('#jeniskelamin').val(response.jeniskelamin);
            if (response.jeniskelamin === "Laki-Laki") {
                $('#laki-laki').prop('checked', true);
            } else if (response.jeniskelamin === "Perempuan") {
                $('#perempuan').prop('checked', true);
            };
                $('#detail-profile-mhs').modal('show');
            },
        });
    }
    function edit(e) {
        let id = e.attr('data-id');
        let action = `{{ url('supervisor/mahasiswa/update') }}/${id}`;
        var url = `{{ url('supervisor/mahasiswa/show-detail') }}/${id}`;

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Aktifitas");
                $("#modal-button").html("Update Data");
                $('#spv-mahasiswa form').attr('action', action);
                $('#namamhs').val(response.namamhs).trigger('change');
                $('#nim').val(response.nim);
                $('#nim').prop('disabled', true);
                $('#emailmhs').val(response.emailmhs);
                $('#jurusan').val(response.id_jurusan);
                $('#instansi').val(response.id_univ);
                // $('#password').val(response.password);
                $('#spv-mahasiswa').modal('show');
            }
        });
    }
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