<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $users = User::all(); // Assuming you have a User model

        return view('activity-log.index', ['users' => $users]);
    }

  

function __construct()
{
     $this->middleware('permission:recent_login-list', ['only' => ['index']]);
    
   
     
}
}
