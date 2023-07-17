@extends('admin.app')
@section('content')

<body style="background: #11101d;">
<div class="container roles-section">
<div class="row">
    <div class="col-lg-12 margin-tb">
    <br>
            <div class="pull-left">
            <a class="btn btn-primary" href="{{ route('roles.index') }}" style="margin-left:96%"> Back</a>
                <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-people" style=""></i> Edit a Role</h2>
            </div>
            <br>
            <ol class="breadcrumb">               
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black"><a href="{{ route('roles.index') }}" style="color:black">Role Management</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Create</li>
            </ol>
        <div class="pull-right">
            
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Permission:</strong>
            <br>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            | &nbsp
            @endforeach
        </div>
    </div>
    <div class="footer">
        <br> 
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</div>
</body>


<style>
    .roles-section {
        background-color:#eae9f3;
        
        /*   background-color: #272543; */
           height: 90vh;
           color:black;
           width: 97%;
           position: relative;
         
           border-radius: 15px
            }

    .footer{
        
        bottom: 300px;
        
        
    }
    
          
</style>
@endsection
