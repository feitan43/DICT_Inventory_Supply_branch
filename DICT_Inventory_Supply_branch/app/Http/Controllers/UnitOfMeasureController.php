<?php

namespace App\Http\Controllers;

use App\Models\UnitOfMeasure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UnitOfMeasureController extends Controller
{
    public function index()
    {
        $unitsOfMeasure = UnitOfMeasure::all();

        return view('unit_of_measures.index', compact('unitsOfMeasure'));
    }

    public function create()
    {
        return view('unit_of_measures.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([   
            'name' => 'required|unique:unit_of_measures',
            'abbreviation' => 'required|unique:unit_of_measures',
        ]);

        UnitOfMeasure::create($validatedData);

        return redirect()->route('unit_of_measures.index')
            ->with('success', 'Unit of measure created successfully.');
    }

    public function edit(UnitOfMeasure $unitOfMeasure)
    {
        return view('unit_of_measures.edit', compact('unitOfMeasure'));
    }

    public function update(Request $request, UnitOfMeasure $unitOfMeasure)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:unit_of_measures,name,' . $unitOfMeasure->id,
            'abbreviation' => 'required|unique:unit_of_measures,abbreviation,' . $unitOfMeasure->id,
        ]);

        $unitOfMeasure->update($validatedData);

        return redirect()->route('unit_of_measures.index')
            ->with('success', 'Unit of measure updated successfully.');
    }

    public function destroy(UnitOfMeasure $unitOfMeasure)
    {
        $unitOfMeasure->delete();

        return redirect()->route('unit_of_measures.index')
            ->with('success', 'Unit of measure deleted successfully.');
    }
}
