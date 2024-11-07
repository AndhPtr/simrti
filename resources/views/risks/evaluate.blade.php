@extends('layouts.app', [
'class' => '',
'elementActive' => 'evaluate',
'pageTitle' => 'Risks Evaluation'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Risks Table</h4>
                    @can('create-risk')
                    <a href="{{ route('risks.create') }}" class="btn btn-primary">Add New Risk</a>
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
                                <th><a href="{{ route('risks.index', ['sort_by' => 'aset_kritis', 'sort_direction' => $sortBy == 'aset_kritis' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Aset Kritis
                                        @if ($sortBy == 'aset_kritis')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'risiko', 'sort_direction' => $sortBy == 'risiko' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Risiko
                                        @if ($sortBy == 'risiko')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'penyebab', 'sort_direction' => $sortBy == 'penyebab' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Penyebab
                                        @if ($sortBy == 'penyebab')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'dampak', 'sort_direction' => $sortBy == 'dampak' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Dampak
                                        @if ($sortBy == 'dampak')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'severity', 'sort_direction' => $sortBy == 'severity' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Severity
                                        @if ($sortBy == 'severity')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'occurence', 'sort_direction' => $sortBy == 'occurence' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Occurence
                                        @if ($sortBy == 'occurence')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'detection', 'sort_direction' => $sortBy == 'detection' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Detection
                                        @if ($sortBy == 'detection')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'rpn', 'sort_direction' => $sortBy == 'rpn' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">RPN
                                        @if ($sortBy == 'rpn')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                <th><a href="{{ route('risks.index', ['sort_by' => 'rpn_level', 'sort_direction' => $sortBy == 'rpn_level' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">RPN Level
                                        @if ($sortBy == 'rpn_level')
                                        @if ($sortDirection == 'asc')
                                        ↑
                                        @else
                                        ↓
                                        @endif
                                        @endif
                                    </a></th>
                                @can('edit-risk' && 'delete-risk')
                                <th class="text-right">Actions</th>
                                @endcan
                            </thead>
                            <tbody>
                                @foreach ($risks as $risk)
                                @if ($risk['risiko'] != null)
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
                                    @if ($risk->rpn_level == '1')
                                    <td style="background-color: red; text-align:center;">Very High</td>
                                    @elseif ($risk->rpn_level == '2')
                                    <td style="background-color: #FF5C5C; text-align:center;">High</td>
                                    @elseif ($risk->rpn_level == '3')
                                    <td style="background-color: yellow; text-align:center;">Medium</td>
                                    @elseif ($risk->rpn_level == '4')
                                    <td style="background-color: #2BFF00; text-align:center;">Low</td>
                                    @else
                                    <td style="background-color: #99FF85; text-align:center;">Very Low</td>
                                    @endif
                                    @can('edit-risk' && 'delete-risk')
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
</div>
@endsection