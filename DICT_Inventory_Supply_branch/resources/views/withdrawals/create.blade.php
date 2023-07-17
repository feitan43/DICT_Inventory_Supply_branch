@extends('admin.app')
@section('content')
    <body style="background: #11101d;">
        <div class="container-fluid supplier-section">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <br>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pull-left">
                            <h2 style="font-family: Poppins, sans-serif; text-align: left;">
                                <i class="bi bi-arrow-down-circle"></i> Create a New Withdrawal
                            </h2>
                        </div>
                        <div class="d-flex">
                            <a class="btn btn-success" href="{{ route('recipients.index') }}">
                                <i class="bi bi-people"></i> Recipient
                            </a>
                            <div style="margin-left: 10px;">
                                <a class="btn btn-primary" href="{{ route('withdrawals.index') }}">Back</a>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'withdrawals.store','method'=>'POST')) !!}
                    @csrf
                        <div id="formContainer">
                            <!-- Add this container to hold the cloned forms -->
                            <div class="row dynamic-form">
                                <!-- Add the dynamic-form class to the row -->
                                <div class="col-xs-12 col-sm-3">
                                    <div class="form-group">
                                        <strong>Product:</strong>
                                        <select name="withdrawals[0][product_id]" class="form-control" required>
                                            <option value="">-- Select Product --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="form-group">
                                        <strong>Quantity:</strong>
                                        {!! Form::number('withdrawals[0][quantity]', null, array('placeholder' => 'Quantity','class' => 'form-control', 'required' => 'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="form-group">
                                        <strong>Remarks:</strong>
                                        {!! Form::textarea('withdrawals[0][remarks]', null, array('placeholder' => 'Remarks','class' => 'form-control','rows' => 3)) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="form-group">
                                        <strong>Recipient:</strong>
                                        <select name="withdrawals[0][recipient_id]" class="form-control" required>
                                            <option value="">-- Select Recipient --</option>
                                            @foreach ($recipients as $recipient)
                                                <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="form-group">
                                        <button class="btn btn-danger cancelButton" type="button">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <br>
                               <!-- <button id="addFormButton" class="btn btn-primary">Add Another Form</button> -->
                                <button type="submit" class="btn btn-primary">Submit All</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </body>

    <style>
        .supplier-section {
            background-color: #eae9f3;
            height: 100%;
            color: black;
            width: 97%;
            position: relative;
            border-radius: 15px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Clone the form and append it when the button is clicked
            $('#addFormButton').click(function(e) {
                e.preventDefault();
                var clonedForm = $('.dynamic-form').first().clone();
                clonedForm.find(':input').val(''); // Clear input values in the cloned form
                clonedForm.find('.cancelButton').show(); // Show the cancel button in the cloned form
                $('#formContainer').append(clonedForm);
            });

            // Remove the cloned form when the cancel button is clicked
            $('#formContainer').on('click', '.cancelButton', function(e) {
                e.preventDefault();
                $(this).closest('.dynamic-form').remove();
            });

            // Hide the cancel button for the initial form
            $('.dynamic-form:first .cancelButton').hide();
        });
    </script>
@endsection
