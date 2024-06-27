<?php

namespace App\Http\Controllers;

use App\Models\MatrixScore;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatrixScoreController extends Controller
{
    public function index()
    {
        $data = MatrixScore::with('alternatif')->get();
        $alternatif = Alternatif::all();
        return view("admin.matrixscore", compact('data', 'alternatif'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alternatif_id' => 'required|exists:alternatif,id',
            'c1' => 'required|numeric|max:10',
            'c2' => 'required|numeric|max:10',
            'c3' => 'required|numeric|max:10',
            'c4' => 'required|numeric|max:10',
            'c5' => 'required|numeric|max:10',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = $request->only(['alternatif_id', 'c1', 'c2', 'c3', 'c4', 'c5']);
        MatrixScore::create($data);

        return redirect()->route('admin.matrix');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alternatif_id' => 'required|exists:alternatif,id',
            'c1' => 'required|numeric|max:10',
            'c2' => 'required|numeric|max:10',
            'c3' => 'required|numeric|max:10',
            'c4' => 'required|numeric|max:10',
            'c5' => 'required|numeric|max:10',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $matrixScore = MatrixScore::findOrFail($id);
        $matrixScore->update($request->only(['alternatif_id', 'c1', 'c2', 'c3', 'c4', 'c5']));

        return redirect()->route('admin.matrix');
    }

    public function destroy($id)
    {
        $matrixScore = MatrixScore::findOrFail($id);
        $matrixScore->delete();

        return redirect()->route('admin.matrix');
    }
}