<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::withCount('pets')->orderBy('created_at', 'desc')->paginate(10);
        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:owners,phone',
            'address' => 'nullable|string',
            'phone_verified' => 'boolean',
        ]);

        Owner::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'phone_verified' => $request->has('phone_verified') ? true : false,
        ]);

        return redirect()->route('owners.index')->with('success', 'Data pemilik berhasil disimpan.');
    }

    public function show(string $id)
    {
        $owner = Owner::with('pets')->findOrFail($id);
        return view('owners.show', compact('owner'));
    }

    public function edit(string $id)
    {
        $owner = Owner::findOrFail($id);
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, string $id)
    {
        $owner = Owner::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:owners,phone,' . $id,
            'address' => 'nullable|string',
            'phone_verified' => 'boolean',
        ]);

        $owner->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'phone_verified' => $request->has('phone_verified') ? true : false,
        ]);

        return redirect()->route('owners.index')->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();
        
        return redirect()->route('owners.index')->with('success', 'Data pemilik berhasil dihapus.');
    }
}
