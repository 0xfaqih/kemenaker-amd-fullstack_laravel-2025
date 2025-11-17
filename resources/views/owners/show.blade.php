@extends('layouts.app')

@section('title', 'Detail Pemilik')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Detail Pemilik</h1>
    <div class="space-x-2">
        <a href="{{ route('owners.edit', $owner->id) }}" class="bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded">
            Edit
        </a>
        <a href="{{ route('owners.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pemilik</h2>
        <dl class="space-y-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $owner->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Telepon</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $owner->phone }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status Verifikasi</dt>
                <dd class="mt-1">
                    @if($owner->phone_verified)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Terverifikasi
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Belum Terverifikasi
                        </span>
                    @endif
                </dd>
            </div>
            @if($owner->address)
            <div>
                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $owner->address }}</dd>
            </div>
            @endif
        </dl>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">Hewan Peliharaan</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($owner->pets as $pet)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pet->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pet->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pet->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pet->age }} tahun</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pet->weight }} kg</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('pets.show', $pet->id) }}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada hewan peliharaan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
