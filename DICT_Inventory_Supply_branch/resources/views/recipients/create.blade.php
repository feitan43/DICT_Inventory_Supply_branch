@extends('admin.app')
@section('content')
<body style="background: #11101d;">
    <div class="container-fluid recipient-section">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <br>
                <div>
                    <a class="btn btn-primary" href="{{ route('recipients.index') }}" style="margin-left:96%"> Back</a>
                </div>
                <div class="pull-left">
                    <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-person" style=""></i> Create a New Recipient</h2>
                </div>
                <div class="pull-right">
                    <br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color:black"><a href="{{ route('recipients.index') }}" style="color:black">Recipient Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color:black">Create</li>
                    </ol>
                </div>
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        {!! Form::open(array('route' => 'recipients.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    {!! Form::textarea('address', null, array('placeholder' => 'Address','class' => 'form-control','rows' => 3)) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contact:</strong>
                    {!! Form::text('contact', null, array('placeholder' => 'Contact','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</body>

<style>
    .recipient-section {
        background-color: #eae9f3;
        height: 100%;
        color: black;
        width: 97%;
        position: relative;
        border-radius: 15px;
    }
</style>
@endsection
