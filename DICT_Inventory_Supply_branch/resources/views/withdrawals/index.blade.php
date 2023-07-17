@extends('admin.app')

@section('content')
<body style="background: #11101d;">
    <div class="container-fluid withdrawal-section">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <br>
                <div class="pull-left">
                    <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-arrow-down-circle" style=""></i> Withdrawals</h2>
                </div>
                <br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:black">Withdrawals</li>
                </ol>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('withdrawals.create') }}" style="margin-left:83%"> Add Withdrawals</a>
                </div>
                <br>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    


        <table class="table border-secondary text-center" style="color:black;">
            <tr style="color:black; background-color:#8984bb">
                <th>No</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Remarks</th>
                <th>Created At</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($withdrawals as $key => $withdrawal)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $withdrawal->product->name }}</td>
                <td>{{ $withdrawal->quantity }}</td>
                <td>{{ $withdrawal->remarks }}</td>
                <td>{{ $withdrawal->created_at }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('withdrawals.show', $withdrawal->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('withdrawals.edit', $withdrawal->id) }}">Edit</a>
                    <!-- Delete Button with Confirmation Modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $withdrawal->id }}">Delete</button>

                    <form id="deleteForm{{ $withdrawal->id }}" action="{{ route('withdrawals.destroy', $withdrawal->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $withdrawal->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                    <a type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-decoration:none;"> 
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this withdrawal?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $withdrawal->id }}').submit();">Delete</button>
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
            .withdrawal-section {
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
