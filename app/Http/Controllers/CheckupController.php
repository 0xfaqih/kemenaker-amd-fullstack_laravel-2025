<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Pet;
use App\Models\Treatment;
use Illuminate\Http\Request;

class CheckupController extends Controller
{
    public function index()
    {
        $checkups = Checkup::with(['pet.owner', 'treatment'])
            ->orderBy('checkup_date', 'desc')
            ->paginate(10);
        return view('checkups.index', compact('checkups'));
    }

    public function create()
    {
        $pets = Pet::with('owner')->get();
        $treatments = Treatment::all();
        return view('checkups.create', compact('pets', 'treatments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'treatment_id' => 'required|exists:treatments,id',
            'checkup_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Checkup::create([
            'pet_id' => $request->pet_id,
            'treatment_id' => $request->treatment_id,
            'checkup_date' => $request->checkup_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('checkups.index')->with('success', 'Data pemeriksaan berhasil disimpan.');
    }

    public function show(string $id)
    {
        $checkup = Checkup::with(['pet.owner', 'treatment'])->findOrFail($id);
        return view('checkups.show', compact('checkup'));
    }

    public function edit(string $id)
    {
        $checkup = Checkup::findOrFail($id);
        $pets = Pet::with('owner')->get();
        $treatments = Treatment::all();
        return view('checkups.edit', compact('checkup', 'pets', 'treatments'));
    }

    public function update(Request $request, string $id)
    {
        $checkup = Checkup::findOrFail($id);
        
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'treatment_id' => 'required|exists:treatments,id',
            'checkup_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $checkup->update([
            'pet_id' => $request->pet_id,
            'treatment_id' => $request->treatment_id,
            'checkup_date' => $request->checkup_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('checkups.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $checkup = Checkup::findOrFail($id);
        $checkup->delete();
        
        return redirect()->route('checkups.index')->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
}
