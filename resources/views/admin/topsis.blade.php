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
                            <p>Nilai-nilai dalam tabel ini adalah hasil dari normalisasi matriks keputusan awal, di mana
                                setiap nilai dalam matriks awal dibagi dengan akar kuadrat dari jumlah kuadrat seluruh
                                nilai dalam kolom tersebut.</p>
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
                            <p>Nilai-nilai dalam tabel ini adalah hasil dari normalisasi terbobot, di mana setiap nilai
                                normalisasi dikalikan dengan bobot kriteria terkait.</p>
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
                            <p>Solusi ideal positif (terbaik) dan negatif (terburuk) dihitung berdasarkan nilai maksimal
                                dan minimal dari setiap kolom matriks terbobot, tergantung apakah kriteria tersebut
                                bertipe benefit atau cost.</p>
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
                            <p>Jarak solusi ideal dihitung menggunakan rumus Euclidean distance antara setiap alternatif
                                dengan solusi ideal positif dan negatif.</p>
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
                            <p>Nilai preferensi dihitung berdasarkan jarak ke solusi ideal positif dan negatif. Semakin
                                tinggi nilai preferensi, semakin baik alternatif tersebut.</p>
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
                            <p>Ranking ditentukan berdasarkan nilai preferensi dari tertinggi ke terendah.</p>
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

                    <!-- Keterangan Alternatif -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Keterangan Alternatif</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatifs as $alternatif)
                                    <tr>
                                        <td>{{ $alternatif->name }}</td>
                                        <td>{{ $alternatif->keterangan }}</td>
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