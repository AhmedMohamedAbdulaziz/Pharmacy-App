@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto rounded-2xl bg-white p-6 sm:p-8 shadow-sm border border-slate-200">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between gap-4 border-b border-slate-150 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Medicine Details</h1>
                <p class="text-sm text-slate-500">Full specifications and status of the medicine record.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('medicines.edit', $medicine) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-semibold text-slate-750 hover:bg-slate-50 transition-colors shadow-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.83 20.04a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    <span>Edit</span>
                </a>
                <a href="{{ route('medicines.index') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-semibold text-slate-750 hover:bg-slate-50 transition-colors shadow-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>

        <!-- Specifications Grid -->
        <div class="grid gap-6 sm:grid-cols-2">
            <!-- Image -->
              <div class="rounded-xl border border-slate-150 bg-slate-50/50 p-5 sm:col-span-2 flex flex-col items-center justify-center">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Medicine Image</span>
                @if($medicine->hasMedia('medicines'))
                    <img src="{{ $medicine->getFirstMediaUrl('medicines') }}" alt="{{ $medicine->name }}" class="w-40 h-40 rounded-xl object-cover shadow-sm border border-slate-200">
                @else
                    <div class="w-40 h-40 rounded-xl bg-slate-100 flex flex-col items-center justify-center text-slate-400 gap-2 border border-dashed border-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375 0 1 1-.75 0 .375 0 0 1 text-.75 0Z" />
                        </svg>
                        <span class="text-xs font-medium">No Image Available</span>
                    </div>
                @endif
            </div>
            <!-- Name -->
            <div class="rounded-xl border border-slate-150 bg-slate-50/50 p-5">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Medicine Name</span>
                <p class="mt-2.5 text-lg font-bold text-slate-900">{{ $medicine->name }}</p>
            </div>

            <!-- Price -->
            <div class="rounded-xl border border-slate-150 bg-slate-50/50 p-5">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Retail Price</span>
                <p class="mt-2.5 text-lg font-bold text-slate-900">${{ number_format($medicine->price, 2) }}</p>
            </div>

            <!-- Quantity -->
            <div class="rounded-xl border border-slate-150 bg-slate-50/50 p-5">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Stock Quantity</span>
                <div class="mt-2.5 flex items-center gap-2">
                    <span class="text-lg font-bold text-slate-900">{{ $medicine->quantity }} units</span>
                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-bold {{ $medicine->quantity == 0 ? 'bg-rose-50 text-rose-700' : ($medicine->quantity < 10 ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700') }}">
                        {{ $medicine->quantity == 0 ? 'Out of Stock' : ($medicine->quantity < 10 ? 'Low Stock' : 'Healthy Stock') }}
                    </span>
                </div>
            </div>

            <!-- Expiry Date -->
            <div class="rounded-xl border border-slate-150 bg-slate-50/50 p-5">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Expiration Date</span>
                @if($medicine->expire_date)
                    @php
                        $isExpired = $medicine->expire_date->lt(now());
                        $isExpiringSoon = !$isExpired && $medicine->expire_date->diffInDays(now()) <= 30;
                    @endphp
                    <div class="mt-2.5 flex items-center gap-2">
                        <span class="text-lg font-bold text-slate-900">{{ $medicine->expire_date->format('Y-m-d') }}</span>
                        @if($isExpired)
                            <span class="inline-flex rounded-full bg-rose-50 text-rose-700 px-2.5 py-0.5 text-xs font-bold border border-rose-100">Expired</span>
                        @elseif($isExpiringSoon)
                            <span class="inline-flex rounded-full bg-amber-50 text-amber-700 px-2.5 py-0.5 text-xs font-bold border border-amber-100">Expiring Soon</span>
                        @endif
                    </div>
                @else
                    <p class="mt-2.5 text-lg font-bold text-slate-900">-</p>
                @endif
            </div>

            <!-- Category -->
            <div class="rounded-xl border border-slate-150 bg-slate-50/50 p-5">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Therapeutic Class / Category</span>
                <p class="mt-2.5 text-lg font-bold text-slate-905">{{ $medicine->category?->name ?? 'No category selected' }}</p>
            </div>

            <!-- Supplier -->
            <div class="rounded-xl border border-slate-150 bg-slate-50/50 p-5">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Registered Manufacturer</span>
                <p class="mt-2.5 text-lg font-bold text-slate-905">{{ $medicine->supplier?->name ?? 'No supplier selected' }}</p>
            </div>
        </div>
    </div>
@endsection
