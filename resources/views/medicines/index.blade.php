@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Medicines Inventory</h1>
                <p class="text-sm text-slate-500">A clean repository pattern based registry of all medical products.</p>
            </div>
            <a href="{{ route('medicines.create') }}" class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-teal-500/20 hover:bg-teal-400 active:scale-95 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add Medicine</span>
            </a>
        </div>

        <!-- Success Toast Alert -->
        @if(session('success'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3.5 text-emerald-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-emerald-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Supplier</th>
                            <th class="px-6 py-4 text-right">Price</th>
                            <th class="px-6 py-4 text-right">Quantity</th>
                            <th class="px-6 py-4">Expire Date</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($medicines as $medicine)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    {{ $medicine->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $medicine->category?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $medicine->supplier?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-slate-900">
                                    ${{ number_format($medicine->price, 2) }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-bold {{ $medicine->quantity == 0 ? 'bg-rose-50 text-rose-700 border border-rose-100' : ($medicine->quantity < 10 ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-100') }}">
                                        {{ $medicine->quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    @if($medicine->expire_date)
                                        @php
                                            $isExpired = $medicine->expire_date->lt(now());
                                            $isExpiringSoon = !$isExpired && $medicine->expire_date->diffInDays(now()) <= 30;
                                        @endphp
                                        <span class="{{ $isExpired ? 'text-rose-600 font-semibold' : ($isExpiringSoon ? 'text-amber-600 font-semibold' : 'text-slate-900') }}">
                                            {{ $medicine->expire_date->format('Y-m-d') }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="{{ route('medicines.show', $medicine) }}" class="text-teal-600 hover:text-teal-500 font-semibold transition-colors">View</a>
                                        <a href="{{ route('medicines.edit', $medicine) }}" class="text-slate-600 hover:text-slate-900 font-semibold transition-colors">Edit</a>
                                        <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this medicine?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-500 font-semibold transition-colors cursor-pointer">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-slate-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        <span class="text-sm font-medium">No medicines registered yet.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
