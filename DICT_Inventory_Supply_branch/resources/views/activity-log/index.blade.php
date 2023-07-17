    @extends('admin.app')
    @section('content')
    <body style="background: #11101d;">
    <div class="container-fluid history">
        <br>
            <h2 style="font-family: Poppins, sans-serif; text-align: left;">User Login History</h2>
        <br>
            <ol class="breadcrumb">
                
        <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"  style="color:black">Login History</li>
              </ol>
<br>
            <table class="table border-secondary text-center">
                <thead style="color:black; background-color:#8984bb">
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Last Login At</th>
                        <th>Last Login IP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr style="color:black;">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->last_login_at }}</td>
                            <td>{{ $user->last_login_ip }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($users->isEmpty())
                <p>No users found.</p>
            @endif
        </div>
</body>

        <style>
            .history{
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
