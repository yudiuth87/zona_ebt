<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OffsetController extends Controller
{
    public function show(Request $request)
    {
        try {
            // Ambil data dari session
            $offsetData = $request->session()->get('offset_data', null);
            
            Log::info('=== OFFSET SHOW VIEW ===');
            Log::info('Session offset_data', ['data' => $offsetData]);
            Log::info('All session keys', ['keys' => array_keys($request->session()->all())]);
            
            if (!$offsetData || !isset($offsetData['vehicles']) || empty($offsetData['vehicles'])) {
                Log::warning('No offset data found, redirecting to calculator');
                return redirect('/kalkulator')->with('error', 'Tidak ada data kendaraan. Silakan isi form terlebih dahulu.');
            }
            
            return view('offset');
        } catch (\Exception $e) {
            Log::error('Error in offset show', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return redirect('/kalkulator')->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    public function calculate(Request $request)
    {
        Log::info('=== OFFSET CALCULATE REQUEST START ===');
        
        try {
            Log::info('Request details', [
                'method' => $request->method(),
                'url' => $request->url(),
                'content_type' => $request->header('Content-Type')
            ]);
            Log::info('Raw request data', ['data' => $request->all()]);
            
            // Cek apakah request memiliki data vehicles
            if (!$request->has('vehicles')) {
                Log::error('No vehicles data in request');
                return response()->json([
                    'success' => false,
                    'message' => 'Data kendaraan tidak ditemukan'
                ], 400);
            }

            $vehicles = $request->input('vehicles', []);
            Log::info('Vehicles info', [
                'count' => count($vehicles),
                'first_vehicle' => isset($vehicles[0]) ? $vehicles[0] : 'No vehicles'
            ]);
            
            if (empty($vehicles)) {
                Log::error('Empty vehicles array');
                return response()->json([
                    'success' => false,
                    'message' => 'Data kendaraan kosong'
                ], 400);
            }

            // Validasi dengan rules yang lebih sederhana dulu
            Log::info('Starting validation...');
            
            $rules = [
                'vehicles' => 'required|array|min:1',
                'total_emission' => 'required|numeric|min:0',
            ];
            
            // Validasi basic dulu
            $basicValidated = $request->validate($rules);
            Log::info('Basic validation passed');
            
            // Validasi detail vehicles
            foreach ($vehicles as $index => $vehicle) {
                Log::info('Validating vehicle', ['index' => $index, 'vehicle' => $vehicle]);
                
                if (!isset($vehicle['jenis']) || empty($vehicle['jenis'])) {
                    throw new \Exception("Vehicle $index: jenis is required");
                }
                
                if (!isset($vehicle['jenis_kendaraan']) || empty($vehicle['jenis_kendaraan'])) {
                    throw new \Exception("Vehicle $index: jenis_kendaraan is required");
                }
                
                if (!isset($vehicle['bahan_bakar']) || empty($vehicle['bahan_bakar'])) {
                    throw new \Exception("Vehicle $index: bahan_bakar is required");
                }
                
                if (!isset($vehicle['emisi']) || !is_numeric($vehicle['emisi']) || $vehicle['emisi'] < 0) {
                    throw new \Exception("Vehicle $index: emisi must be a positive number");
                }
            }
            
            Log::info('Vehicle validation passed');
            
            // Hitung total cost
            Log::info('Calculating total cost...');
            $totalCost = 0;
            
            foreach ($vehicles as $vehicle) {
                $emission = floatval($vehicle['emisi']);
                
                if ($vehicle['jenis'] === 'rumah') {
                    $cost = round(($emission / 1000) * 190000);
                } else {
                    $cost = round($emission * 500);
                }
                
                $totalCost += $cost;
                Log::info('Vehicle cost calculated', ['cost' => $cost, 'emission' => $emission]);
            }
            
            Log::info('Total cost calculated', ['total_cost' => $totalCost]);
            
            // Prepare session data
            $sessionData = [
                'vehicles' => $vehicles,
                'total_emission' => floatval($basicValidated['total_emission']),
                'total_cost' => $totalCost,
                'created_at' => now()->toISOString()
            ];
            
            Log::info('Saving to session...');
            Log::info('Session data to save', ['data' => $sessionData]);
            
            // Simpan ke session
            $request->session()->put('offset_data', $sessionData);
            
            // Verify session save
            $savedData = $request->session()->get('offset_data');
            Log::info('Verification - data saved to session', ['saved' => $savedData ? 'YES' : 'NO']);
            
            if (!$savedData) {
                throw new \Exception('Failed to save data to session');
            }
            
            Log::info('=== OFFSET CALCULATE SUCCESS ===');
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'vehicles_count' => count($vehicles),
                'total_cost' => $totalCost,
                'total_emission' => $basicValidated['total_emission'],
                'debug' => [
                    'received_vehicles' => count($vehicles),
                    'session_saved' => true,
                    'timestamp' => now()->toISOString()
                ]
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error', [
                'errors' => $e->errors(),
                'message' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', array_flatten($e->errors())),
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('=== OFFSET CALCULATE ERROR ===');
            Log::error('Error details', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
                'debug' => [
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine(),
                    'timestamp' => now()->toISOString()
                ]
            ], 500);
        }
    }

    public function showFormDataDiri(Request $request)
    {
        try {
            // Ambil data dari checkout_data yang dikirim dari offset page
            $checkoutData = null;
            if ($request->has('checkout_data')) {
                $checkoutData = json_decode($request->input('checkout_data'), true);
            }
            
            // Ambil data dari session sebagai fallback
            $offsetData = $request->session()->get('offset_data', []);
            
            if ($checkoutData) {
                // Gunakan data dari checkout
                $totalEmission = $checkoutData['total_emission'] ?? 0;
                $totalCost = $checkoutData['total_cost'] ?? 0;
                $vehicles = $checkoutData['vehicles'] ?? [];
                
                // Ambil lokasi dari kendaraan pertama sebagai contoh
                $firstVehicle = $vehicles[0] ?? null;
                $selectedLocation = $firstVehicle['selected_location'] ?? null;
                
                $data = [
                    'total_emisi' => $totalEmission,
                    'biaya_offset' => $totalCost,
                    'lokasi_terpilih' => $selectedLocation['nama'] ?? 'Proyek Mangrove di Teluk Benoa Bali',
                    'lokasi_gambar' => $selectedLocation['gambar'] ?? '/assets/images/lokasiCarbon/gambar-2.webp',
                    'bahan_bakar' => $firstVehicle['bahan_bakar'] ?? 'Pertalite',
                ];
                
                // Simpan checkout data ke session untuk digunakan nanti
                $request->session()->put('checkout_data', $checkoutData);
            } else {
                // Fallback ke data session lama
                $data = [
                    'total_emisi' => $offsetData['total_emission'] ?? 0,
                    'biaya_offset' => $offsetData['total_cost'] ?? 50000,
                    'lokasi_terpilih' => 'Proyek Mangrove di Teluk Benoa Bali',
                    'lokasi_gambar' => '/assets/images/lokasiCarbon/gambar-2.webp',
                    'bahan_bakar' => 'Pertalite',
                ];
            }

            return view('form-data-diri', $data);
        } catch (\Exception $e) {
            Log::error('Error in showFormDataDiri', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return redirect('/kalkulator')->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    public function submitDataDiri(Request $request)
    {
        try {
            // Validasi form
            $validated = $request->validate([
                'nama_perusahaan' => 'required|string|max:255', // Diubah menjadi required
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
        } catch (\Exception $e) {
            Log::error('Error in submitDataDiri', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}
