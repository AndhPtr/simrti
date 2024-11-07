@extends('layouts.app', [
'class' => '',
'elementActive' => 'mitigation',
'pageTitle' => 'Edit Mitigation'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Mitigation</h4>
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
                    <form action="{{ route('mitigations.update', $mitigation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="risk_categories">Kategori Risiko</label>
                            <select class="form-control" id="risk_categories" name="risk_categories" required>
                                <option value="" disabled>Select Kategori Risiko</option>
                                @foreach($riskcategories as $riskcategory)
                                <option value="{{ $riskcategory->id }}" {{ old('risk_categories', $mitigation->risk->kategori_id) == $riskcategory->id ? 'selected' : '' }}>
                                    {{ $riskcategory->kategori_risiko }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="risk_id">Aset Kritis</label>
                            <select class="form-control" id="risk_id" name="risk_id" required>
                                <option value="" disabled {{ old('risk_id', $mitigation->risk->id) == '' ? 'selected' : '' }}>Silahkan pilih aset kritis</option>
                                @foreach ($risks as $risk)
                                @if ($risk->kategori_id == old('risk_categories', $mitigation->risk->kategori_id))
                                <option value="{{ $risk->id }}" {{ old('risk_id', $mitigation->risk->id) == $risk->id ? 'selected' : '' }}>
                                    {{ $risk->aset_kritis }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="risiko">Risiko</label>
                            <select class="form-control" id="risiko" name="risiko" required>
                                <option value="" disabled {{ old('risiko', $mitigation->risk->risiko) == '' ? 'selected' : '' }}>Silahkan pilih risiko</option>
                                <option value="{{ $mitigation->risk->risiko }}" {{ old('risiko', $mitigation->risk->risiko) == $mitigation->risk->risiko ? 'selected' : '' }}>
                                    {{ $mitigation->risk->risiko }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tindakan_mitigasi">Tindakan Mitigasi</label>
                            <textarea class="form-control" id="tindakan_mitigasi" name="tindakan_mitigasi" required>{{ $mitigation->tindakan_mitigasi }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Mitigation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data from server (risk categories and risks)
        const riskcategories = @json($riskcategories);
        const risks = @json($risks);

        const kategoriRisikoSelect = document.getElementById('risk_categories');
        const asetKritisSelect = document.getElementById('risk_id');
        const risikoSelect = document.getElementById('risiko');

        // Listen for changes on Kategori Risiko dropdown
        kategoriRisikoSelect.addEventListener('change', function() {
            const selectedKategoriId = kategoriRisikoSelect.value;

            // Filter the risks by selected category
            const filteredAsetKritis = risks.filter(risk => risk.kategori_id == selectedKategoriId);

            // Clear and populate Aset Kritis dropdown
            asetKritisSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih aset kritis</option>';
            filteredAsetKritis.forEach(aset => {
                const option = document.createElement('option');
                option.value = aset.id;
                option.textContent = aset.aset_kritis;
                asetKritisSelect.appendChild(option);
            });

            // Clear Risiko dropdown since Aset Kritis changed
            risikoSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih risiko</option>';
        });

        // Listen for changes on Aset Kritis dropdown
        asetKritisSelect.addEventListener('change', function() {
            const selectedAsetKritisId = asetKritisSelect.value;

            // Filter the risks by selected Aset Kritis
            const filteredRisiko = risks.filter(risk => risk.id == selectedAsetKritisId);

            // Clear and populate Risiko dropdown
            risikoSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih risiko</option>';
            filteredRisiko.forEach(risk => {
                const option = document.createElement('option');
                option.value = risk.risiko;
                option.textContent = risk.risiko;
                risikoSelect.appendChild(option);
            });
        });
    });
</script>
@endsection