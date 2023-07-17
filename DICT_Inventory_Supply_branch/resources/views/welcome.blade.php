<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DICT Inventory Supply</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/DICT-Logo.png') }}" style="width: 50px; height: auto;" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <style>
        /* Custom styles for the login modal */
        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 100px;
            margin-left: 800px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.3s;
        }
    
        .modal-header {
            background-color: #11101d;
            padding-top: 12px;
            padding-bottom: 5px;
            font-size: 36px;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom: none;
            text-align: center;
            justify-self: center;
        }
    
        .modal-title {
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 20px;
        }
    
        .close {
            opacity: 3;
            transition: opacity 0.5s;
            border: none;
            font: 5px
        }
    
        .close:hover {
            opacity: 1;
        }
    
        .modal-body {
            padding: 20px;
            animation: slideIn 0.3s;
            text-align: center; /* Align form inputs in the center */
        }
    
        .form-group {
            text-align: left; /* Reset text-align for form labels */
            margin-bottom: 20px; /* Add margin-bottom for spacing */
        }
    
        .form-group label {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }
    
        .form-control {
                border-radius: 5px;
                font-size: 18px;
                padding: 10px;
                margin: 0 auto; /* Center horizontally */
                max-width: 300px; /* Set maximum width for the inputs */
                margin-left: 20px; /* Add left margin of 20px */
            }

    
        .btn-primary {
            border-color: #11101d;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s;
            font-size: 18px;
            margin-top: 20px;
            display: block; /* Convert the button to a block element for center alignment */
            margin: 0 auto; /* Center horizontally */
            max-width: 200px; /* Set maximum width for the button */
        }
    
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0062cc;
        }
    
        .btn-link {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
    
        .btn-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    
        body {
            background: #f5f5f5;
            background-color: #fff;
            font-family: 'Nunito', sans-serif;
        }
    
        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
    
        .header a {
            text-decoration: none;
            color: #555;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
        }
    
        .header a:hover {
            background-color: #eee;
        }
    
        /* Main content */
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #111010;
            background-image: url('/uploads/dict_background.jpg');
        }
    
        .card img {
            width: 100%;
            height: auto;
        }
    
        /* Responsive styles */
        @media (max-width: 768px) {
            .header h2 {
                font-size: 20px;
            }
    
            .header a {
                font-size: 14px;
            }
        }
    
        .footer {
            background-color: #123;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 21px;
            position: absolute;
            bottom: 0;
            width: 99%;
        }
    
        .footer p {
            margin: 0;
            font-size: 14px;
        }
    
    </style>
    
    
</head>
<body>
    @if (Session::has('message'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ Session::get('message') }}",
        });
    </script>
    {{ Session::forget('message') }}
    @endif

    <header class="header" style="background-color:#123">
        <h2></h2>
        @if (Route::has('login'))
        <nav>
            @auth
            <a href="{{ route('adminHome') }}">Home</a>
            @endauth
        </nav>
        @endif
    </header>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <main class="content">
            <!-- Login Modal -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email">{{ __('Email Add:') }}</label>
                                <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                                @error('email' || 'username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password:') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                {!! NoCaptcha::renderJs('en', false, 'onloadCallback') !!}
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                            </div>
                            <center><button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button></center>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
    <footer class="footer">
        <p>&copy; <a href="http://www.dict.gov.ph" target="blank" style="color: white;">www.dict.gov.ph </a></p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var onloadCallback = function() {
            alert("grecaptcha is ready!");
        };
    </script>

    <script>
        @if ($errors->has('g-recaptcha-response') && empty(old('g-recaptcha-response')))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ $errors->first('g-recaptcha-response') }}',
            });
        @endif
    </script>
</body>
</html>
