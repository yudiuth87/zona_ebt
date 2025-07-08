<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OffsetController extends Controller
{
    public function show(Request $request)
    {
        // Ambil data dari session atau query string
        $data = $request->session()->get('offset_data', []);
        return view('offset', $data);
    }

    public function calculate(Request $request)
    {
        // Ambil data dari form kalkulator
        $input = $request->all();
        // Rumus perhitungan emisi
        $jenis = $input['jenis'] ?? 'darat';
        $result = [
            'jenis_kendaraan' => $input['jenis_kendaraan'] ?? '',
            'bahan_bakar' => $input['bahan_bakar'] ?? '',
            'jarak' => $input['jarak'] ?? 0,
            'penumpang' => $input['penumpang'] ?? 1,
            'frekuensi' => $input['frekuensi'] ?? 1,
            'emisi_per_km' => $input['emisi_per_km'] ?? 0,
            'total_emisi' => 0,
            'biaya_offset' => 0,
        ];
        if ($jenis === 'rumah') {
            $daya = $input['daya'] ?? 0;
            $jumlah = $input['jumlah_alat'] ?? 1;
            $durasi = $input['durasi'] ?? 0;
            $frekuensi = $input['frekuensi'] ?? 1;
            $emisiPerKwh = $input['emisi_per_km'] ?? 0;
            $totalKwh = ($daya * $jumlah * $durasi * $frekuensi) / 1000;
            $total = $totalKwh * $emisiPerKwh;
            $result['total_emisi'] = $total;
        } else {
            $jarak = $input['jarak'] ?? 0;
            $penumpang = $input['penumpang'] ?? 1;
            $frekuensi = $input['frekuensi'] ?? 1;
            $emisiPerKm = $input['emisi_per_km'] ?? 0;
            $total = $jarak * $emisiPerKm * $frekuensi;
            $total = $total / ($penumpang ?: 1);
            $result['total_emisi'] = $total;
        }
        $result['biaya_offset'] = round(($result['total_emisi']/1000) * 190000);
        // Simpan ke session
        $request->session()->put('offset_data', $result);
        return response()->json(['success' => true]);
    }
} 