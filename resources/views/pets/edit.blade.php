@extends('layouts.app')

@section('title', 'Edit Hewan')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Hewan</h1>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('pets.update', $pet->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="pet_data" class="block text-sm font-medium text-gray-700 mb-2">
                Data Hewan <span class="text-gray-500">(Format: NAMA JENIS USIA BERAT)</span>
            </label>
            <input type="text" name="pet_data" id="pet_data" 
                   value="{{ old('pet_data', $pet->name . ' ' . $pet->type . ' ' . $pet->age . 'Th ' . $pet->weight . 'kg') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: Milo Kucing 2Th 4.5kg" required>
            <p class="mt-1 text-sm text-gray-500">Contoh: Milo Kucing 2Th 4.5kg atau Milo Kucing 2tahun 4,5KG</p>
        </div>

        <div class="mb-4">
            <label for="owner_id" class="block text-sm font-medium text-gray-700 mb-2">Pemilik</label>
            <select name="owner_id" id="owner_id" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Pilih Pemilik</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}" {{ (old('owner_id', $pet->owner_id) == $owner->id) ? 'selected' : '' }}>
                        {{ $owner->name }} - {{ $owner->phone }}
                    </option>
                @endforeach
            </select>
            <p class="mt-1 text-sm text-gray-500">Hanya menampilkan pemilik dengan nomor telepon terverifikasi</p>
        </div>

        <div class="mb-4">
            <p class="text-sm text-gray-600">Kode Hewan: <span class="font-semibold">{{ $pet->code }}</span></p>
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('pets.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
