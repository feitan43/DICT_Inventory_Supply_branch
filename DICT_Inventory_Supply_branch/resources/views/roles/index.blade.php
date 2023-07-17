@extends('admin.app')
@section('content')
<body style="background: #11101d;">
<div class="container roles-section">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <br>
            <div class="pull-left">
                <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-people" style=""></i> Role Management</h2>
            </div>
            <br>
            <ol class="breadcrumb">               
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Role Management</li>
            </ol>
            <div class="pull-right">
                @can('role-create')
                <a class="btn btn-primary" href="{{ route('roles.create') }}" style="margin-left:84%"> Create New Role</a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <br>
    <table class="table border-secondary text-center" style="color:black">
        <tr style="color:black;background-color:#8984bb">
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                @endcan
                @can('role-delete')
                <!-- Delete Button with Confirmation Modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $role->id }}">Delete</button>
                <form id="deleteForm{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirmDeleteModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                <a type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-decoration:none;color:black;">
                                    <span aria-hidden="true">&times;</span>
</a>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this role?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $role->id }}').submit();">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
            </td>
        </tr>
        @endforeach
    </table>
    
</div>

@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ Session::get('success') }}",
        });
    </script>
    {{ Session::forget('sucess') }}
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

<body>


<style>
    .roles-section {
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
