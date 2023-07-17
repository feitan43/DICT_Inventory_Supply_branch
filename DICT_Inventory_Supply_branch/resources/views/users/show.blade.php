@extends('admin.app')
@section('content')
<body style="background: #11101d;">
<div class="container roles-section">
<div class="row">
    <div class="col-lg-12 margin-tb">
    <br>
        <div>
    <a class="btn btn-primary" href="{{ route('users.index') }}" style="margin-left:96%"> Back</a>
</div>
        <div class="pull-left">
        <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bi bi-people" style=""></i> User</h2>
        </div>
        <div class="pull-right">
            
            <br>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black"><a href="{{ route('users.index') }}" style="color:black">User Management</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Create</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <span class="badge rounded-pill bg-dark">{{ $v }}</span>
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
           height: 81vh;
           color:black;
           width: 97%;
           position: relative;
           border-radius: 15px
            }
</style>
@endsection