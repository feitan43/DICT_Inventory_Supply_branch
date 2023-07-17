<!-- resources/views/change-password/form.blade.php -->

@extends('admin.app')

@section('content')
<body style="background: #11101d;">

    <div class="container-fluid user-section">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <br>
            <div class="pull-left">
                <h2 style="font-family: Poppins, sans-serif; text-align: left;"> <i class="bx bx-cog" style=""></i> Settings</h2>
            </div>
            <br>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Change Password</li>
                
            </ol>
           
            <br>
        </div>
    </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius: 10px">
                    <div class="card-header">Change Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('change-password') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="current_password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                                </div>
                            </div>
                            @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ Session::get('error') }}",
        });
    </script>
    {{ Session::forget('error') }}
    @endif
    @if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ Session::get('success') }}",
        });
    </script>
    {{ Session::forget('success') }}
    @endif
    </body>
       <style>
            .user-section {
                background-color:#eae9f3;
        
        /*   background-color: #272543; */
           height: 90vh;
           color:black;
           width: 97%;
         
           border-radius: 15px
            }
        </style>
@endsection
