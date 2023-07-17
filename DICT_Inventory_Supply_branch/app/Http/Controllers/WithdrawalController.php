<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\Product;
use App\Models\Recipient;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('product')->get();
        return view('withdrawals.index', compact('withdrawals'));
    }

    public function create()
    {
        $products = Product::all();
        $recipients = Recipient::all();
        return view('withdrawals.create', compact('products', 'recipients'));
    }

    public function store(Request $request)
    {
        $withdrawalsData = $request->input('withdrawals');
    
        if (empty($withdrawalsData)) {
            return redirect()->back()->withErrors('Please fill in at least one withdrawal form.');
        }
    
        try {
            foreach ($withdrawalsData as $index => $withdrawalData) {
                $withdrawalData['id'] = $index + 1; // Generate a unique ID for each form
                $withdrawal = Withdrawal::create($withdrawalData);
                $product = Product::find($withdrawalData['product_id']);
    
                if ($product) {
                    if ($product->quantity >= $withdrawalData['quantity']) {
                        $product->quantity -= $withdrawalData['quantity'];
                        $product->save();
                    } else {
                        return redirect()->back()->withErrors('The quantity of product "' . $product->name . '" is not enough for the withdrawal.');
                    }
                }
            }
    
            return redirect()->route('withdrawals.index')
                ->with('success', 'Withdrawal(s) created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to create withdrawal(s). Please try again.');
        }
    }
    
    
}
