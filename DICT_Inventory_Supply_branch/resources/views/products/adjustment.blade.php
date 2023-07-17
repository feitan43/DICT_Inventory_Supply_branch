@extends('admin.app')

@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<head>
    <title>Adjust Quantity</title>
</head>

<body style="background: #11101d;">
<div class="container-fluid products-section">
    <h1>Adjust Quantity</h1>

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

    <form action="{{ route('product.adjustQuantity', $product->id) }}" method="POST">
        @csrf

        <label for="adjustmentType">Adjustment Type:</label>
        <select name="adjustmentType" id="adjustmentType" required>
            <option value="add">Add Quantity</option>
            <option value="subtract">Subtract Quantity</option>
        </select><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required><br><br>

        <input type="submit" value="Adjust Quantity">
    </form>
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
        </div>
</body>
</html>
<style>
    .products-section {
        background-color:#eae9f3;
        
        /*   background-color: #272543; */
           height: 100%;
           color:black;
           width: 97%;
           position: relative;
           border-radius: 15px
            }
</style>
@endsection
