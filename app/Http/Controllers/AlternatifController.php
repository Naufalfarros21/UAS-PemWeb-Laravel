<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{
    function alternatif()
    {
        $data = Alternatif::all();
        return view("admin.alternatif", compact('data'));
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'keterangan' => 'required',
            'kode' => 'required'
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = $request->only(['name', 'keterangan', 'kode']);
        Alternatif::create($data);

        return redirect()->route('admin.alternatif');
    }

    function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'keterangan' => 'nullable',
            'kode' => 'required'
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = $request->only(['name', 'keterangan', 'kode']);
        Alternatif::whereId($id)->update($data);

        return redirect()->route('admin.alternatif');
    }

    function delete(Request $request, $id)
    {
        $data = Alternatif::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->route('admin.alternatif');
    }
}
