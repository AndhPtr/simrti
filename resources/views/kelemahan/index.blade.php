@extends('layouts.app', [
'class' => '',
'elementActive' => 'risk',
'pageTitle' => 'Risks'
])

@section('content')
<div class="content">
    <div class="row">
        <!-- First Table -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kategori Risiko TI</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Kategori Risiko</th>
                                <th>Keterangan Kategori</th>
                            </thead>
                            <tbody>
                                @foreach ($riskcategories as $riskcategory)
                                <tr>
                                    <td>{{ $riskcategory->kategori_risiko }}</td>
                                    <td>{{ $riskcategory->keterangan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Table -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Aset Kritis Organisasi</h4>
                    @can('create-risk')
                    <a href="{{ route('asets.create') }}" class="btn btn-primary btn-sm">Tambah Aset Kritis</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height:500px; overflow-y:auto">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    <th>Kategori Risiko</th>
                                    <th>Aset Kritis</th>
                                    @can('create-risk')
                                    <th class="text-right">Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $currentKategori = null;
                                $rowCount = 0;
                                @endphp

                                @foreach ($asets->sortBy('kategori_id') as $aset)
                                @if ($aset->riskCategories->kategori_risiko !== $currentKategori)
                                @php
                                $currentKategori = $aset->riskCategories->kategori_risiko;
                                $rowCount = DB::table('aset_kritis')
                                ->join('risk_categories', 'aset_kritis.kategori_id', '=', 'risk_categories.id')
                                ->where('risk_categories.kategori_risiko', $currentKategori)
                                ->count();
                                @endphp
                                <tr>
                                    <td rowspan="{{ $rowCount }}">{{ $currentKategori }}</td>
                                    <td>{{ $aset->name }}</td>
                                    @can('create-risk')
                                    <td class="text-right">
                                        <!-- Edit button -->
                                        <a href="{{ route('asets.edit', $aset->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <!-- Delete form -->
                                        <form action="{{ route('asets.destroy', $aset->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                    @endcan
                                </tr>
                                @else
                                <tr>
                                    <td>{{ $aset->name }}</td>
                                    @can('create-risk')
                                    <td class="text-right">
                                        <!-- Edit button -->
                                        <a href="{{ route('asets.edit', $aset->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <!-- Delete form -->
                                        <form action="{{ route('asets.destroy', $aset->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                    @endcan
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Keamanan Aset Organisasi</h4>
                    @can('create-risk')
                    <a href="{{ route('kelemahan.create') }}" class="btn btn-primary">Tambah Keterangan</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    <th>Kategori Risiko</th>
                                    <th>Aset Kritis</th>
                                    <th>Kelemahan</th>
                                    <th>Kebutuhan Keamanan</th>
                                    <th>Praktik Keamanan</th>
                                    @can('create-risk')
                                    <th class="text-right">Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $currentKategori = null;
                                $currentAset = null;
                                $kategoriRisikoCounts = $kelemahan_aset->groupBy(fn($item) => $item->asetKritis->kategori_id)
                                ->map(fn($group) => $group->count());
                                $asetKritisCounts = $kelemahan_aset->groupBy(fn($item) => $item->asetKritis->id)
                                ->map(fn($group) => $group->count());
                                @endphp

                                @foreach ($kelemahan_aset->sortBy(fn($item) => [$item->asetKritis->kategori_id, $item->asetKritis->id]) as $kelemahan_aset)
                                <tr>
                                    @if ($kelemahan_aset->asetKritis->riskCategories->kategori_risiko !== $currentKategori)
                                    @php
                                    $currentKategori = $kelemahan_aset->asetKritis->riskCategories->kategori_risiko;
                                    @endphp
                                    <td rowspan="{{ $kategoriRisikoCounts[$kelemahan_aset->asetKritis->kategori_id] }}">
                                        {{ $currentKategori }}
                                    </td>
                                    @endif

                                    @if ($kelemahan_aset->asetKritis->name !== $currentAset)
                                    @php
                                    $currentAset = $kelemahan_aset->asetKritis->name;
                                    @endphp
                                    <td rowspan="{{ $asetKritisCounts[$kelemahan_aset->asetKritis->id] }}">
                                        {{ $currentAset }}
                                    </td>
                                    @endif

                                    <td>{{ $kelemahan_aset->kelemahan }}</td>
                                    <td>{{ $kelemahan_aset->kebutuhan_keamanan }}</td>
                                    <td>{{ $kelemahan_aset->praktik_keamanan }}</td>
                                    @can('create-risk')
                                    <td class="text-right">
                                        <!-- Edit button -->
                                        <a href="{{ route('kelemahan.edit', $kelemahan_aset->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <!-- Delete form -->
                                        <form action="{{ route('kelemahan.destroy', $kelemahan_aset->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection