@extends('admin.app')

@section('content')
<body style="background: #11101d;">
    <div class="container uom-section">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <a class="btn btn-primary" href="{{ route('unit_of_measures.index') }}" style="margin-left:120%"> Back</a>
                <div class="card">
                    <div class="card-header">{{ __('Edit Unit of Measure') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('unit_of_measures.update', $unitOfMeasure) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $unitOfMeasure->name) }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="abbreviation">{{ __('Abbreviation') }}</label>
                                <input id="abbreviation" type="text" class="form-control @error('abbreviation') is-invalid @enderror" name="abbreviation" value="{{ old('abbreviation', $unitOfMeasure->abbreviation) }}" required>
                                @error('abbreviation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <style>
.uom-section {
    background-color: #eae9f3;
    height: 90vh;
    color: black;
    width: 97%;
    position: relative;
    border-radius: 15px;
}
</style>
@endsection
