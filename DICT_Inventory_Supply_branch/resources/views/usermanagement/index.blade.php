@extends('admin.app')
@section('content')

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    
</head>

@if (Session::has('message'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ Session::get('message') }}",
        });
    </script>
    {{ Session::forget('message') }}
@endif
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2 class="mt-4" style="font-family: Poppins, sans-serif; text-align: left;">
                    <i class='bx bx-user'></i> User Management
                  </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminHome') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">UserManagement</li>
                </ol>
            </div>
            
                    <div class="col-auto d-flex align-items-center ms-auto">  
                        <div class="d-flex">

                            <a href="#" role="button" class="btn fs-6 btn-primary btn-sm me-3" data-toggle="modal" data-target="#addUsersModal">
                                <i class="bi bi-plus-lg" style="margin-right: 5px;"></i>
                                Add Users
                            </a>

                            <!-- Add Users Modal -->
                                                <div class="modal fade" id="addUsersModal" tabindex="-1" role="dialog" aria-labelledby="addUsersModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="addUsersModalLabel">Add Users</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <form id="addUserFormModal" action="{{ route('user-management.store') }}" method="POST" class="needs-validation" novalidate>
                                                        @csrf
                                                        <div class="modal-body">
                                                          <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" required>
                                                            <div class="invalid-feedback">
                                                              Please enter a name.
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" required>
                                                            <div class="invalid-feedback">
                                                              Please enter a valid email address.
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="username">Username</label>
                                                            <input type="text" class="form-control" id="username" name="username" required>
                                                            <div class="invalid-feedback">
                                                              Please enter a username.
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" required>
                                                            <div class="invalid-feedback">
                                                              Please enter a password.
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="password_confirmation">Confirm Password</label>
                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                                            <div class="invalid-feedback">
                                                              Please confirm the password.
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="role">Role</label>
                                                            <select class="form-control" id="role" name="role" required>
                                                              <option value="">Choose a role</option>
                                                              <option value="admin">Admin</option>
                                                              <option value="user">User</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                              Please select a role.
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                          <button type="submit" class="btn btn-primary">Add</button>
                                                        </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                        </div>
                    </div>
                </div>
            </div>

          
        <div class="container">
            <table id="users-table" class="table table-borderless table-striped table-earning" style="border-collapse: collapse; border-spacing: 0; width: 100%; padding: 20px; margin: 20px; margin-right: 20px;">
          
              <thead>
                <tr style="background-color: black; color: white;">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role === 'admin')
                                <span style="background-color: green; color: white; display: inline-block; border-radius: 10%; padding: 5px 5px;">{{ $user->role }}</span>
                            @else
                                <span style="background-color: rgb(96, 96, 236); color: white; display: inline-block; border-radius: 10%; padding: 5px 5px;">{{ $user->role }}</span>
                            @endif
                        </td>
                        <!-- Inside the "Action" column -->
                        <td>              
                          <button type="button" class="btn btn-danger btn-delete-user" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}">Delete</button>
           
                          <!-- Delete Modal -->
                          <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="deleteUserModalLabel{{$user->id}}">Delete User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ route('user-management.destroy', $user->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <div class="modal-body">
                                    <p>Are you sure you want to delete this product?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 14px; padding: 5px; margin: 5px;">Cancel</button>
                                    <button type="submit" class="btn btn-danger" style="font-size: 14px; padding: 5px; margin: 5px;">Delete</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>

                                 
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
<script>
  $(document).ready(function() {
    $('#users-table').DataTable({
      lengthMenu: [10, 25, 50, 100],
    });
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>



</body>
<style>
    #users-table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin: 20px;
    }
    
    #users-table th,
    #users-table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    #users-table th {
      background-color: #000000;
      font-weight: bold;
    }
    
    #users-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    
    #users-table tbody tr:hover {
      background-color: #f1f1f1;
    }
    
    #users-table img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }
    
    #users-table .btn {
      font-size: 14px;
      padding: 5px 10px;
      margin: 5px;
    }
    
    #users-table .btn-success {
      background-color: #28a745;
      color: #fff;
    }
    
    #users-table .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
    
    #users-table .modal-title {
      font-weight: bold;
    }
    
    #users-table .modal-body p {
      margin-bottom: 0;
    }
    
    #users-table .modal-footer .btn-secondary {
      background-color: #6c757d;
      color: #fff;
    }
    
    #users-table .modal-footer .btn-danger {
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

@endsection
