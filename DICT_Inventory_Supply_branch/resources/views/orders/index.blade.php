@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Order list</h1>
        <div class="row">
            {{-- <a href="{{ route('order.create') }}" role="button" class="btn btn-primary btn-sm">Add Order</a> --}}
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                {{ Session::forget('message') }}
            @endif
            <div class="d-flex justify-content-center align-items-center col-8">

                <table class="table table-bordered" style="width: 70%">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%">SN</th>
                            <th scope="col" style="width: 30%">Name</th>
                            <th scope="col" style="width: 40%">Description</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="£" class="btn btn-success" style="font-size: 12px;padding:5px; margin:5px">Edit</a>
                                <form action="£" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="alert('Are you Sure?')"
                                        style="font-size: 12px;padding:5px; margin:5px">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <input type="text" value="" id="name">
                <button class="btn btn-sm btn-primary">Add</button>
            </div>
        </div>
    </div>


@endsection
