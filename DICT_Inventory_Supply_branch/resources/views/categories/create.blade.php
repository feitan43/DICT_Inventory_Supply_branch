@extends('admin.app')

@section('content')

<body style="background: #11101d;">
  <div class="container-fluid categories-section">
    <div id="app"></div>
    <br>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
      <form action="{{ route('category.store') }}" method="POST" class="p-5 rounded shadow" style="width: 40rem;">
        @csrf
        <h3 class="text-center pb-2 display-8">Category Create</h3>
        <div class="form-group">
          <label for="name">Name <sup class="red">*</sup></label>
          <input type="text" id="name" placeholder="Category Name" class="form-control" name="name" value="{{ old('name') }}" required>
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description">Description <sup class="red">*</sup></label>
          <textarea id="description" placeholder="Category Description" class="form-control" name="description" required>{{ old('description') }}</textarea>
          @error('description')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="text-center mb-3">
          <button type="submit" class="btn btn-success">Add</button>
          <a class="btn btn-danger" href="{{ route('category.index') }}"> Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>

<style>
  body {
    background-color: #11101d;
    color: #fff;
  }

  .categories-section {
    background-color: #eae9f3;
    height: 90vh;
    width: 97%;
    position: relative;
    border-radius: 15px;
    padding: 20px;
  }

  .categories-section h2 {
    color: #11101d;
    font-weight: bold;
    margin-top: 20px;
  }

  .categories-section form {
    background-color: #fff;
    padding: 30px;
  }

  .categories-section h3 {
    color: #11101d;
    font-weight: bold;
    margin-bottom: 30px;
  }

  .categories-section label {
    color: #11101d;
    font-weight: bold;
  }

  .categories-section .form-control {
    border: 1px solid #11101d;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
  }


  .red {
    color: red;
  }
</style>

@endsection

<script src="https://unpkg.com/vue@next"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.19/vue.cjs.min.js" integrity="sha512-2ftG6Hks6q07Ca+h8f4WCFWQAZca6bm1klWMAFGev51hiusd6FFaRT+kFWcj1G2KjFgZrns1CuwR8eA4OA0zLw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
  const app = new Vue({
    template: '<h1>Hello Vue With CDN</h1>'
  });
  app.mount("#app");
</script>
