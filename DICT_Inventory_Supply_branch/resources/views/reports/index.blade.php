@extends('admin.app')
@section('content')
<body style="background: #11101d;">
<div class="container roles-section">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <br>
            <div class="pull-left">
                <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-bar-chart"></i> Reports</h2>
            </div>
            <ol class="breadcrumb">               
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Reports</li>
            </ol>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <form method="POST" action="{{ route('reports.generate') }}">
        @csrf
        <div class="mb-3">
            <label for="report_date" class="form-label">Select Date:</label>
            <input type="date" id="report_date" name="report_date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="table_name" class="form-label">Select Table:</label>
            <select id="table_name" name="table_name" class="form-select">
                <option value="" disabled selected>Select Table</option>
                <option value="users">User Table</option>
                <option value="products">Product Table</option>
                <option value="stock_ins">Stock In Table</option>
                <option value="withdrawals">Withdrawal Table</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
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

<style>
    .roles-section {
        background-color:#eae9f3;
        height: 90vh;
        color:black;
        width: 97%;
        position: relative;
        border-radius: 15px;
    }
</style>

@endsection
