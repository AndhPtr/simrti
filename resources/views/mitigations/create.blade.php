@extends('layouts.app', [
'class' => '',
'elementActive' => 'mitigation',
'pageTitle' => 'Add Mitigation'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Mitigation</h4>
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
                    <form action="{{ route('mitigations.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="risk_categories">Kategori Risiko</label>
                            <select class="form-control" id="risk_categories" name="risk_categories" required>
                                <option value="" disabled selected>Silahkan pilih kategori risiko</option>
                                @foreach($riskcategories as $riskcategory)
                                <option value="{{ $riskcategory->id }}"> {{ $riskcategory->kategori_risiko }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="aset_kritis">Aset Kritis</label>
                            <select class="form-control" id="aset_kritis" name="aset_kritis" required>
                                <option value="" disabled selected>Silahkan pilih aset kritis</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="risk_id">Risiko</label>
                            <select class="form-control" id="risk_id" name="risk_id" required>
                                <option value="" disabled selected>Silahkan pilih risiko</option>
                                <!-- This will be dynamically populated based on Aset Kritis -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tindakan_mitigasi">Tindakan Mitigasi</label>
                            <textarea class="form-control" id="tindakan_mitigasi" name="tindakan_mitigasi" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Mitigation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data from server (risk categories, aset_kritis, and risks)
        const riskcategories = @json($riskcategories); // Contains kategori_id and names
        const asets = @json($asets); // Contains aset_kritis data with kategori_id
        const risks = @json($risks); // Contains risk data with aset_id as foreign key

        const kategoriRisikoSelect = document.getElementById('risk_categories'); // Kategori dropdown
        const asetKritisSelect = document.getElementById('aset_kritis'); // Aset Kritis dropdown
        const risikoSelect = document.getElementById('risk_id'); // Risiko dropdown

        // Listen for changes on Kategori Risiko dropdown
        kategoriRisikoSelect.addEventListener('change', function() {
            const selectedKategoriId = parseInt(kategoriRisikoSelect.value); // Get selected kategori_id

            // Filter aset_kritis by selected kategori_id
            const filteredAsets = asets.filter(aset => aset.kategori_id === selectedKategoriId);

            // Populate Aset Kritis dropdown
            asetKritisSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih aset kritis</option>';
            filteredAsets.forEach(aset => {
                const option = document.createElement('option');
                option.value = aset.id; // aset_kritis ID
                option.textContent = aset.name; // aset_kritis name (replace with your column)
                asetKritisSelect.appendChild(option);
            });

            // Clear Risiko dropdown since Aset Kritis changed
            risikoSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih risiko</option>';
        });

        // Listen for changes on Aset Kritis dropdown
        asetKritisSelect.addEventListener('change', function() {
            const selectedAsetId = parseInt(asetKritisSelect.value); // Get selected aset_kritis ID

            // Filter risks by selected aset_kritis ID
            const filteredRisks = risks.filter(risk => risk.aset_id === selectedAsetId);

            // Populate Risiko dropdown
            risikoSelect.innerHTML = '<option value="" disabled selected>Silahkan pilih risiko</option>';
            filteredRisks.forEach(risk => {
                const option = document.createElement('option');
                option.value = risk.id; // Risk ID
                option.textContent = risk.risiko; // Risk name (replace with your column)
                risikoSelect.appendChild(option);
            });
        });
    });
</script>
@endsection