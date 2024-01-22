@extends('backend.index')
@section('content')
<section class="section dashboard">
    <div class="row">
        <!-- Jumlah Gedung -->
        <div class="col-md-4">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Gedung</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-buildings"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $ar_gedung }}</h6>
                            <span class="text-success small pt-1 fw-bold">Gedung</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumlah Elektronik -->
        <div class="col-md-4">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Elektronik</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-tv"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $ar_elektronik }}</h6>
                            <span class="text-success small pt-1 fw-bold">Pcs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumlah Bootstrap -->
        <div class="col-md-4">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Furniture</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-wallet"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $ar_furniture }}</h6>
                            <span class="text-danger small pt-1 fw-bold">Pcs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Total Harga Asset Kendaraan</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ number_format($total,2,',','.') }}</h6>
                            <span class="text-success small pt-1 fw-bold">Rupiah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Total Harga Asset Tanah</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ number_format($total2,2,',','.') }}</h6>
                            <span class="text-danger small pt-1 fw-bold">Rupiah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Jumlah Asset per Kategori Asset</h5>
                    <!-- Bar Chart -->
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>
                        //ambil data nama kategori dan jumlah asset per asset dari DashboardController di fungsi index
                        var lbl = [@foreach($grafik_bar as $gb) '{{ $gb->nama }}', @endforeach];
                        var jml = [@foreach($grafik_bar as $gb) {{ $gb->jml }}, @endforeach];
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#barChart'), {
                                type: 'bar',
                                data: {
                                    /*
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                        'July'
                                    ],
                                    */
                                    labels: lbl,
                                    datasets: [{
                                        label: 'Perbandingan Jumlah Asset',
                                        //data: [65, 59, 80, 81, 56, 55, 40],
                                        data: jml,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                    <!-- End Bar CHart -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Total Harga per Kategori Asset</h5>

                    <!-- Pie Chart -->
                    <canvas id="pieChart" style="max-height: 400px;"></canvas>
                    <script>
                        var lbl2 = [@foreach($grafik_pie as $gp) '{{ $gp->nama }}', @endforeach];
                        var total = [@foreach($grafik_pie as $gp) {{ $gp->total_harga }}, @endforeach];
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#pieChart'), {
                                type: 'pie',
                                data: {
                                    /*
                                    labels: [
                                        'Red',
                                        'Blue',
                                        'Yellow'
                                    ],
                                    */
                                    labels:lbl2,
                                    datasets: [{
                                        label: 'Perbandingan Total Harga per Kategori Asset',
                                        //data: [300, 50, 100],
                                        data: total,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)',
                                            'rgb(60, 179, 113)',
                                            'rgb(106, 90, 205)'
                                        ],
                                        hoverOffset: 4
                                    }]
                                }
                            });
                        });

                    </script>
                    <!-- End Pie CHart -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
