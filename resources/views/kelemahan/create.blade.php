@extends('layouts.app', [
'class' => '',
'elementActive' => 'risk',
'pageTitle' => 'Add Keterangan'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Keterangan Keamanan Aset Organisasi</h4>
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
                    <form action="{{ route('kelemahan.store') }}" method="POST">
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
                            <label for="kelemahan" class="form-label">Kelemahan</label>
                            <input type="text" name="kelemahan" id="kelemahan" class="form-control" placeholder="Masukkan kelemahan aset kritis organisasi" required>
                        </div>

                        <div class="mb-3">
                            <label for="kebutuhan_keamanan" class="form-label">Kebutuhan Keamanan</label>
                            <input type="text" name="kebutuhan_keamanan" id="kebutuhan_keamanan" class="form-control" placeholder="Masukkan kebutuhan keamanan dari kelemahan aset kritis" required>
                        </div>

                        <div class="mb-3">
                            <label for="praktik_keamanan" class="form-label">Praktik Keamanan</label>
                            <input type="text" name="praktik_keamanan" id="praktik_keamanan" class="form-control" placeholder="Masukkan praktik keamanan dari kebutuhan keamanan aset" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Keterangan</button>
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
    });
</script>
@endsection