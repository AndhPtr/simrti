@extends('layouts.app', [
'class' => '',
'elementActive' => 'risk',
'pageTitle' => 'Add Aset Kritis'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Aset Kritis</h4>
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
                    <form action="{{ route('asets.store') }}" method="POST">
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
                            <label for="name" class="form-label">Aset Kritis</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan aset organisasi yang memiliki risiko kegagalan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Aset Kritis</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection