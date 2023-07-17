@extends('admin.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="container-fluid" style="margin: 100px 0">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 50vh;">
            <form action="{{ route('delivery.store') }}" method="post" enctype="multipart/form-data" class="p-3 rounded shadow" style="width: 35rem;" onsubmit="return checkQuantity()">
                @csrf
                <div class="form-group">
                    <h1 class="text-center pb-2 display-6">Withdrawal</h1>
                    <label for="product_id">Product:</label>
                    <select class="form-control form-control-lg" id="product_id" name="product_id" onchange="getProductQuantity()">
                        <option value="">-- Select Product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control form-control-lg" id="quantity" name="quantity" value="{{ old('quantity') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="product_quantity">Product Quantity:</label>
                        <input type="number" class="form-control form-control-lg" id="product_quantity" name="product_quantity" value="" >
                    </div>
                </div>
             
                <div class="form-group">
                    <label for="delivery_date">Delivery Date:</label>
                    <input type="date" class="form-control form-control-lg" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}">
                </div>
    
                <div class="mb-3" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-success float-end"> Add</button>
                    <button type="submit" class="btn btn-primary" onclick="history.go(-1);"> Back</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function getProductQuantity() {
            // Get the selected product ID
            var productId = document.getElementById('product_id').value;
        
            // Send an HTTP request to fetch the product details
            fetch('/products/' + productId)
                .then(response => response.json())
                .then(data => {
                    // Update the product quantity field with the fetched value
                    document.getElementById('product_quantity').value = data.quantity;
                });
        }
        
        function checkQuantity() {
    var quantity = document.getElementById("quantity").value;
    var product_quantity = document.getElementById("product_quantity").value;

    if (quantity < 0 || quantity > product_quantity) {
        alert("Invalid quantity entered!");
        return false;
    }
        }
    </script>
    @endsection