@extends('admin.app')

@section('content')
    <div class="container">
        <h1>Delivery Records</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Delivery Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($deliveries as $delivery)
    <tr>
        <td>{{ $delivery->id }}</td>
        <td>{{ $delivery->product->name }}</td>
        <td>{{ $delivery->quantity }}</td>
        <td>{{ $delivery->created_at }}</td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
@endsection
