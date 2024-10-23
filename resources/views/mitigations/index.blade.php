@extends('layouts.app', [
'class' => '',
'elementActive' => 'mitigation',
'pageTitle' => 'Mitigations'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mitigations Table</h4>
                    <a href="{{ route('mitigations.create') }}" class="btn btn-primary">Add New Mitigation</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Kategori Risiko</th>
                                <th>Aset Kritis</th>
                                <th>Risiko</th>
                                <th>RPN</th>
                                <th>RPN Level</th>
                                <th>Tindakan Mitigasi</th>
                                <th class="text-right">Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($mitigations->sortBy(function($mitigation) {
                                return $mitigation->risk->kategori_id;
                                }) as $mitigation)
                                <tr>
                                    <td>{{ $mitigation->risk->riskCategories->kategori_risiko }}</td>
                                    <td>{{ $mitigation->risk->aset_kritis }}</td>
                                    <td>{{ $mitigation->risk->risiko }}</td>
                                    <td>{{ $mitigation->risk->rpn }}</td>
                                    <td>{{ $mitigation->risk->rpn_level }}</td>
                                    <td>{{ $mitigation->tindakan_mitigasi }}</td>
                                    <td class="text-right">
                                        <!-- Edit button -->
                                        <a href="{{ route('mitigations.edit', $mitigation->id) }}" class="btn btn-info btn-sm">Edit</a>

                                        <!-- Delete form -->
                                        <form action="{{ route('mitigations.destroy', $mitigation->id) }}" method="POST" style="display:inline-block;">
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