@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'risk',
    'pageTitle' => 'Risks'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Risks Table</h4>
                        <a href="{{ route('risks.create') }}" class="btn btn-primary">Add New Risk</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>Kategori Risiko</th>
                                    <th>Aset Kritis</th>
                                    <th>Risiko</th>
                                    <th>Penyebab</th>
                                    <th>Dampak</th>
                                    <th>Severity</th>
                                    <th>Occurence</th>
                                    <th>Detection</th>
                                    <th>RPN</th>
                                    <th>RPN Level</th>
                                    <th class="text-right">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($risks->sortBy('kategori_id') as $risk)
                                    <tr>
                                        <td>{{ $risk->riskCategories->kategori_risiko }}</td>
                                        <td>{{ $risk->aset_kritis }}</td>
                                        <td>{{ $risk->risiko }}</td>
                                        <td>{{ $risk->penyebab }}</td>
                                        <td>{{ $risk->dampak }}</td>
                                        <td>{{ $risk->severity }}</td>
                                        <td>{{ $risk->occurence }}</td>
                                        <td>{{ $risk->detection }}</td>
                                        <td>{{ $risk->rpn }}</td>
                                        <td>{{ $risk->rpn_level }}</td>
                                        <td class="text-right">
                                            <!-- Edit button -->
                                            <a href="{{ route('risks.edit', $risk->id) }}" class="btn btn-info btn-sm">Edit</a>

                                            <!-- Delete form -->
                                            <form action="{{ route('risks.destroy', $risk->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
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