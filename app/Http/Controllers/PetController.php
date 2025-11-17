<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Owner;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $pets = Pet::with('owner')->orderBy('created_at', 'desc')->paginate(10);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        $owners = Owner::where('phone_verified', true)->get();
        return view('pets.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_data' => 'required|string',
            'owner_id' => 'required|exists:owners,id',
        ]);

        $owner = Owner::findOrFail($request->owner_id);
        
        if (!$owner->phone_verified) {
            return back()->withErrors(['owner_id' => 'Pemilik yang dipilih belum terverifikasi.'])->withInput();
        }

        try {
            $parsedData = $this->petService->parsePetData($request->pet_data);
            
            $existingPet = Pet::where('owner_id', $request->owner_id)
                ->where('name', $parsedData['name'])
                ->where('type', $parsedData['type'])
                ->first();
            
            if ($existingPet) {
                return back()->withErrors(['pet_data' => 'Hewan dengan nama dan jenis yang sama sudah dimiliki oleh pemilik ini.'])->withInput();
            }
            
            $code = $this->petService->generateCode($request->owner_id);
            
            $pet = Pet::create([
                'owner_id' => $request->owner_id,
                'code' => $code,
                'name' => $parsedData['name'],
                'type' => $parsedData['type'],
                'age' => $parsedData['age'],
                'weight' => $parsedData['weight'],
            ]);
            
            return redirect()->route('pets.index')->with('success', 'Data hewan berhasil disimpan dengan kode: ' . $code);
        } catch (\Exception $e) {
            return back()->withErrors(['pet_data' => $e->getMessage()])->withInput();
        }
    }

    public function show(string $id)
    {
        $pet = Pet::with(['owner', 'checkups.treatment'])->findOrFail($id);
        return view('pets.show', compact('pet'));
    }

    public function edit(string $id)
    {
        $pet = Pet::findOrFail($id);
        $owners = Owner::where('phone_verified', true)->get();
        return view('pets.edit', compact('pet', 'owners'));
    }

    public function update(Request $request, string $id)
    {
        $pet = Pet::findOrFail($id);
        
        $request->validate([
            'pet_data' => 'required|string',
            'owner_id' => 'required|exists:owners,id',
        ]);

        $owner = Owner::findOrFail($request->owner_id);
        
        if (!$owner->phone_verified) {
            return back()->withErrors(['owner_id' => 'Pemilik yang dipilih belum terverifikasi.'])->withInput();
        }

        try {
            $parsedData = $this->petService->parsePetData($request->pet_data);
            
            $existingPet = Pet::where('owner_id', $request->owner_id)
                ->where('name', $parsedData['name'])
                ->where('type', $parsedData['type'])
                ->where('id', '!=', $id)
                ->first();
            
            if ($existingPet) {
                return back()->withErrors(['pet_data' => 'Hewan dengan nama dan jenis yang sama sudah dimiliki oleh pemilik ini.'])->withInput();
            }
            
            $pet->update([
                'owner_id' => $request->owner_id,
                'name' => $parsedData['name'],
                'type' => $parsedData['type'],
                'age' => $parsedData['age'],
                'weight' => $parsedData['weight'],
            ]);
            
            return redirect()->route('pets.index')->with('success', 'Data hewan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['pet_data' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        
        return redirect()->route('pets.index')->with('success', 'Data hewan berhasil dihapus.');
    }
}
