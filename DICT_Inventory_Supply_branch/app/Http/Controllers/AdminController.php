<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

use App\Models\Category;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $admins = User::get('id');
        $categories = Category::get('id'); $user = auth()->user(); // Retrieve the authenticated user
        $role = $user->roles->first(); 
       
        $products = Product::get('id');
        $changePassword = 'change-password.form';
        $UnitOfMeasure = 'unit_of_measures.index';
      
        $productQuantity = Product::sum('quantity');
        return view('admin.index',compact('admins','categories','products','productQuantity','role','changePassword','UnitOfMeasure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showProfile()
{
    $user = User::find(1); // Replace 1 with the appropriate user ID or logic to retrieve the user
    $role = $user->roles->first();

    return view('admin.app', compact('user','role'));
}
public function showAppView()
{   
    $user = Auth::user(); // Assuming you are using Laravel's authentication
    $role = $user->roles->first();
    return view('admin.app', compact('user','role'));
}

}
