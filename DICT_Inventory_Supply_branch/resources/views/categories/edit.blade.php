@extends('admin.app')

@section('content')
<body style="background: #11101d;">
  <div class="container-fluid categories-section">
    <h1>Category</h1>
   
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <form action="{{ route('category.update', $categories->id) }}" method="POST" class="p-5 rounded shadow"
            style="width: 40rem;">
            @csrf
            @method('PUT')
            <h6 class="text-center pb-1 display-6">Update Category </h6>
            <div class="mb-3">
                <label for="name">Name <sup class="red">*</sup></label>
                <input type="text" id="name" placeholder="Category Name"
                    class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $categories->name }}"
                    required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Description <sup class="red">*</sup></label>
                <textarea type="text" id="description" placeholder="Category description"
                    class="form-control @error('description') is-invalid @enderror" name="description"
                    value="{{ $categories->description }}" required>{{ $categories->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-success"> Update </button>
            </div>
        </form>
    </div>
</div>
</body>
    <style>
    .categories-section {
        background-color:#eae9f3;
        
        /*   background-color: #272543; */
           height: 90vh;
           color:black;
           width: 97%;
           position: relative;
           border-radius: 15px
            }
</style>
@endsection
