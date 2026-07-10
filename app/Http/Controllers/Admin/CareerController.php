<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->paginate(15);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        $career = new Career();
        return view('admin.careers.form', compact('career'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'type'         => 'required|string|max:100',
            'location'     => 'required|string|max:255',
            'salary'       => 'nullable|string|max:255',
            'description'  => 'required|string',
            'requirements' => 'required|string',
        ]);

        $data['active'] = $request->has('active');

        Career::create($data);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Job posting created successfully.');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.form', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'type'         => 'required|string|max:100',
            'location'     => 'required|string|max:255',
            'salary'       => 'nullable|string|max:255',
            'description'  => 'required|string',
            'requirements' => 'required|string',
        ]);

        $data['active'] = $request->has('active');

        $career->update($data);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Job posting updated successfully.');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')
            ->with('success', 'Job posting deleted successfully.');
    }
}
