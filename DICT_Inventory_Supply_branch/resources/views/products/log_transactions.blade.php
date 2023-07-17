<!-- Display success or error messages -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('log_transactions.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id" class="form-control" required>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="action">Action:</label>
        <select name="action" id="action" class="form-control" required>
            <option value="add">Add Quantity</option>
            <option value="subtract">Subtract Quantity</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
