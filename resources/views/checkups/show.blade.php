@extends('layouts.app')

@section('title', 'Detail Pemeriksaan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Detail Pemeriksaan</h1>
    <div class="space-x-2">
        <a href="{{ route('checkups.edit', $checkup->id) }}" class="bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-2 px-4 rounded">
            Edit
        </a>
        <a href="{{ route('checkups.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pemeriksaan</h2>
        <dl class="space-y-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->checkup_date->format('d/m/Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Jenis Perawatan</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->treatment->name }}</dd>
            </div>
            @if($checkup->treatment->description)
            <div>
                <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->treatment->description }}</dd>
            </div>
            @endif
            @if($checkup->notes)
            <div>
                <dt class="text-sm font-medium text-gray-500">Catatan</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->notes }}</dd>
            </div>
            @endif
        </dl>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Hewan</h2>
        <dl class="space-y-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Kode Hewan</dt>
                <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $checkup->pet->code }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->pet->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Jenis</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->pet->type }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Usia</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->pet->age }} tahun</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Berat</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $checkup->pet->weight }} kg</dd>
            </div>
        </dl>
    </div>
</div>

<div class="mt-6 bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pemilik</h2>
    <dl class="space-y-3">
        <div>
            <dt class="text-sm font-medium text-gray-500">Nama</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $checkup->pet->owner->name }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Telepon</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $checkup->pet->owner->phone }}</dd>
        </div>
        @if($checkup->pet->owner->address)
        <div>
            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $checkup->pet->owner->address }}</dd>
        </div>
        @endif
    </dl>
</div>
@endsection
