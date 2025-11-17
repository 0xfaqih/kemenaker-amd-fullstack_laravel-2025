@extends('layouts.app')

@section('title', 'Tambah Pemilik')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Tambah Pemilik</h1>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('owners.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
            <textarea name="address" id="address" rows="3" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="phone_verified" value="1" {{ old('phone_verified') ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-700">Nomor telepon terverifikasi</span>
            </label>
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('owners.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
