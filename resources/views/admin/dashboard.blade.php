@extends('vue.template')
@section('content')
<div class="row">
    <!-- Pie Chart -->
    <div class="col-md-6 col-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Mahasiswa Magang Menggunakan Grafik Pie Chart</h5>
            </div>
            {{-- @if ($keluhan !== null && $keluhan->isNotEmpty()) --}}
                <canvas id="rekapChart" style="max-height: 300px"></canvas>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mb-3 mt-4">
                        <div class="d-sm-flex d-block">
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #33a100"></span> Done
                            </div>
                            <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                <span class="badge badge-dot me-1" style="background-color: #FF9F43"></span> In-Process
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @else
            <div class="alert alert-warning p-3 m-3" role="alert">
                Belum Ada Keluhan
            </div>
            @endif --}}
        </div>
    </div>

    <!-- Chart -->
    <div class="col-md-6 col-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Mahasiswa Magang Menggunakan Grafik Chart (balok) </h5>
            </div>
            <div class="card-body">
                <canvas id="keluhanChart"></canvas>
            </div>
        </div>
    </div>

    <!-- data-table -->
    <div class="col-md-8 col-12">
        <h4 class="fw-bold text-sm">
            <span class="text-muted fw-light text-xs"></span>
            TOP 10 Mahasiswa Magang
        </h4>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table datatables-basic" id="table-id">
                            <thead>
                                <tr>
                                    <th style="min-width: 125px;">Nama</th>
                                    <th>Email</th>
                                    <th>No. Hp</th>
                                    {{-- <th>Dibuat</th> --}}
                                    <th>Lama Magang</th>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
<script>
    // $(document).ready(function () {
    //     $.ajax({
    //         url: "/admin/dashboard/pie", 
    //         method: "GET",
    //         dataType: "json",
    //         success: function (response) {
    //             let labels = [];
    //             let data = [];
    //             let colors = {
    //                 "Done": "#33a100",
    //                 "In-Process": "#FF9F43",
    //                 "Received": "#7B61FF"
    //             };

    //             let statusMapping = {
    //                 0: "Received",
    //                 1: "In-Process",
    //                 2: "Done"
    //             };

    //             let totalKeluhan = response.reduce((sum, item) => sum + item.total, 0);

    //                 response.forEach(item => {
    //                     let statusLabel = statusMapping[item.status_keluhan] || "Unknown";
    //                     let percentage = ((item.total / totalKeluhan) * 100).toFixed(2); 
    //                     labels.push(`${statusLabel} (${percentage}%)`); 
    //                     data.push(item.total);
    //                 });

    //                 let ctx = document.getElementById("rekapChart").getContext("2d");
    //                 new Chart(ctx, {
    //                     type: "pie",
    //                     data: {
    //                         labels: labels,
    //                         datasets: [{
    //                             data: data,
    //                             backgroundColor: labels.map(label => {
    //                                 let key = label.split(" ")[0]; 
    //                                 return colors[key] || "#CCCCCC";
    //                             })
    //                         }]
    //                     },
    //                     options: {
    //                         responsive: true
    //                     }
    //                 });
    //         },
    //         error: function (xhr, status, error) {
    //             console.error("Error fetching data:", error);
    //         }
    //     });
    // });

    // $(document).ready(function () {
    //     $.ajax({
    //         url: "/admin/dashboard/chart",
    //         method: "GET",
    //         dataType: "json",
    //         success: function (response) {
    //             let labels = [];
    //             let datasetDone = [];
    //             let datasetInProcess = [];
    //             let datasetReceived = [];

    //             let colors = {
    //                 "Done": "#33a100",
    //                 "In-Process": "#FF9F43",
    //                 "Received": "#7B61FF"
    //             };

    //             let statusMapping = {
    //                 0: "Received",
    //                 1: "In-Process",
    //                 2: "Done"
    //             };
    //             let uniqueMonths = [...new Set(response.map(item => item.bulan))];

    //             uniqueMonths.forEach(month => {
    //                 let done = response.find(item => item.bulan === month && item.status_keluhan == 2);
    //                 let inProcess = response.find(item => item.bulan === month && item.status_keluhan == 1);
    //                 let received = response.find(item => item.bulan === month && item.status_keluhan == 0);

    //                 labels.push(month);
    //                 datasetDone.push(done ? done.total : 0);
    //                 datasetInProcess.push(inProcess ? inProcess.total : 0);
    //                 datasetReceived.push(received ? received.total : 0);
    //             });

    //             let ctx = document.getElementById("keluhanChart").getContext("2d");
    //             new Chart(ctx, {
    //                 type: "bar",
    //                 data: {
    //                     labels: labels,
    //                     datasets: [
    //                         {
    //                             label: "Done",
    //                             data: datasetDone,
    //                             backgroundColor: colors["Done"]
    //                         },
    //                         {
    //                             label: "In-Process",
    //                             data: datasetInProcess,
    //                             backgroundColor: colors["In-Process"]
    //                         },
    //                         {
    //                             label: "Received",
    //                             data: datasetReceived,
    //                             backgroundColor: colors["Received"]
    //                         }
    //                     ]
    //                 },
    //                 options: {
    //                     responsive: true,
    //                     scales: {
    //                         y: {
    //                             beginAtZero: true
    //                         }
    //                     }
    //                 }
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             console.error("Error fetching data:", error);
    //         }
    //     });
    // });

    // $('.table').each(function() {
    //     let url = "{{ url('admin/dashboard/table')}}";        

    //     $(this).DataTable({
    //         ajax: url,
    //         serverSide: false,
    //         processing: true,
    //         deferRender: true,
    //         type: 'GET',
    //         destroy: true,
    //         columns: [
    //             { 
    //                 data: "keluhan.nama", 
    //                 name: "nama" 
    //             },
    //             { 
    //                 data: "keluhan.email", 
    //                 name: "email" 
    //             },
    //             { 
    //                 data: "keluhan.nomor_hp", 
    //                 name: "nomor_hp" 
    //             },
    //             { 
    //                 data: "created_at", 
    //                 name: "created_at"
    //             },
    //             { 
    //                 data: "umur_keluhan",
    //                 name: "umur_keluhan" 
    //             },
    //         ],
    //     });
        
    // });

</script>

@endsection