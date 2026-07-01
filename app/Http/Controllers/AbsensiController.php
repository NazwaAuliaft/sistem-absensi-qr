<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function create()
    {
        return view('absensi');
    }

    public function store(Request $request)
    {
        Absensi::create($request->all());
        return "Data berhasil disimpan!";
    }
}
