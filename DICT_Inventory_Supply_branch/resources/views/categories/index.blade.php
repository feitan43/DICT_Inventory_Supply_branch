@extends('admin.app')

@section('content')
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  

</head>


<body style="background: #11101d;">
  <div class="container-fluid categories-section">
      <div class="row">
          <div class="col">
              <h2 class="mt-4" style="font-family: Poppins, sans-serif; text-align: left; font-size:20px">
                  <i class='bi bi-folder-fill'></i> Categories
                </h2>
              <ol class="breadcrumb" style="font-size:13px">
                  <li class="breadcrumb-item"><a href="{{ route('adminHome') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Categories</li>
              </ol>
          </div>
          <div class="col-auto d-flex align-items-center ms-auto">  
            <div class="d-flex">
              @can('category-create')
                <a href="{{ route('category.create') }}" role="button" class="btn fs-6 btn-primary btn-sm me-3">
                    <i class="bi bi-plus-lg" style="margin-right: 5px;"></i>
                    Add New
                </a>
                @endcan
            </div>
        </div>
      @if (Session::has('message'))
          <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
          {{ Session::forget('message') }}
      @endif
      @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <div class="table-container">
          <table id="categories-table" class="table table-borderless table-striped table-earning">
            <thead style="background-color: #1f1d1d; color: white;">
              <tr>
                  <th scope="col" style="font-size: 13px;">SN</th>
                  <th scope="col" style="font-size: 13px;">Name</th>
                  <th scope="col" style="font-size: 13px;">Description</th>
                  <th scope="col" style="font-size: 13px;">Action</th>
              </tr>
          </thead>
              <tbody>
                  @if (!empty($categories))
                      @foreach ($categories as $key => $cat)
                      <tr>
                        <td style="font-size: 14px;">{{ $categories->firstItem() + $key }}</td>
                        <td style="font-size: 14px; font-weight: 500">{{ $cat->name }}</td>
                        <td style="font-size: 14px;">{{ $cat->description }}</td>
                        <td>
                            <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-success"
                                style="font-size: .7rem; font-weight: 300px; margin: 5px">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('category.destroy', $cat->id) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="id" class="btn btn-danger"
                                    style="font-size: .7rem; font-weight: 300px; margin: 5px">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    
                    
                      @endforeach
                  @else
                      <tr>
                          <td colspan="4">There are no data.</td>
                      </tr>
                  @endif
              </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center">
            {{ $categories->appends(['start' => $categories->firstItem()])->links() }}
        </div>
      </div>
  </div>
</div>

<script>
  $(document).ready(function() {
      $('#categories-table').DataTable( {
          lengthMenu: [5, 10, 20, 50], // Customize the available entries per page
      
      } );
  } );
  </script>







            


    </body>
   
    <style>
    #categories-table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin: 20px;
    }
    
    #categories-table th,
    #categories-table td {
      padding: 5px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    #categories-table th {
      background-color: #000000;
      font-weight: bold;
    }
    
    #categories-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    
    #categories-table tbody tr:hover {
      background-color: #f1f1f1;
    }
    
    #categories-table img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }
    
    #categories-table .btn {
      font-size: 12px;
      padding: 5px 10px;
      margin: 5px;
    }
    
    #categories-table .btn-success {
      background-color: #28a745;
      color: #fff;
    }
    
    #categories-table .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
    
    #categories-table .modal-title {
      font-weight: bold;
    }
    
    #categories-table .modal-body p {
      margin-bottom: 0;
    }
    
    #categories-table .modal-footer .btn-secondary {
      background-color: #6c757d;
      color: #fff;
    }
    
    #categories-table .modal-footer .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
    
    .custom-select {
      width: 60px;
      height: 38px;
    }
    
    option {
      font-size: 14px;
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
