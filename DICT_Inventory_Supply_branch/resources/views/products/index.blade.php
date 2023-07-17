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
        <div class="col">
          <h2 class="mt-4" style="font-family: Poppins, sans-serif; text-align: left; font-size:20px">
            <i class='bx bx-collection icon'></i> Items
          </h2>            
          <ol class="breadcrumb" style="font-size: 13px">
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Items</li>
            </ol>
        </div>
        <div class="col-auto d-flex align-items-center ms-auto">  
            <div class="d-flex">
              @can('product-create')
                <a href="{{ route('products.create') }}" role="button" class="btn fs-7 btn-primary btn-sm me-2">
                    <i class="bi bi-plus-lg" style="margin-right: 5px;"></i>
                    Add Items
                </a>
                @endcan
          <!--      <a href="{{ route('delivery.create') }}" role="button" class="btn fs-6 btn-primary btn-sm me-3">
                    <i class="bi bi-dash-lg" style="margin-right: 5px;"></i>
                    Withdraw
                </a> -->
                <a href="{{ route('log_transactions.index') }}" role="button" class="btn fs-7 btn-primary btn-sm me-2">
                  <i class="bi bi-pencil" style="margin-right: 5px;"></i>
                  Stock In / Out
              </a>
            </div>
        </div>
    </div>


@if (Session::has('message'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ Session::get('message') }}",
        });
    </script>
    {{ Session::forget('message') }}
@endif
@if (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ Session::get('error') }}",
        });
    </script>
    {{ Session::forget('error') }}
@endif
<!--
<form action="{{ route('products.index') }}" method="GET">
    <div class="input-group mb-3" style="margin-top: 5px">
        <div class="input-group-prepend">
            <select class="form-control" name="category" id="category">
                <option value="">All Categories <i class="bi bi-caret-down-fill"></i></option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

--->

  <table id="products-table" class="display" class="table table-borderless table-striped text-center" style="border-collapse: collapse; width: 100%; padding: 20px; margin-right: 10px; margin-left: -1px">

    <thead>
      <tr style="background-color: black; color: white;">
        <th>ID</th>
        <th>Category</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Subcategory</th>
        <th>Amount</th>
        <th>UOM</th>
        <th>Qty</th>
        <th>Status</th>
        <th>Image</th>
        <!--<th>Description</th>-->
        <th>Created at</th> 
        <th style="width: 100px;">Action</th>
      </tr>
    </thead>
    <tbody>
      @if (!empty($products))
        @foreach ($products as $key => $pd)
          <tr>
            <td >{{$key + 1 }}</td>
            <td class="font-weight-regular">{{ $pd->category->name ?? '' }}</td>
            <td>{{ $pd->name }}</td>
            <td>{{ $pd->brand }}</td>
            <td>{{ $pd->subcategory}}</td>
            <td style="width: 100px;">₱ {{ $pd->price }}</td>
            <td>{{ $pd->unit_of_measure }}</td>
            <td>{{ $pd->quantity }}</td>
            
            <td>
              @if ($pd->quantity <= 0)
              <span class="badge bg-danger rounded-pill">Out of Stock</span>
              @else
              <span class="badge bg-success rounded-pill">Available</span>
              @endif
          </td>
          
            
            <td>
              <img src="{{ asset('uploads/products/' . $pd->image) }}" alt="{{ $pd->image }}" height="40px" width="80px" style="border-radius: 50%;">
            </td>
           <!-- <td>{{ $pd->description }}</td> -->
            <td>
              {{ $pd->created_at }}
            </td>
            <td>
              <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bi bi-gear"></i> <!-- Settings Icon -->
                  </button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('products.edit', $pd->id) }}"><i class="bi bi-pencil-square"></i> Edit</a>
                      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$pd->id}}"><i class="bi bi-trash"></i> Delete</button>
                  </div>
              </div>
          
              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal{{$pd->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$pd->id}}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel{{$pd->id}}">Delete Item</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <form action="{{ route('products.destroy', $pd->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <div class="modal-body">
                                  <p>Are you sure you want to delete this item?</p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 14px;padding:5px; margin:5px">Cancel</button>
                                  <button type="submit" class="btn btn-danger" style="font-size: 14px;padding:5px; margin:5px">Delete</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </td>
          
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="10">There are no data.</td>
        </tr>
      @endif
    </tbody>
  </table>

</div>
</div>

<script>
  var $j = jQuery.noConflict();
  </script>

<script>
  $(document).ready(function() {
    var dataTable = $('#products-table').DataTable({
      dom: 'lfBrtip',
      lengthMenu: [10, 25, 50, 100],
    })
  });
</script>
  

</body>
<style>
  .font-weight-regular {
      font-weight: 800;
  }
</style>

    <style>
      #products-table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin: 20px;
      }
      
      #products-table th,
      #products-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }
      
      #products-table th {
        background-color: #000000;
        font-weight: bold;
      }
      #products-table tr{
        font-size: 13px;
      }
      
      #products-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
      }
      
      #products-table tbody tr:hover {
        background-color: #f1f1f1;
      }
      
      #products-table img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
      }
      
      #products-table .btn {
        font-size: 14px;
        padding: 5px 10px;
        margin: 5px;
      }
      
      #products-table .btn-success {
        background-color: #28a745;
        color: #fff;
      }
      
      #products-table .btn-danger {
        background-color: #dc3545;
        color: #fff;
      }
      
      #products-table .modal-title {
        font-weight: bold;
      }
      
      #products-table .modal-body p {
        margin-bottom: 0;
      }
      
      #products-table .modal-footer .btn-secondary {
        background-color: #6c757d;
        color: #fff;
      }
      
      #products-table .modal-footer .btn-danger {
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
        padding: 0.5rem;
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
  font-size: 1px;
}

.pagination li {
  display: inline-block;
}

.pagination li a {
  padding: 5px 10px;
  background-color: #f8f9fa; /* Use a light background color */
  color: #333; /* Use a dark text color */
  border: 1px solid #ccc; /* Add a border */
  text-decoration: none; /* Remove underline from the link */
}

.pagination li.active a {
  background-color: #007bff; /* Use the primary color for the active item */
  color: #fff; /* Use white text color for the active item */
  border-color: #007bff; /* Use the primary color for the active item border */
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
