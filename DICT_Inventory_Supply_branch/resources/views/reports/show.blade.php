@extends('admin.app')

@section('content')
    <div class="container roles-section">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <br>
                <div class="pull-left">
                    <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-bar-chart"></i> Reports</h2>
                </div>
                <ol class="breadcrumb">               
                    <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:black">Show</li>
                </ol>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="container">
            <h1>Report Details</h1>
            <p><strong>Report ID:</strong> {{ $report->id }}</p>
            <p><strong>Report Date:</strong> {{ $report->report_date }}</p>
            <p><strong>Table Name:</strong> {{ $report->table_name }}</p>
            
            <h2>Report Data</h2>
            <table class="table">
                <thead>
                    <!-- Dynamically generate table headers based on the selected table structure -->
                    <tr>
                        <th>#</th>
                        @foreach ($headerColumns as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!-- Unserialize the data -->
                    @php
                        $data = unserialize($report->data);
                    @endphp

                    <!-- Iterate over the data and display each row -->
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @foreach ($headerColumns as $column)
                                <td>{{ $item->$column }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
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
