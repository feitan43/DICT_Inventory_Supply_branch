@extends('admin.app')

@section('content')

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">

<!-- Select2 CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<link href="https://cdn.datatables.net/v/dt/dt-1.13.5/datatables.min.css" rel="stylesheet"/>
 
<script src="https://cdn.datatables.net/v/dt/dt-1.13.5/datatables.min.js"></script>

</head>


<body style="background: #11101d;">
    <div class="container-fluid products-section">
      <div class="row">
        <div class="col-lg-12 margin-tb">
            <br>
            <div class="d-flex justify-content-between align-items-center">
                <div class="pull-left">
                    <h2 style="font-family: Poppins, sans-serif; text-align: left;">
                        <i class='bi bi-pencil'></i> Stock In/Out
                    </h2>
                </div>
                <div class="d-flex">
                    <a class="btn btn-success" href="{{ route('suppliers.index') }}">
                        <i class="bi bi-people"></i> Supplier
                    </a>
                    <div style="margin-left: 10px;">
                        <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index') }}">Items</a></li>
                <li class="breadcrumb-item active" aria-current="page">Stock In/Out</li>
            </ol>
        </div>
    </div>
    
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
        <div class="container">
        <form action="{{ route('log_transactions.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="product_id">Item:</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <!-- Add options dynamically from the database -->
                    <option value="">-- Select Product --</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-image="{{ asset('uploads/products/'.$product->image) }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="product_image_container" class="form-group">
              <label for="product_image">Product Image:</label>
              <img id="product_image" src="" alt="Product Image" class="img-fluid">
          </div>
            <div class="form-group">
                    <label for="brand">Brand:</label>
                    <input type="text" name="brand" id="brand" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for="supplier_id">Supplier:</label>
                  <select name="supplier_id" id="supplier_id" class="form-control" required>
                      <!-- Add options dynamically from the database -->
                      <option value="">-- Select Supplier --</option>
                      @foreach ($suppliers as $supplier)
                      <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                      @endforeach
                  </select>
              </div>

                <div class="form-group">
                    <label for="quantity">Item Quantity:</label>
                    <input type="text" name="quantity" id="quantity" class="form-control" readonly>
                </div>


                <div class="form-group">
                  <label for="quantity">Quantity to be add or out</label>
                  <input type="text" name="quantity" id="quantity" class="form-control" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                  <small class="form-text text-muted">Please enter a positive whole number.</small>
              </div>
              
              
              

            <div class="form-group">
                <label for="action">Action:</label>
                <select name="action" id="action" class="form-control" required>
                    <option value="Stock In">Stock In</option>
                    <option value="Stock Out">Stock Out</option>
                </select>
            </div>

            <div class="form-group">
                <label for="remarks">Description / Remarks:</label>
                <input type="text" name="remarks" id="remarks" class="form-control">
            </div>
            
            <br>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<br>
<br>

    <div class="container-fluid">

        @if (count($logTransactions) > 0)
            <table id="logs_table" class="display" class="table table-borderless table-striped table-earning" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                <thead>
                    <tr style="background-color: black; color: white;">
                        <th>User</th>
                        <th>Item</th>
                        <th>Brand</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logTransactions as $logTransaction)
                        <tr>
                            <td>{{ $logTransaction->user->name ?? 'N/A' }}</td>
                            <td>{{ $logTransaction->product->name }}</td>
                            <td>{{ $logTransaction->product->brand }}</td>
                            <td>{{ $logTransaction->supplier->name }}</td>
                            <td>{{ $logTransaction->quantity }}</td>
                            <td>{{ ucfirst($logTransaction->action) }}</td>
                            <td>{{ $logTransaction->remarks }}</td>
                            <td>{{ $logTransaction->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No log transactions found.</p>
        @endif
    </div>  

  
     
</body>
</div>

<script>
  var $j = jQuery.noConflict();
  </script>

<script>
  $(document).ready(function() {
      // Initialize DataTable with Buttons extension
      var table = $('#logs_table').DataTable({
          dom: 'lBfrtip',
          lengthMenu: [5, 10, 20, 50],
          buttons: [
              'copy',
              'csv',
              'print'
          ]
      });

      // Update the brand, quantity, and product image when a product is selected
      $('#product_id').on('change', function() {
          var selectedProductId = $(this).val();
          var selectedProductOption = $('option:selected', this);
          var imageUrl = selectedProductOption.attr('data-image');

          if (imageUrl) {
              $('#product_image').attr('src', imageUrl);
          } else {
              $('#product_image').attr('src', '{{ $products }}');
          }

          var selectedProduct = {!! $products !!}.find(function(product) {
              return product.id == selectedProductId;
          });

          if (selectedProduct) {
              $('#brand').val(selectedProduct.brand);
              $('#quantity').val(selectedProduct.quantity);
          } else {
              $('#brand').val('');
              $('#quantity').val('');
          }
      });
  });
</script>

<style>
  #product_image {
      margin: 50px;
      width: 200px; /* Adjust the width as desired */
      height: auto; /* Maintain the aspect ratio */
      max-height: 200px; /* Set a maximum height to avoid excessive size */
  }
</style>

        

<style>
    
    #logs_table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
    }
    
    #logs_table th,
    #logs_table td {
      
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    #logs_table th {
      background-color: #000000;
      font-weight: bold;
    }
    
    #logs_table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    
    #logs_table tbody tr:hover {
      background-color: #f1f1f1;
    }
    
    #logs_table img {

      height: 40px;
      border-radius: 50%;
    }
    
    #logs_table .btn {
      font-size: 14px;
      padding: 5px 10px;
      margin: 5px;
    }
    
    #logs_table .btn-success {
      background-color: #28a745;
      color: #fff;
    }
    
    #logs_table .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
    
    #logs_table .modal-title {
      font-weight: bold;
    }
    
    #logs_table .modal-body p {
      margin-bottom: 0;
    }
    
    #logs_table .modal-footer .btn-secondary {
      background-color: #6c757d;
      color: #fff;
    }
    
    #logs_table .modal-footer .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
    
    .custom-select {
      width: 60px;
      height: 38px;
    }
    
    option {
      font-size: 16px;
    }
    
    #rowsPerPage {
      font-size: 1.5rem;
      
    }
    
    @media (max-width: 768px) {
      .table-container {
        max-height: none;
        overflow-x: scroll;
      }
    }
    
    .table-container {
      overflow-x: auto;
      max-height: 500px;
      margin-bottom: 20px;
    }
    
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border-color: #c3e6cb;
      margin-bottom: 10px;
    }
    
    .alert {
      padding: 0.75rem 1.25rem;
      margin-bottom: 1rem;
      border: 1px solid transparent;
      border-radius: 0.25rem;
    }
    
    .card {
      margin-top: 20px;
    }
    
    .card-header {
      background-color: #007bff;
      color: #fff;
    }
    
    .card-body {
      padding: 20px;
    }
    
    .pagination {
      margin-top: 20px;
    }
    
    .pagination li {
      display: inline-block;
      margin-right: 5px;
    }
    
    .pagination li a {
      padding: 5px 10px;
      background-color: #007bff;
      color: #fff;
      border-radius: 5px;
    }
    
    .pagination li.active a {
      background-color: #fff;
      color: #007bff;
      border: 1px solid #007bff;
    }
    
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    
    table tr {
      animation: fadeIn 1s ease-in-out;
    }
    
    table tr:first-of-type {
      animation: none;
    }

    .container {
  max-width: 95%;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.mt-4 {
    margin-top: 4px;
  }
  .icon {
    margin-right: 5px;
    float: left;
  }
    </style>

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
