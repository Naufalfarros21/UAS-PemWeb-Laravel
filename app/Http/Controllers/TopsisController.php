<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\MatrixScore;

class TopsisController extends Controller
{
    public function topsis()
    {
        $alternatifs = Alternatif::all();
        $kriteria = Kriteria::all();
        $matrixScores = MatrixScore::all();

        // Ambil bobot dari tabel kriteria
        $bobot = $kriteria->pluck('bobot')->toArray();

        // Matriks keputusan awal
        $matrix = $matrixScores->map(function ($item) {
            return [
                $item->c1,
                $item->c2,
                $item->c3,
                $item->c4,
                $item->c5,
            ];
        })->toArray();

        // Normalisasi matriks keputusan
        $normalizedMatrix = $this->normalizeDecisionMatrix($matrix);

        // Normalisasi terbobot matriks keputusan
        $weightedNormalizedMatrix = $this->weightNormalizedMatrix($normalizedMatrix, $bobot);

        // Menentukan solusi ideal positif dan negatif
        list($idealPositive, $idealNegative) = $this->calculateIdealSolutions($weightedNormalizedMatrix, $kriteria);

        // Menghitung jarak dari solusi ideal positif dan negatif
        $distances = $this->calculateDistances($weightedNormalizedMatrix, $idealPositive, $idealNegative);

        // Menghitung nilai preferensi untuk setiap alternatif
        $preferences = $this->calculatePreferences($distances);

        // Mengurutkan alternatif berdasarkan nilai preferensi
        arsort($preferences);

        // Menampilkan hasil perhitungan TOPSIS
        return view('admin.topsis', compact('alternatifs', 'kriteria', 'normalizedMatrix', 'weightedNormalizedMatrix', 'idealPositive', 'idealNegative', 'distances', 'preferences'));
    }

    private function normalizeDecisionMatrix($matrix)
    {
        $normalizedMatrix = [];
        $columnSums = array_fill(0, count($matrix[0]), 0);

        // Hitung jumlah kuadrat tiap kolom
        foreach ($matrix as $row) {
            foreach ($row as $j => $value) {
                $columnSums[$j] += pow($value, 2);
            }
        }

        // Hitung normalisasi matriks
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $value) {
                $normalizedMatrix[$i][$j] = $value / (sqrt($columnSums[$j]) ?: 1); // Hindari pembagian dengan nol
            }
        }

        return $normalizedMatrix;
    }

    private function weightNormalizedMatrix($normalizedMatrix, $bobot)
    {
        $weightedNormalizedMatrix = [];

        foreach ($normalizedMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $weightedNormalizedMatrix[$i][$j] = $value * $bobot[$j];
            }
        }

        return $weightedNormalizedMatrix;
    }

    private function calculateIdealSolutions($weightedNormalizedMatrix, $kriteria)
    {
        $idealPositive = [];
        $idealNegative = [];

        foreach ($weightedNormalizedMatrix[0] as $j => $value) {
            $column = array_column($weightedNormalizedMatrix, $j);

            if ($kriteria[$j]->tipe === 'benefit') {
                $idealPositive[$j] = max($column);
                $idealNegative[$j] = min($column);
            } else {
                $idealPositive[$j] = min($column);
                $idealNegative[$j] = max($column);
            }
        }

        return [$idealPositive, $idealNegative];
    }

    private function calculateDistances($weightedNormalizedMatrix, $idealPositive, $idealNegative)
    {
        $distances = [];

        foreach ($weightedNormalizedMatrix as $row) {
            $positiveDistance = 0;
            $negativeDistance = 0;

            foreach ($row as $j => $value) {
                $positiveDistance += pow($value - $idealPositive[$j], 2);
                $negativeDistance += pow($value - $idealNegative[$j], 2);
            }

            $positiveDistance = sqrt($positiveDistance);
            $negativeDistance = sqrt($negativeDistance);

            // Cek jika ada nilai tak terhingga atau sangat besar
            if (is_infinite($positiveDistance) || is_nan($positiveDistance)) {
                $positiveDistance = PHP_FLOAT_MAX; // Atau nilai besar yang aman
            }

            if (is_infinite($negativeDistance) || is_nan($negativeDistance)) {
                $negativeDistance = PHP_FLOAT_MAX; // Atau nilai besar yang aman
            }

            $distances[] = [
                'positive' => $positiveDistance,
                'negative' => $negativeDistance,
            ];
        }

        return $distances;
    }

    private function calculatePreferences($distances)
    {
        $preferences = [];

        foreach ($distances as $distance) {
            $positive = $distance['positive'];
            $negative = $distance['negative'];

            $preference = $negative / ($positive + $negative);
            $preferences[] = $preference;
        }

        return $preferences;
    }
}