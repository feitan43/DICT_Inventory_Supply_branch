@extends('admin.app')
@section('content')

<body style="background: #11101d;">
<div class="container-fluid user-section">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <br>
            <div class="pull-right">
                <h2 style="font-family: Poppins, sans-serif; text-align: left; font-size:20px"> <i class="bi bi-people" style=""></i> User Management</h2>
            </div>
            <ol class="breadcrumb" style="font-size: 13px">
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">User Management</li>
                
            </ol>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.create') }}" style="margin-right:84%; font-size:.8rem"> Add User</a>
            </div>
            <br>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <form method="GET" action="{{ route('users.index') }}">
    <div class="input-group mx-sm-3 mb-2" style="width:50%; left: 48%;">
        <input type="text" name="search" style="font-size: .8rem" class="form-control" placeholder="Search by name or email" value="{{ $search }}">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" style="font-size: .8rem" type="submit">Search</button>
        </div>
    </div>
</form>

<div class="table-responsive">
    <table id="users-table" class="table border-secondary text-center" style="color:black; font-size:13px;">
        <tr style="color:black; background-color:#8984bb">
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
                @endif
            </td>
            <td>
                @can('user-show')
                <a class="btn btn-info" style="font-size: .7rem; font-weight:500" href="{{ route('users.show',$user->id) }}">
                    <i class="bi bi-eye-fill"></i> Show
                </a>
                @endcan
                
                @can('user-edit')
                <a class="btn btn-primary" style="font-size: .7rem; font-weight:500" href="{{ route('users.edit',$user->id) }}">
                    <i class="bi bi-pencil-fill"></i> Edit
                </a>
                @endcan
                
                <!-- Delete Button with Confirmation Modal -->
                @can('user-delete')
                @if (!$user->hasRole('SuperAdmin'))
                <button type="button" style="font-size: .7rem; font-weight:500" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $user->id }}">
                    <i class="bi bi-trash-fill"></i> Delete
                </button>
                @endif
                @endcan
                

                <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirmDeleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                <a type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-decoration:none;"> 
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this user?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $user->id }}').submit();">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Confirmation Modal -->
            </td>
        </tr>
        @endforeach
    </table>
</div>

    @if (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ Session::get('error') }}",
        });
    </script>
    {{ Session::forget('error') }}
    @endif
    @if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ Session::get('success') }}",
        });
    </script>
    {{ Session::forget('success') }}
    @endif

    @if (Session::has('error1'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ Session::get('error1') }}",
        });
    </script>
    {{ Session::forget('error1') }}
    @endif


    @if (Session::has('create'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ Session::get('create') }}",
        });
    </script>
    {{ Session::forget('create') }}
    @endif

    @if (Session::has('update'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ Session::get('update') }}",
        });
    </script>
    {{ Session::forget('update') }}
    @endif
    <div>
        {!! $data->render() !!}
        <style>
            .user-section {
                background-color:#eae9f3;
        
        /*   background-color: #272543; */
           height: 90vh;
           color:black;
           width: 97%;
         
           border-radius: 15px
            }
        </style>
    </div>
 <!--   <p class="text-center text-secondary"><small>DICT Holy Cross of Davao College Intern</small></p> -->
</div>


        </body>
@endsection
