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
                    <a href="{{ route('asets.create') }}" class="btn btn-primary btn-sm">Tambah Aset Kritis</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height:500px; overflow-y:auto">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    <th>Kategori Risiko</th>
                                    <th>Aset Kritis</th>
                                    @can('edit-risk' && 'delete-risk')
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
                                    @can('edit-risk' && 'delete-risk')
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
                                    @can('edit-risk' && 'delete-risk')
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
                    <a href="{{ route('risks.create_keterangan') }}" class="btn btn-primary">Tambah Keterangan</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th><a href="{{ route('risks.index', ['sort_by' => 'kategori_id', 'sort_direction' => $sortBy == 'kategori_id' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Kategori Risiko
                                        @if ($sortBy == 'kategori_id')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th>Aset Kritis</th>
                                <th>Kelemahan</th>
                                <th>Kebutuhan Keamanan</th>
                                <th>Praktik Keamanan</th>
                                @can('edit-risk' && 'delete-risk')
                                <th class="text-right">Actions</th>
                                @endcan
                            </thead>
                            <tbody>
                                @foreach ($kelemahan_aset as $kelemahan_aset)
                                <tr>
                                    <td>{{ $kelemahan_aset->asetKritis->riskCategories->kategori_risiko }}</td>
                                    <td>{{ $kelemahan_aset->asetKritis->name }}</td>
                                    <td>{{ $kelemahan_aset->kelemahan }}</td>
                                    <td>{{ $kelemahan_aset->kebutuhan_keamanan }}</td>
                                    <td>{{ $kelemahan_aset->praktik_keamanan }}</td>
                                    @can('edit-risk' && 'delete-risk')
                                    <td class="text-right">
                                        <!-- Edit button -->
                                        <a href="{{ route('risks.edit_keterangan', $kelemahan_aset->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <!-- Delete form -->
                                        <form action="{{ route('risks.destroy', $kelemahan_aset->id) }}" method="POST" style="display:inline-block;">
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