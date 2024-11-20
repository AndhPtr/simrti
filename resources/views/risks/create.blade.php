@extends('layouts.app', [
'class' => '',
'elementActive' => 'evaluate',
'pageTitle' => 'Add Risk'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Risk</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('risks.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori Risiko</label>
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="" disabled selected>Silahkan pilih kategori risiko</option>
                                @foreach($riskcategories as $riskcategory)
                                <option value="{{ $riskcategory->id }}"> {{ $riskcategory->kategori_risiko }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="aset_id" class="form-label">Aset Kritis</label>
                            <select class="form-control" id="aset_id" name="aset_id" required>
                                <option value="" disabled selected>Silahkan pilih aset organisasi yang memiliki risiko kegagalan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="risiko" class="form-label">Risiko</label>
                            <input type="text" name="risiko" id="risiko" class="form-control" placeholder="Masukkan risiko kegagalan yang mungkin terjadi" required>
                        </div>

                        <div class="mb-3">
                            <label for="penyebab" class="form-label">Penyebab</label>
                            <input type="text" name="penyebab" id="penyebab" class="form-control" placeholder="Masukkan penyebab dari risiko atau kegagalan" required>
                        </div>

                        <div class="mb-3">
                            <label for="dampak" class="form-label">Dampak</label>
                            <input type="text" name="dampak" id="dampak" class="form-control" placeholder="Masukkan dampak dari kegagalan risiko" required>
                        </div>

                        <div class="mb-3">
                            <label for="severity" class="form-label">Severity</label>
                            <select class="form-control" id="severity" name="severity" required>
                                <option value="" disabled selected>Silahkan pilih tingkat keparahan risiko</option>
                                <option value="1">(1) Sangat Rendah - Tidak ada kerugian finansial atau dampak pada operasional</option>
                                <option value="2">(2) Rendah - Dampak kecil, kerugian finansial atau operasional yang dapat ditangani dengan mudah</option>
                                <option value="3">(3) Sedang - Dampak sedang, kerugian finansial atau operasional yang membutuhkan beberapa usaha untuk pulih</option>
                                <option value="4">(4) Tinggi - Dampak signifikan, kerugian finansial atau operasional yang membutuhkan upaya besar untuk pulih</option>
                                <option value="5">(5) Sangat Tinggi - Dampak sangat besar, kerugian finansial atau operasional yang berdampak jangka panjang</option>
                                <option value="6">(6) Parah - Dampak parah, kerugian finansial atau operasional yang sulit atau tidak mungkin pulih</option>
                                <option value="7">(7) Ekstrim - Dampak ekstrim, kerugian finansial atau operasional yang mengancam kelangsungan bisnis</option>
                                <option value="8">(8) Kritis - Dampak parah, kerugian finansial atau operasional yang dapat menyebabkan kerugian permanen</option>
                                <option value="9">(9) Kehancuran - Dampak hancur, kerugian finansial atau operasional yang dapat menghancurkan bisnis</option>
                                <option value="10">(10) Bencana - Dampak bencana, kerugian finansial atau operasional yang mengancam kelangsungan hidup</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="occurence" class="form-label">Occurence</label>
                            <select class="form-control" id="occurence" name="occurence" required>
                                <option value="" disabled selected>Silahkan pilih tingkat kemungkinan terjadi risiko</option>
                                <option value="1">(1) Sangat Rendah - Satu kali dalam 6-100 tahun</option>
                                <option value="2">(2) Rendah - Satu kali dalam 3-6 tahun</option>
                                <option value="3">(3) Sedang - Satu kali dalam 1-3 tahun</option>
                                <option value="4">(4) Tinggi - Satu kali dalam setahun</option>
                                <option value="5">(5) Sangat Tinggi - Satu kali setiap 6 bulan</option>
                                <option value="6">(6) Parah - Satu kali setiap 3 bulan</option>
                                <option value="7">(7) Ekstrim - Satu kali dalam sebulan</option>
                                <option value="8">(8) Kritis - Satu kali dalam seminggu</option>
                                <option value="9">(9) Kehancuran - Lebih dari satu kali dalam seminggu</option>
                                <option value="10">(10) Bencana - Lebih dari satu kali tiap harinya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="detection" class="form-label">Detection</label>
                            <select class="form-control" id="detection" name="detection" required>
                                <option value="" disabled selected>Silahkan pilih tingkat deteksi terjadi risiko</option>
                                <option value="1">(1) Sangat Efektif - Dapat mendeteksi kegagalan dengan akurasi tinggi</option>
                                <option value="2">(2) Efektif - Dapat mendeteksi kegagalan dengan tingkat keberhasilan yang baik</option>
                                <option value="3">(3) Cukup Efektif - Dapat mendeteksi kegagalan dengan tingkat keberhasilan yang cukup</option>
                                <option value="4">(4) Sedang - Dapat mendeteksi kegagalan secara sebagian dengan tingkat keberhasilan sedang</option>
                                <option value="5">(5) Sedikit Efektif - Tidak dapat mendeteksi kegagalan dengan tingkat keberhasilan yang memadai</option>
                                <option value="6">(6) Kurang Efektif - Tidak dapat mendeteksi kegagalan dengan tingkat keberhasilan yang sedang</option>
                                <option value="7">(7) Tidak Cukup Efektif - Tidak dapat mendeteksi kegagalan dengan tingkat keberhasilan yang cukup</option>
                                <option value="8">(8) Sangat Tidak Efektif - Tidak dapat mendeteksi kegagalan dengan tingkat keberhasilan yang baik</option>
                                <option value="9">(9) Hampir Tidak Terdeteksi - Hampir tidak dapat mendeteksi kegagalan</option>
                                <option value="10">(10) Tidak Terdeteksi - Tidak dapat mendeteksi kegagalan sama sekali</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="rpn" class="form-label">RPN</label>
                            <input type="number" id="rpn" name="rpn" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="rpn_level_display" class="form-label">RPN Level</label>
                            <input type="text" name="rpn_level_display" id="rpn_level_display" class="form-control" readonly>
                            <input type="hidden" name="rpn_level" id="rpn_level">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Risk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const riskcategories = @json($riskcategories);
        const asets = @json($asets);

        const kategoriRisikoSelect = document.getElementById('kategori_id');
        const asetKritisSelect = document.getElementById('aset_id');

        // Listen for changes on Kategori Risiko dropdown
        kategoriRisikoSelect.addEventListener('change', function() {
            const selectedKategoriId = kategoriRisikoSelect.value;

            // Filter the risks by selected category
            const filteredAsetKritis = asets.filter(aset => aset.kategori_id == selectedKategoriId);

            // Clear and populate Aset Kritis dropdown
            asetKritisSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih aset kritis</option>';
            filteredAsetKritis.forEach(aset => {
                const option = document.createElement('option');
                option.value = aset.id;
                option.textContent = aset.name;
                asetKritisSelect.appendChild(option);
            });

            // Clear Risiko dropdown since Aset Kritis changed
            risikoSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih risiko</option>';
        });

        const severityInput = document.getElementById('severity');
        const occurenceInput = document.getElementById('occurence');
        const detectionInput = document.getElementById('detection');
        const rpnInput = document.getElementById('rpn');
        const rpnLevelDisplayInput = document.getElementById('rpn_level_display');
        const rpnLevelInput = document.getElementById('rpn_level');

        function calculateRPN() {
            const severity = parseInt(severityInput.value) || 0;
            const occurence = parseInt(occurenceInput.value) || 0;
            const detection = parseInt(detectionInput.value) || 0;
            const rpn = severity * occurence * detection;
            rpnInput.value = rpn;
            if (rpnInput.value <= 20) {
                rpnLevelInput.value = '5';
                rpnLevelDisplayInput.value = 'Very Low';
            } else if (rpnInput.value > 20 && rpnInput.value <= 80) {
                rpnLevelInput.value = '4';
                rpnLevelDisplayInput.value = 'Low';
            } else if (rpnInput.value > 80 && rpnInput.value <= 120) {
                rpnLevelInput.value = '3';
                rpnLevelDisplayInput.value = 'Medium';
            } else if (rpnInput.value > 120 && rpnInput.value <= 200) {
                rpnLevelInput.value = '2';
                rpnLevelDisplayInput.value = 'High';
            } else if (rpnInput.value > 200) {
                rpnLevelInput.value = '1';
                rpnLevelDisplayInput.value = 'Very High';
            }
        }

        severityInput.addEventListener('input', calculateRPN);
        occurenceInput.addEventListener('input', calculateRPN);
        detectionInput.addEventListener('input', calculateRPN);
    });
</script>
@endsection