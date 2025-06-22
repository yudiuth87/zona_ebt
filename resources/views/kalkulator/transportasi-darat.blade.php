@extends('layouts.master')

@section('title', 'Kalkulator Karbon - Transportasi Darat')

@push('styles')
<style>
    .calculator-form-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background-color: #FFFDF3;
        border-radius: 20px;
        border: 1px solid #EAEAEA;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        position: relative;
    }
    .form-title {
        background-color: #F0F3D3;
        padding: 10px 25px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 30px;
        font-size: 20px;
        font-weight: 700;
        color: #333;
    }
    .form-section {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #EAEAEA;
    }
    .form-section:last-of-type {
        border-bottom: none;
    }
    .form-section h3 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
        font-weight: 600;
    }
    .selection-grid {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .selection-card {
        padding: 20px;
        border: 2px solid #EAEAEA;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        min-width: 120px;
    }
    .selection-card.selected {
        border-color: #87C34E;
        background-color: #F8FFF2;
    }
    .input-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 40px;
        max-width: 600px;
        margin: 20px auto;
    }
    .input-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .input-group label {
        font-weight: 500;
        margin-bottom: 8px;
        font-size: 14px;
    }
    .input-group input {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #F3F4F6;
    }
    .input-group input.readonly {
        background-color: #E5E7EB;
        cursor: not-allowed;
    }
    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }
    .btn-calc {
        padding: 12px 25px;
        border-radius: 50px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-add {
        background-color: #F0F3D3;
        color: #333;
    }
    .btn-submit {
        background-color: #87C34E;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="calculator-form-container">
    <div style="text-align:center;">
        <span class="form-title">Transportasi Darat</span>
    </div>

    <div class="form-section">
        <h3>Jenis Kendaraan</h3>
        <div class="selection-grid">
            <div class="selection-card" data-group="vehicle">Mobil</div>
            <div class="selection-card" data-group="vehicle">Motor</div>
            <div class="selection-card" data-group="vehicle">Bus</div>
            <div class="selection-card" data-group="vehicle">Kereta</div>
        </div>
    </div>

    <div class="form-section">
        <h3>Jenis Bahan Bakar</h3>
        <div class="selection-grid">
            <div class="selection-card" data-group="fuel">Pertalite</div>
            <div class="selection-card" data-group="fuel">Pertamax</div>
            <div class="selection-card" data-group="fuel">Solar</div>
            <div class="selection-card" data-group="fuel">Electric</div>
        </div>
    </div>

    <div class="form-section">
        <div class="input-grid">
            <div class="input-group">
                <label for="jarak">Jarak (KM)</label>
                <input type="number" id="jarak" placeholder="Contoh: 50">
            </div>
             <div class="input-group">
                <label for="emisi_per_km">Emisi/km (kg CO2 e)</label>
                <input type="text" id="emisi_per_km" class="readonly" readonly>
            </div>
            <div class="input-group">
                <label for="penumpang">Jumlah Penumpang</label>
                <input type="number" id="penumpang" placeholder="Contoh: 1">
            </div>
            <div class="input-group">
                <label for="total_emisi">Total Emisi</label>
                <input type="text" id="total_emisi" class="readonly" readonly>
            </div>
            <div class="input-group">
                <label for="frekuensi">Frekuensi</label>
                <input type="number" id="frekuensi" placeholder="Contoh: 5">
            </div>
        </div>
    </div>

    <div class="button-group">
        <button class="btn-calc btn-add">Tambah Kendaraan</button>
        <button class="btn-calc btn-submit">Lanjutkan</button>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const emissionFactors = {
        'Mobil': {
            'Pertalite': 0.17,
            'Pertamax': 0.18,
            'Solar': 0.18, // Based on Diesel
            'Electric': 0.09
        },
        'Motor': {
            'Pertalite': 0.05, // Based on Bensin
            'Pertamax': 0.05  // Based on Bensin
        },
        'Bus': {
            'Solar': 0.60 // Based on Mini Bus
        },
        'Kereta': {
            'Electric': 0.05 // Based on KRL
        }
    };

    const selectionCards = document.querySelectorAll('.selection-card');
    const jarakInput = document.getElementById('jarak');
    const penumpangInput = document.getElementById('penumpang');
    const frekuensiInput = document.getElementById('frekuensi');
    const emisiPerKmOutput = document.getElementById('emisi_per_km');
    const totalEmisiOutput = document.getElementById('total_emisi');

    function calculateAndDisplayEmissions() {
        const selectedVehicleCard = document.querySelector('.selection-card[data-group="vehicle"].selected');
        const selectedFuelCard = document.querySelector('.selection-card[data-group="fuel"].selected');

        let emisiPerKm = 0;
        if (selectedVehicleCard && selectedFuelCard) {
            const vehicleType = selectedVehicleCard.textContent;
            const fuelType = selectedFuelCard.textContent;
            emisiPerKm = emissionFactors[vehicleType]?.[fuelType] || 0;
        }

        emisiPerKmOutput.value = emisiPerKm.toFixed(2);

        const jarak = parseFloat(jarakInput.value) || 0;
        const penumpang = parseFloat(penumpangInput.value) || 0;
        const frekuensi = parseFloat(frekuensiInput.value) || 0;

        // Rumus: Total Emisi = Jarak * Frekuensi * Emisi/km * Jumlah orang
        const totalEmisi = jarak * frekuensi * emisiPerKm * penumpang;

        totalEmisiOutput.value = totalEmisi.toFixed(2);
    }

    selectionCards.forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll(`.selection-card[data-group="${this.dataset.group}"]`).forEach(c => {
                c.classList.remove('selected');
            });
            this.classList.add('selected');
            calculateAndDisplayEmissions();
        });
    });

    [jarakInput, penumpangInput, frekuensiInput].forEach(input => {
        input.addEventListener('input', calculateAndDisplayEmissions);
    });

    // Initial calculation on page load
    calculateAndDisplayEmissions();
});
</script>
@endpush
@endsection