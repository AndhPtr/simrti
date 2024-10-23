@extends('layouts.app', [
'class' => '',
'elementActive' => 'risk',
'pageTitle' => 'Edit Risk'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Risk</h4>
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

                    <form action="{{ route('risks.update', $risk->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kategori_risiko" class="form-label">Kategori Risiko</label>
                            <input type="text" name="kategori_risiko" id="kategori_risiko" class="form-control" value="{{ old('kategori_risiko', $risk->kategori_risiko) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="aset_kritis" class="form-label">Aset Kritis</label>
                            <input type="text" name="aset_kritis" id="aset_kritis" class="form-control" value="{{ old('aset_kritis', $risk->aset_kritis) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="risiko" class="form-label">Risiko</label>
                            <input type="text" name="risiko" id="risiko" class="form-control" value="{{ old('risiko', $risk->risiko) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="penyebab" class="form-label">Penyebab</label>
                            <input type="text" name="penyebab" id="penyebab" class="form-control" value="{{ old('penyebab', $risk->penyebab) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="dampak" class="form-label">Dampak</label>
                            <input type="text" name="dampak" id="dampak" class="form-control" value="{{ old('dampak', $risk->dampak) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="severity" class="form-label">Severity</label>
                            <input type="number" name="severity" id="severity" class="form-control" value="{{ old('severity', $risk->severity) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="occurence" class="form-label">Occurence</label>
                            <input type="number" name="occurence" id="occurence" class="form-control" value="{{ old('occurence', $risk->occurence) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="detection" class="form-label">Detection</label>
                            <input type="number" name="detection" id="detection" class="form-control" value="{{ old('detection', $risk->detection) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="rpn" class="form-label">RPN</label>
                            <input type="number" name="rpn" id="rpn" class="form-control" value="{{ old('rpn', $risk->rpn) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="rpn_level" class="form-label">RPN Level</label>
                            <input type="text" name="rpn_level" id="rpn_level" class="form-control" value="{{ old('rpn_level', $risk->rpn_level) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Risk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const severityInput = document.getElementById('severity');
        const occurenceInput = document.getElementById('occurence');
        const detectionInput = document.getElementById('detection');
        const rpnInput = document.getElementById('rpn');

        function calculateRPN() {
            const severity = parseInt(severityInput.value) || 0;
            const occurence = parseInt(occurenceInput.value) || 0;
            const detection = parseInt(detectionInput.value) || 0;
            const rpn = severity * occurence * detection;
            rpnInput.value = rpn;
        }

        severityInput.addEventListener('input', calculateRPN);
        occurenceInput.addEventListener('input', calculateRPN);
        detectionInput.addEventListener('input', calculateRPN);
    });
</script>
@endsection