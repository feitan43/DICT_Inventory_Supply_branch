@extends('admin.app')

@section('content')

<body style="background: #11101d;">
    <div class="container-fluid products-section">
    <a class="btn btn-primary" href="{{ route('products.index') }}" style="margin-left:96%"> Back</a>
    <div class="d-flex justify-content-center align-items-center" >
        
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="p-5 rounded shadow"
            style="width: 35rem;" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="text-center pb-2 display-6">Product Edit</h1>
            <div class="mb-3">
                <label for="name">Name <sup class="red">*</sup></label>
                <input type="text" id="name" placeholder="Product Name"
                    class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}"
                    required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>  
            <div class="mb-3">
                <label for="category_id">Category<sup class="red">*</sup></label>
                    <select class="chosen-select form-control @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id">
                        <option value="{{ $cat->category->id }}">{{ $cat->category->name }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>  
            <div class="mb-3">
                <label for="price">Price <sup class="red">*</sup></label>
                <input type="number" id="price" step="0.01" placeholder="Product price"
                    class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}"
                    required>
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="quantity">Quantity <sup class="red">*</sup></label>
                    <input type="number" id="quantity" placeholder="Product quantity"
                        class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                        value="{{ $product->quantity }}" readonly>
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
            </div>
            <div class="mb-3">
                <label for="name">Description <sup class="red">*</sup></label>
                <textarea type="text" id="description" placeholder="Product description"
                    class="form-control @error('description') is-invalid @enderror" name="description" value=""
                    required>{{ $product->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image">Image <sup class="red">*</sup></label>
                <input name="image" type="file" id="image" class="form-control @error('image') is-invalid @enderror"
                    value="{{ $product->image }}" onchange="readURL(this);">

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <strong class="red">Minimum 150x33 pixels</strong>
            </div>
            <div class="mb-5 text-center">
                <button type="submit" class="btn btn-success"> update
                </button>
            </div>

            
        </form>
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="view view-sixth">
                        <div>
                            <h5>Your Previous Photo</h5>
                        </div>
                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                confirmButtonText: 'Cool'
            });
        });
    </script>

<style>
    .products-section {
        background-color:#eae9f3;
        
        /*   background-color: #272543; */
           height: 100%;
           color:black;
           width: 97%;
           position: relative;
           border-radius: 15px
            }
</style>

@endsection


