@extends('admin.app')
@section('content')
<body style="background: #11101d;">
    <div class="container-fluid supplier-section">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <br>
                <div>
                    <a class="btn btn-primary" href="{{ route('withdrawals.create') }}" style="margin-left:96%"> Back</a>
                </div>
                <div class="pull-left">
                    <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-people" style=""></i> Recipient Management</h2>
                </div>
                <br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:black">Recipient Management</li>
                </ol>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('recipients.create') }}" style="margin-left:83%"> Create New Recipient</a>
                </div>
                <br>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form method="GET" action="{{ route('recipients.index') }}">
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
                <th>Actions</th>
            </tr>
            @foreach ($data as $key => $recipient)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $recipient->name }}</td>
                <td>{{ $recipient->email }}</td>
                <td>{{ $recipient->address }}</td>
                <td>{{ $recipient->contact }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('recipients.show', $recipient->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('recipients.edit', $recipient->id) }}">Edit</a>
                    <!-- Delete Button with Confirmation Modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $recipient->id }}">Delete</button>

                    <form id="deleteForm{{ $recipient->id }}" action="{{ route('recipients.destroy', $recipient->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $recipient->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                    <a type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-decoration:none;"> 
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this recipient?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $recipient->id }}').submit();">Delete</button>
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
        <div class="pagination justify-content-center">
            {!! $data->links() !!}
        </div>

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
