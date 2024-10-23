@extends('layouts.app', [
'class' => '',
'elementActive' => 'risk',
'pageTitle' => 'Add Risk'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Risk</h4>
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
                    <form action="{{ route('risks.store') }}" method="POST">
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
                            <label for="aset_kritis" class="form-label">Aset Kritis</label>
                            <input type="text" name="aset_kritis" id="aset_kritis" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="risiko" class="form-label">Risiko</label>
                            <input type="text" name="risiko" id="risiko" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="penyebab" class="form-label">Penyebab</label>
                            <input type="text" name="penyebab" id="penyebab" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="dampak" class="form-label">Dampak</label>
                            <input type="text" name="dampak" id="dampak" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="severity" class="form-label">Severity</label>
                            <input type="number" name="severity" id="severity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="occurence" class="form-label">Occurence</label>
                            <input type="number" name="occurence" id="occurence" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="detection" class="form-label">Detection</label>
                            <input type="number" name="detection" id="detection" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="rpn" class="form-label">RPN</label>
                            <input type="number" id="rpn" name="rpn" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="rpn_level" class="form-label">RPN Level</label>
                            <input type="text" name="rpn_level" id="rpn_level" class="form-control" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Risk</button>
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
        const rpnLevelInput = document.getElementById('rpn_level');

        function calculateRPN() {
            const severity = parseInt(severityInput.value) || 0;
            const occurence = parseInt(occurenceInput.value) || 0;
            const detection = parseInt(detectionInput.value) || 0;
            const rpn = severity * occurence * detection;
            rpnInput.value = rpn;
            if (rpnInput.value <= 20){
                rpnLevelInput.value = 'Very Low';
            } else if (rpnInput.value > 20 && rpnInput.value <= 80){
                rpnLevelInput.value = 'Low';
            } else if (rpnInput.value > 80 && rpnInput.value <= 120){
                rpnLevelInput.value = 'Medium';
            } else if (rpnInput.value > 120 && rpnInput.value <= 200){
                rpnLevelInput.value = 'High';
            } else if (rpnInput.value > 200){
                rpnLevelInput.value = 'Very High';
            }
        }

        severityInput.addEventListener('input', calculateRPN);
        occurenceInput.addEventListener('input', calculateRPN);
        detectionInput.addEventListener('input', calculateRPN);

    });
</script>
@endsection