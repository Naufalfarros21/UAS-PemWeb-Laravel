@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil Perhitungan TOPSIS</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Matriks Normalisasi -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Matriks Normalisasi</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriteria as $k)
                                        <th>{{ $k->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($normalizedMatrix as $i => $row)
                                    <tr>
                                        <td>{{ $alternatifs[$i]->name }}</td>
                                        @foreach($row as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Matriks Terbobot -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Matriks Terbobot</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriteria as $k)
                                        <th>{{ $k->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($weightedNormalizedMatrix as $i => $row)
                                    <tr>
                                        <td>{{ $alternatifs[$i]->name }}</td>
                                        @foreach($row as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Solusi Ideal -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Solusi Ideal</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($kriteria as $k)
                                        <th>{{ $k->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ideal Positif</td>
                                        @foreach($idealPositive as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Ideal Negatif</td>
                                        @foreach($idealNegative as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Jarak Solusi Ideal -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jarak Solusi Ideal</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        <th>Jarak Positif</th>
                                        <th>Jarak Negatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($distances as $i => $distance)
                                    <tr>
                                        <td>{{ $alternatifs[$i]->name }}</td>
                                        <td>{{ number_format($distance['positive'], 4) }}</td>
                                        <td>{{ number_format($distance['negative'], 4) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Nilai Preferensi -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nilai Preferensi</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        <th>Keterangan</th>
                                        <th>Nilai Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($preferences as $i => $preference)
                                    <tr>
                                        <td>{{ $alternatifs[$i]->name }}</td>
                                        <td>{{ $alternatifs[$i]->keterangan }}</td>
                                        <td>{{ number_format($preference, 4) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Ranking -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ranking</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Alternatif</th>
                                        <th>Keterangan</th>
                                        <th>Nilai Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(array_keys($preferences) as $rank => $i)
                                    <tr>
                                        <td>{{ $rank + 1 }}</td>
                                        <td>{{ $alternatifs[$i]->name }}</td>
                                        <td>{{ $alternatifs[$i]->keterangan }}</td>
                                        <td>{{ number_format($preferences[$i], 4) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection