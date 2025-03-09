<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Screen;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index()
    {
        $screens = Screen::all();
        return view('admin.screens.index', compact('screens'));
    }

    public function create()
    {
        return view('admin.screens.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Screen::create($request->all());
        return redirect()->route('screens.index');
    }

    public function edit(Screen $screen)
    {
        return view('admin.screens.edit', compact('screen'));
    }

    public function update(Request $request, Screen $screen)
    {
        $request->validate(['name' => 'required']);
        $screen->update($request->all());
        return redirect()->route('screens.index');
    }

    public function destroy(Screen $screen)
    {
        $screen->delete();
        return redirect()->route('screens.index');
    }
}
