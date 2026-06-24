<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()->get();

        $total = $attendances->count();

        $hadirHariIni = $attendances
            ->where('tanggal', today()->toDateString())
            ->count();

        $hadir = $attendances
            ->where('status', 'Hadir')
            ->count();

        $izin = $attendances
            ->where('status', 'Izin')
            ->count();

        $sakit = $attendances
            ->where('status', 'Sakit')
            ->count();

        $alpha = $attendances
            ->where('status', 'Alpha')
            ->count();

        return view('attendance', compact(
            'attendances',
            'total',
            'hadirHariIni',
            'hadir',
            'izin',
            'sakit',
            'alpha'
        ));
    }

    public function store(Request $request)
    {
        Attendance::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->format('H:i:s'),
            'status' => $request->status
        ]);

        return redirect('/')
            ->with('success', 'Absensi berhasil disimpan');
    }
}