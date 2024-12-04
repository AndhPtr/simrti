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
                    @can('create-mitigation')
                    <a href="{{ route('mitigations.create') }}" class="btn btn-primary">Add New Mitigation</a>
                    @endcan
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
                                @can('create-mitigation')
                                <th class="text-right">Actions</th>
                                @endcan
                            </thead>
                            <tbody>
                                @foreach ($mitigations->sortBy(function($mitigation) {
                                return $mitigation->risk->kategori_id;
                                }) as $mitigation)
                                <tr>
                                    <td>{{ $mitigation->risk->asetKritis->riskCategories->kategori_risiko }}</td>
                                    <td>{{ $mitigation->risk->asetKritis->name }}</td>
                                    <td>{{ $mitigation->risk->risiko }}</td>
                                    <td>{{ $mitigation->risk->rpn }}</td>
                                    @if ($mitigation->risk->rpn_level  == '1')
                                    <td style="background-color: red; text-align:center;">Very High</td>
                                    @elseif ($mitigation->risk->rpn_level  == '2')
                                    <td style="background-color: #FF5C5C; text-align:center;">High</td>
                                    @elseif ($mitigation->risk->rpn_level  == '3')
                                    <td style="background-color: yellow; text-align:center;">Medium</td>
                                    @elseif ($mitigation->risk->rpn_level  == '4')
                                    <td style="background-color: #2BFF00; text-align:center;">Low</td>
                                    @else
                                    <td style="background-color: #99FF85; text-align:center;">Very Low</td>
                                    @endif
                                    <td>{{ $mitigation->tindakan_mitigasi }}</td>
                                    @can('create-mitigation')
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