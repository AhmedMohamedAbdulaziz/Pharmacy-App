@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between border-b border-slate-150 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Medicines Shop</h1>
            <p class="text-sm text-slate-500">Welcome, {{ auth()->check() ? auth()->user()->name : 'Guest' }}</p>
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($medicines as $medicine)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="mb-4 flex justify-center">
                        @if($medicine->hasMedia('medicines'))
                            <img src="{{ $medicine->getFirstMediaUrl('medicines') }}" class="w-32 h-32 object-cover rounded-xl border">
                        @else
                            <div class="w-32 h-32 bg-slate-100 rounded-xl flex items-center justify-center text-xs text-slate-400">No Image</div>
                        @endif
                    </div>
                    <span class="text-xs font-semibold uppercase text-teal-600 tracking-wider">{{ $medicine->category?->name ?? 'General' }}</span>
                    <h3 class="text-lg font-bold text-slate-900 mt-1">{{ $medicine->name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">Manufacturer: {{ $medicine->supplier?->name ?? '-' }}</p>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="block text-xs text-slate-400">Price</span>
                        <span class="text-xl font-bold text-slate-900">${{ number_format($medicine->price, 2) }}</span>
                    </div>
                    
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="flex items-center gap-2">
                            <a href="{{ route('medicines.edit', $medicine->id) }}" class="inline-flex items-center justify-center rounded-lg bg-teal-50 px-3.5 py-2 text-xs font-semibold text-teal-600 hover:bg-teal-100 transition-colors cursor-pointer">
                                Edit
                            </a>
                            <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this medicine?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-rose-50 px-3.5 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-100 transition-colors cursor-pointer">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @else
                        @if($medicine->quantity > 0)
                            <form action="{{ route('medicines.buy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all shadow-md shadow-teal-500/10 cursor-pointer">
                                    Buy Now
                                </button>
                            </form>
                        @else
                            <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full">Out of Stock</span>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection