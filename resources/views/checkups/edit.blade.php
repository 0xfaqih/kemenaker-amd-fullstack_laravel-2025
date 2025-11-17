@extends('layouts.app')

@section('title', 'Edit Pemeriksaan')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Pemeriksaan</h1>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('checkups.update', $checkup->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="pet_id" class="block text-sm font-medium text-gray-700 mb-2">Hewan</label>
            <select name="pet_id" id="pet_id" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Pilih Hewan</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" {{ (old('pet_id', $checkup->pet_id) == $pet->id) ? 'selected' : '' }}>
                        {{ $pet->name }} ({{ $pet->code }}) - {{ $pet->owner->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="treatment_id" class="block text-sm font-medium text-gray-700 mb-2">Jenis Perawatan</label>
            <select name="treatment_id" id="treatment_id" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Pilih Jenis Perawatan</option>
                @foreach($treatments as $treatment)
                    <option value="{{ $treatment->id }}" {{ (old('treatment_id', $checkup->treatment_id) == $treatment->id) ? 'selected' : '' }}>
                        {{ $treatment->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="checkup_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pemeriksaan</label>
            <input type="date" name="checkup_date" id="checkup_date" value="{{ old('checkup_date', $checkup->checkup_date->format('Y-m-d')) }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
            <textarea name="notes" id="notes" rows="4" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('notes', $checkup->notes) }}</textarea>
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('checkups.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
