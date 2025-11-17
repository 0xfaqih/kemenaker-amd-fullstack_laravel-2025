@extends('layouts.app')

@section('title', 'Detail Hewan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Detail Hewan</h1>
    <div class="space-x-2">
        <a href="{{ route('pets.edit', $pet->id) }}" class="bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded">
            Edit
        </a>
        <a href="{{ route('pets.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Hewan</h2>
        <dl class="space-y-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Kode Hewan</dt>
                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $pet->code }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pet->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Jenis</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pet->type }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Usia</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pet->age }} tahun</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Berat</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pet->weight }} kg</dd>
            </div>
        </dl>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pemilik</h2>
        <dl class="space-y-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pet->owner->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Telepon</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pet->owner->phone }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status Verifikasi</dt>
                <dd class="mt-1">
                    @if($pet->owner->phone_verified)
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
            @if($pet->owner->address)
            <div>
                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pet->owner->address }}</dd>
            </div>
            @endif
        </dl>
    </div>
</div>

<div class="mt-6 bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">Riwayat Pemeriksaan</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Perawatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pet->checkups as $checkup)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $checkup->checkup_date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $checkup->treatment->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $checkup->notes ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada riwayat pemeriksaan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
