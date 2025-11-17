@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 rounded-md p-3">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/dog-training.png" alt="dog-training"/>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Pemilik</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalOwners }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 rounded-md p-3">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/pets--v1.png" alt="pets--v1"/>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Hewan</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalPets }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 rounded-md p-3">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/doctors-bag.png" alt="doctors-bag"/>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Pemeriksaan</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalCheckups }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">Pemeriksaan Terbaru</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hewan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Perawatan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentCheckups as $checkup)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $checkup->checkup_date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $checkup->pet->name }} ({{ $checkup->pet->code }})</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $checkup->pet->owner->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $checkup->treatment->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pemeriksaan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
