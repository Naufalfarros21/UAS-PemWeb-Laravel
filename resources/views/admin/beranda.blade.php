@extends('admin.layout.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Beranda</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Beranda</li>
                        </ol>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        @php
                        date_default_timezone_set('Asia/Jakarta');
                        $hour = date('H');
                        if ($hour < 12) { $greeting='Selamat Pagi' ; } elseif ($hour < 15) { $greeting='Selamat Siang' ;
                            } elseif ($hour < 18) { $greeting='Selamat Sore' ; } else { $greeting='Selamat Malam' ; }
                            @endphp <h2>{{ $greeting }}, {{ Auth::user()->name }}!</h2>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah Kriteria</span>
                                <span class="info-box-number">
                                    {{ $kriteriaCount }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-regular fa-keyboard"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah Alternatif</span>
                                <span class="info-box-number">{{ $alternatifCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Penjelasan Metode Topsis -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Penjelasan Metode Topsis</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Metode TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution)
                                    adalah salah satu metode pengambilan keputusan multikriteria yang menggunakan konsep
                                    bahwa alternatif terbaik tidak hanya memiliki jarak terdekat dari solusi ideal
                                    positif tetapi juga memiliki jarak terjauh dari solusi ideal negatif.
                                    Langkah-langkah dalam metode TOPSIS adalah sebagai berikut:</p>
                                <ol>
                                    <li>Normalisasi matriks keputusan.</li>
                                    <li>Menghitung matriks normalisasi terbobot.</li>
                                    <li>Menentukan solusi ideal positif dan solusi ideal negatif.</li>
                                    <li>Menghitung jarak setiap alternatif dari solusi ideal positif dan solusi ideal
                                        negatif.</li>
                                    <li>Menghitung nilai preferensi untuk setiap alternatif.</li>
                                    <li>Mengurutkan alternatif berdasarkan nilai preferensi.</li>
                                </ol>
                                <p>Dengan menggunakan metode TOPSIS, pengambil keputusan dapat menentukan alternatif
                                    terbaik berdasarkan perhitungan matematis yang objektif.</p>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /.content-wrapper -->
@endsection