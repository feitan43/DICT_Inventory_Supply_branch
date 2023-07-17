@extends('admin.app')
@section('content')
<body style="background: #11101d;">
    <div class="container-fluid supplier-section">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <br>
                <div class="pull-left">
                    <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-people" style=""></i> Supplier Management</h2>
                </div>
                <br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:black">Supplier Management</li>
                </ol>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('suppliers.create') }}" style="margin-left:83%"> Create New Supplier</a>
                </div>
                <br>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form method="GET" action="{{ route('suppliers.index') }}">
            <div class="input-group mx-sm-3 mb-2" style="width:50%; left: 48%;">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ $search }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <table class="table border-secondary text-center" style="color:black;">
            <tr style="color:black; background-color:#8984bb">
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $supplier)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->contact }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('suppliers.show', $supplier->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('suppliers.edit', $supplier->id) }}">Edit</a>
                    <!-- Delete Button with Confirmation Modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $supplier->id }}">Delete</button>

                    <form id="deleteForm{{ $supplier->id }}" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $supplier->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                    <a type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-decoration:none;"> 
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this supplier?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $supplier->id }}').submit();">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Confirmation Modal -->
                </td>
            </tr>
            @endforeach
        </table>

        <!-- Pagination Links -->

        <style>
            .supplier-section {
                background-color:#eae9f3;
                /* background-color: #272543; */
                height: 90vh;
                color:black;
                width: 97%;
                border-radius: 15px
            }
        </style>
    </div>
</body>
@endsection
