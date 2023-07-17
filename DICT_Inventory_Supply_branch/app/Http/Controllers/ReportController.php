<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\LogTransaction;
use App\Models\Withdrawal;
use App\Models\Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   // ReportController.php
public function index()
{
    return view('reports.index');
}

public function generate(Request $request)
{
    $reportDate = $request->input('report_date');
    $tableName = $request->input('table_name');
    $data = [];

    // Fetch data based on the selected table
    switch ($tableName) {
        case 'product_table':
            $data = Product::whereDate('created_at', $reportDate)->get();
            break;
        case 'user_table':
            $data = User::whereDate('created_at', $reportDate)->get();
            break;
        case 'loghistory_table':
            $data = LogHistory::whereDate('created_at', $reportDate)->get();
            break;
        case 'withdrawals_table':
            $data = Withdrawal::whereDate('created_at', $reportDate)->get();
            break;
        default:
            // Handle invalid table name case or provide a fallback behavior
            break;
    }
    
    // Convert the data array to a serialized string
    $serializedData = serialize($data);
    
    // Store the report in the database
    $report = new Report();
    $report->report_date = $reportDate;
    $report->table_name = $tableName;
    $report->data = $serializedData; // Save the serialized data
    $report->save();
    
    // Redirect to the report display page or show the report directly
    return redirect()->route('reports.show', $report->id);
}


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
        $report = Report::findOrFail($id);
    
        // Fetch the actual column names based on the selected table
        $tableName = $report->table_name;
        $headerColumns = [];
    
        switch ($tableName) {
            case 'product_table':
                $headerColumns = ['name', 'price', 'quantity']; // Replace with the actual column names of the product table
                break;
            case 'user_table':
                $headerColumns = ['name', 'email', 'role']; // Replace with the actual column names of the user table
                break;
            // Add cases for other table names with their corresponding column names
            default:
                // Handle invalid table name case or provide a fallback behavior
                break;
        }
    
        return view('reports.show', compact('report', 'headerColumns'));
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
}
