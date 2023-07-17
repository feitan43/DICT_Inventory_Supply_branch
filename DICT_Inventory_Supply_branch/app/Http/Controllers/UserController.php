<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { $currentUserRole = auth()->user()->roles->first()->name;
        $data = [];
        $query = null; // Initialize the $query variable
        $search = $request->input('search', ''); // Initialize the $search variable

    
        if ($currentUserRole === 'Admin') {
            $employeeRole = Role::where('name', 'Employee')->first();
    
            if ($employeeRole) {
                $data = $employeeRole->users()->orderBy('id', 'DESC')->paginate(5);
            }
        } else {
            $data = User::orderBy('id', 'DESC')->paginate(5);
        }

    // Apply search filter if a search term is provided
    if ($search) {
        if (!$query) {
            $query = User::orderBy('id', 'DESC');
        }

        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%');
        });

        // Add role restriction for Admin user
        if ($currentUserRole === 'Admin') {
            $query->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'Admin')
                  ->orWhere('name', 'SuperAdmin')->orWhere('name', 'admintest');
            });
        }
    }

    if ($query) {
        $data = $query->paginate(5);
    }
    
    
        return view('users.index', compact('data','search'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

         // Check if the authenticated user has the "SuperAdmin" role
    $currentUserRole = auth()->user()->roles->first()->name;
    if ($currentUserRole !== 'SuperAdmin') {
        // If the current user is not "SuperAdmin", prevent assigning the "SuperAdmin" role
        if (in_array('SuperAdmin', $request->input('roles', []))) {
            return redirect()->route('users.index')
                ->with('error', 'You do not have permission to assign the SuperAdmin role.');
        }
    }


    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('create','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password|nullable',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }
    
        $user = User::find($id);
    
        // Prevent users from updating their own role
        if ($user->id === auth()->user()->id ) {
            return redirect()->route('users.index')
                ->with('error', 'You do not have permission to update your own role.');
        }
    
        // Check if the authenticated user has the "SuperAdmin" role
        $currentUserRole = auth()->user()->roles->first()->name;
        if ($currentUserRole !== 'SuperAdmin') {
            // If the current user is not "SuperAdmin", prevent updating the role to "SuperAdmin"
            if (in_array('SuperAdmin', $request->input('roles', []))) {
                return redirect()->route('users.index')
                    ->with('error1', 'You do not have permission to assign the SuperAdmin role.');
            }
            // If the user being updated has the "SuperAdmin" role, prevent changing the role
            $userRole = $user->roles->first()->name;
            if ($userRole === 'SuperAdmin') {
                return redirect()->route('users.index')
                    ->with('error1', 'You do not have permission to change the role of a SuperAdmin user.');
            }
        }
    
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('update', 'User updated successfully');
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
    
        // Check if the authenticated user is trying to delete their own account
        if ($user->id === auth()->user()->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account');
        }
    
        // Check if the user's role is "SuperAdmin"
        $userRole = $user->roles->first();
        if ($userRole->name === 'SuperAdmin') {
            return redirect()->route('users.index')
                ->with('error', 'Superadmin account cannot be deleted');
        }
    
        $user->delete();
    
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete|user-show', ['only' => ['index']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    


}