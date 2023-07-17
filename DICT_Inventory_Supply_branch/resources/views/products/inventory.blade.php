@extends('admin.app')

@section('content')

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>

<body>
<h1>Log Transaction</h1>

<p>Product: {{ $product->name }}</p>

@if (Session::has('message'))
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ Session::get('message') }}",
        });
    </script>
    {{ Session::forget('message') }}
@endif
@if (isset($logTransactions) && $logTransactions->count() > 0)
    <h2>Log Transactions:</h2>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Adjustment Type</th>
                <th>Quantity</th>
                <!-- Add more table headers if needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($logTransactions as $logTransaction)
                <tr>
                    <td>{{ $logTransaction->product_id }}</td>
                    <td>{{ $logTransaction->adjustment_type }}</td>
                    <td>{{ $logTransaction->quantity }}</td>
                    <!-- Display more columns if needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No log transactions available.</p>
@endif


<script>
    $(document).ready(function () {
        $('#logTransactionsTable').DataTable();
    });
</script>
</body>
@endsection