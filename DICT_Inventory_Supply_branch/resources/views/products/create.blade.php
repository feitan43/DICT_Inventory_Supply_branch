@extends('admin.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

<style>
    body {
        background: #11101d;
    }

    .products-section {
        background-color: #eae9f3;
        height: 150%;
        color: black;
        width: 97%;
        position: relative;
        border-radius: 15px;
    }

    .form-wrapper {
       
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        text-align: center;
        font-size: 24px;
     
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        display: block;
        
        font-weight: bold;
    }

    .form-input {
        width: 100%;
   
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-button {
        display: inline-block;
     
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .form-button-primary {
        background-color: #007bff;
    }

    .form-button-secondary {
        background-color: #6c757d;
    }
</style>

<div class="container products-section">
    <br>
    <div class="col" style="margin-top:-1%">
   
        <h2 class="mt-3" >
            <i class="bx bx-collection icon"></i> Items
        </h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminHome') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('products.index') }}">Item</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
        <a class="btn btn-primary" href="{{ route('products.index') }}" style="margin-left:96%"> Back</a>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 50vh;">
        <div class="container-fluid ">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1 class="form-title">Item Create</h1>
                <div class="form-group">
                    <label for="category_id" class="form-label">Category<sup class="red">*</sup></label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">- Category -</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="subcategory" class="form-label">Subcategory<sup class="red">*</sup></label>
                    <select class="form-select" id="subcategory" name="subcategory" required>
                        <option value="">- Select Subcategory -</option>
                        <option value="semi-expendable" {{ old('subcategory') == 'semi-expendable' ? 'selected' : '' }}>Semi-Expendable</option>
                        <option value="expendable" {{ old('subcategory') == 'expendable' ? 'selected' : '' }}>Expendable</option>
                    </select>
                    @error('subcategory')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name" class="form-label">Name<sup class="red">*</sup></label>
                    <input type="text" id="name" placeholder="Item Name" class="form-input" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="brand" class="form-label">Brand<sup class="red">*</sup></label>
                    <input id="brand" placeholder="Brand" class="form-input" name="brand" required>{{ old('brand') }}</input>
                    @error('brand')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="price" class="form-label">Price ₱<sup class="red">*</sup></label>
                    <input type="number" id="price" step="0.01" placeholder="Item price" class="form-input" name="price" value="{{ old('price') }}" required>
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
    <label for="unit_of_measure">{{ __('Unit of Measure') }}</label>
    <select id="unit_of_measure" class="form-control @error('unit_of_measure') is-invalid @enderror" name="unit_of_measure" required>
        <option value="">Select Unit of Measure</option>
        @foreach ($unitsOfMeasure as $unitOfMeasure)
            <option value="{{ $unitOfMeasure->abbreviation }}">{{ $unitOfMeasure->name }}</option>
        @endforeach
    </select>
    @error('unit_of_measure')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    
    <input type="hidden" id="quantity" placeholder="Item quantity" class="form-input" name="quantity" value="0" required readonly>
</div>

              <div class="form-group">
                    <label for="description" class="form-label">Description<sup class="red">*</sup></label>
                    <textarea id="description" placeholder="Description" class="form-input" name="description" required>{{ old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="image" class="form-label">Image<sup class="red">*</sup></label>
                    <input name="image" type="file" id="image" class="form-input" onchange="readURL(this);" value="{{ old('image') }}">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <small class="red">Maximum Size 2MB</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="margin-left: 45%; width:10%;">Add</button>
                 
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Product Created!',
                        text: 'The product has been successfully added.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('products.index') }}";
                        }
                    });
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseText;
                    console.log(errorMessage);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
@endsection

<style>
    .container-fluid {
       
    }
    .form-group {
        
    }
    .form-label {
        display: block;
        font-weight: bold;
       
    }
    .form-input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .btn-success {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-primary {
        background-color: #007BFF;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
    .float-end {
        float: right;
    }
    .red {
        color: red;
    }
    .invalid-feedback {
        color: red;
        display: block;
    }
</style>
