<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KriteriaController extends Controller
{
    function kriteria()
    {
        $data = Kriteria::get();
        return view("admin.kriteria", compact('data'));
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'kode' => 'required',
            'keterangan' => 'required',
            'bobot' => ['required', 'numeric', 'max:5'],
            'tipe' => ['required', Rule::in(['benefit', 'cost'])],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = $request->only(['name', 'kode', 'keterangan', 'bobot', 'tipe']);
        Kriteria::create($data);

        return redirect()->route('admin.kriteria');
    }

    function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'kode' => 'required',
            'keterangan' => 'nullable',
            'bobot' => ['required', 'numeric', 'max:5'],
            'tipe' => ['required', Rule::in(['benefit', 'cost'])],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = $request->only(['name', 'kode', 'bobot', 'tipe']);
        if ($request->keterangan) {
            $data['keterangan'] = $request->keterangan;
        }

        Kriteria::whereId($id)->update($data);

        return redirect()->route('admin.kriteria');
    }

    function delete(Request $request, $id)
    {
        $data = Kriteria::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->route('admin.kriteria');
    }
}
