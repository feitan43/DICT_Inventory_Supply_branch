<?php

namespace App\Models;
namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\UnitOfMeasure;
use Illuminate\Support\Arr;
use App\Models\TransactionLog;
use App\Models\LogTransaction;


use Spatie\Permission\Models\Role;

use App\Models\User;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate();
        $categories = Category::all();
        $logTransactions = LogTransaction::all(); // Assuming you have a LogTransaction model


        return view('products.index', compact('products', 'categories','logTransactions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $unitsOfMeasure = UnitOfMeasure::all();

        return view('products.create', compact('categories','unitsOfMeasure'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|min:3|unique:products,name',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name,"-");
        $product->category_id = $request->category_id;
        $product->subcategory = $request->subcategory;
        $product->description = $request->description;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->unit_of_measure = $request->unit_of_measure;
        $product->quantity = $request->quantity;
        if($request->hasfile('image')){
         $file = $request->file('image');
         $extention = $file->getClientOriginalExtension();
         $filename = time().'.'.$extention;
         $file->move('uploads/products/',$filename);
         $product->image = $filename;
        }
        $product->save();
 
        return redirect()->route('products.index')
        ->with('message' , 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $creationDate = $product->created_at;
    
        return view('products.show', compact('product', 'creationDate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $cat = Product::with('category')->where('id', $id)->first();
        $categoriess = Category::get(['id']);
        $categories = Category::all();
        
    
        // Check if $cat is null and handle the case
        if (is_null($cat)) {
            abort(404); // or handle the error as per your application's logic
        }
    
        return view('products.edit', compact('product', 'cat', 'categories','categoriess'));
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
        $categories = Category::all();
        
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|unique:products,name,'.$product->id,
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $product->name = $request->name;
        $product->slug = Str::slug($request->name,"-");
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        if($request->hasfile('image')){
         $file = $request->file('image');
         $extention = $file->getClientOriginalExtension();
         $filename = time().'.'.$extention;
         $file->move('uploads/products/',$filename);
         $product->image = $filename;   
        }
        $product->update();
 
        return redirect()->route('products.index',compact('categories'))
        ->with('message' , 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
    
        // Check if the product has associated log transactions
        if ($product->logTransactions()->exists()) {
            return redirect()->route('products.index')
                ->with('error', 'Cannot delete the product as it has associated log transactions.');
        }
    
        $product->delete();
        return redirect()->route('products.index')
            ->with('message', 'Product deleted successfully!');
    }

    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
        
         
    }
    



    
    public function showAdjustmentForm($id)
    {
        $product = Product::findOrFail($id);

        return view('products.adjustment', compact('product'));
    }
    /**
     * Adjust the quantity of a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adjustQuantity(Request $request, $id)
    {

        $product = Product::findOrFail($id);
    
        $request->validate([
            'adjustmentType' => 'required|in:add,subtract',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $adjustmentType = $request->input('adjustmentType');
        $quantity = $request->input('quantity');
    
        $currentQuantity = $product->quantity;
    
        if ($adjustmentType === 'add') {
            $newQuantity = $currentQuantity + $quantity;
        } else {
            // Subtract quantity
            if ($quantity > $currentQuantity) {
                return redirect()->back()->with('error', 'Insufficient quantity for subtraction.');
            }
    
            $newQuantity = $currentQuantity - $quantity;
        }
    
        $product->quantity = $newQuantity;
        $product->save();
    
        // Log the transaction
        $this->logTransaction($product->id, $adjustmentType, $quantity);
    
        // Fetch the log transactions
        $logTransactions = LogTransaction::all(); // Assuming you have a LogTransaction model

        return redirect()->route('product.index')->with('message', 'Quantity adjusted successfully.')
            ->with('logTransactions', $logTransactions);
        
    }
    

    private function logTransaction($productId, $adjustmentType, $quantity)
    {
        // Create a log entry for the transaction
        // You can modify this based on your requirements for logging the adjustments
        // For example, you can create a new model named ProductAdjustmentLog to store the adjustment logs
        $log = "Product ID: " . $productId . " | Adjustment Type: " . $adjustmentType . " | Quantity: " . $quantity;
        \Log::info($log);
    }


    
    public function getProducts($categoryId)
    {
        $category = Category::find($categoryId);
        
        if ($category) {
            $products = $category->products;
            return response()->json(['products' => $products]);
        }
        
        return response()->json(['products' => []]);
    }
    
}
