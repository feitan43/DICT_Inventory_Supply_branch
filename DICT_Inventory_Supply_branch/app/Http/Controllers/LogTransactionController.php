<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\LogTransaction;
use App\Models\Recipient;
use App\Models\Supplier;


class LogTransactionController extends Controller
{

    public function getProductDetails($id)
{
    $product = Product::findOrFail($id);

    return response()->json([
        'brand' => $product->brand,
        'image_url' => $product->image_url,
    ]);
}

    public function index()
    {
        $recipients = Recipient::all();
        $logTransactions = LogTransaction::with('user')->get();
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('log_transactions.index', compact('logTransactions', 'products', 'recipients', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer',
            'action' => 'required|in:Stock In,Stock Out',
            'remarks' => 'nullable',
        ]);


        $product = Product::findOrFail($validatedData['product_id']);

        if ($validatedData['action'] === 'Stock Out' && $product->quantity < $validatedData['quantity']) {
            return redirect()->back()->with('error', 'Insufficient quantity');
        }

        $logTransaction = new LogTransaction();
        $logTransaction->user_id = auth()->user()->id;
        $logTransaction->product_id = $request->input('product_id');
        $logTransaction->supplier_id = $request->input('supplier_id');
        $logTransaction->quantity = $request->input('quantity');
        $logTransaction->action = $request->input('action');
        $logTransaction->remarks = $request->input('remarks');

        $product = Product::find($request->product_id);

    if ($product) {
        // Set the product's brand and image URL in the log transaction
        $logTransaction->brand = $product->brand;
        //$logTransaction->image_url = $product->image_url;
    }
        $logTransaction->save();

        if ($validatedData['action'] === 'Stock In') {
            $product->quantity += $validatedData['quantity'];
        } else {
            $product->quantity -= $validatedData['quantity'];
        }
        $logTransaction->update($validatedData);

        $product->save();

      return redirect()->route('log_transactions.index')->with('success', 'Log transaction created successfully.');
    }
}
