@extends('admin.app')
@section('content')
<body style="background: #11101d;">
<div class="container roles-section">
<div class="row">
    <div class="col-lg-12 margin-tb">
    <br>
            <div class="pull-left">
            <a class="btn btn-primary" href="{{ route('roles.index') }}" style="margin-left:96%"> Back</a>
                <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-people" style=""></i> Role</h2>
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
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
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
</style>
@endsection