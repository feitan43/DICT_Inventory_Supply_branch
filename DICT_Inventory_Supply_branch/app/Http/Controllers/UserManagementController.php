<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('usermanagement.index', compact('users'));
    }

    public function create()
    {
        return view('usermanagement.create');
    }

    public function store(Request $request)
    {
        // Validate the user input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users', // Add validation for the username field
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);
    
        // Create a new user instance
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->username = $validatedData['username']; // Set the username field
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];
    
        // Save the user to the database
        $user->save();
    
        // Redirect to the index page or perform any other actions
        return redirect()->route('usermanagement.index')->with('message', 'User created successfully');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()
            ->route('usermanagement.index')
            ->with('message', 'User deleted successfully!');
    }
}    