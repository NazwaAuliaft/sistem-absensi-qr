<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()->get();

        return view('attendance', compact('attendances'));
    }

    public function store(Request $request)
    {
        Attendance::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->format('H:i:s'),
            'status' => 'Hadir'
        ]);

        return redirect('/')->with('success', 'Absensi berhasil disimpan');
    }
}
