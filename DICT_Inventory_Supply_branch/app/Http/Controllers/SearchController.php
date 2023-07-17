<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->input('search') . '%');
        }
        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }   
}