<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use Illuminate\Http\Request;

class BatteryController extends Controller
{

    public function index()
    {
        $batterys = Battery::all();
        return view('admin.batterys.index', compact('batterys'));
    }


    public function create()
    {
        return view('admin.batterys.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required',
            'price' =>'nullable',
        ]);

        Battery::create($request->all());
        return redirect()->route('batterys.index')->with('success', 'Battery created successfully.');
    }


    public function edit(Battery $battery)
    {
        return view('admin.batterys.edit', compact('battery'));
    }


    public function update(Request $request, Battery $battery)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required',
             'price' =>'nullable',
        ]);

        $battery->update($request->all());
        return redirect()->route('batterys.index')->with('success', 'Battery updated successfully.');
    }


    public function destroy(Battery $battery)
    {
        $battery->delete();
        return redirect()->route('batterys.index')->with('success', 'Battery deleted successfully.');
    }
}
