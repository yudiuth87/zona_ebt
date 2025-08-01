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
            $total = $jarak * $emisiPerKm * $frekuensi * $penumpang;
            $result['total_emisi'] = $total;
        }
        $result['biaya_offset'] = ($result['total_emisi']) * 500;
        
        // Simpan ke session
        // Tambahkan lokasi_terpilih dan gambar ke offset_data
        $result['lokasi_terpilih'] = $input['lokasi_terpilih'] ?? 'Proyek Mangrove di Teluk Benoa Bali';
        // (opsional) simpan path gambarnya juga
        $result['lokasi_gambar']    = $input['lokasi_gambar'] ?? '/assets/images/lokasiCarbon/gambar-2.webp';

        $request->session()->put('offset_data', $result);

        return response()->json(['success' => true]);
    }
public function showFormDataDiri(Request $request)
    {
        // Ambil data dari session atau parameter
        $data = [
            'total_emisi' => $request->get('total_emisi', session('offset_data.total_emisi', 0)),
            'biaya_offset' => $request->get('biaya_offset', session('offset_data.biaya_offset', 50000)),
            'jenis_kendaraan' => $request->get('jenis_kendaraan', session('offset_data.jenis_kendaraan', '')),
            'jarak' => $request->get('jarak', session('offset_data.jarak', 0)),
            'penumpang' => $request->get('penumpang', session('offset_data.penumpang', 0)),
            'frekuensi' => $request->get('frekuensi', session('offset_data.frekuensi', '')),
            'bahan_bakar' => $request->get('bahan_bakar', session('offset_data.bahan_bakar', '')),
            'lokasi_terpilih' => $request->get('lokasi_terpilih', session('offset_data.lokasi_terpilih', 'Proyek Mangrove di Teluk Benoa Bali')),
            'lokasi_gambar'   => $request->get('lokasi_gambar', session('offset_data.lokasi_gambar', '/assets/images/lokasiCarbon/gambar-2.webp')),
        // default gambar kalau nggak ada
        ];

        return view('form-data-diri', $data);
    }

    public function submitDataDiri(Request $request)
    {
        // Validasi form
        $validated = $request->validate([
            'nama_perusahaan' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'total_emisi' => 'required|numeric',
            'biaya_offset' => 'required|numeric',
            'lokasi_terpilih' => 'required|string',
            'lokasi_gambar' => 'required|string',
            'bahan_bakar' => 'required|string',
        ]);

        // Simpan data ke session
     session(['form_data' => $validated]);
     return redirect()->route('payment.confirmation');
    }
} 