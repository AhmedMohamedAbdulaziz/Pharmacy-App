@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto rounded-2xl bg-white p-6 sm:p-8 shadow-sm border border-slate-200">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between gap-4 border-b border-slate-150 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Add Supplier</h1>
                <p class="text-sm text-slate-500">Register a new manufacturing partner or pharmaceutical distributor.</p>
            </div>
            <a href="{{ route('suppliers.index') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-semibold text-slate-750 hover:bg-slate-50 transition-colors shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <span>Back</span>
            </a>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-rose-50 border border-rose-150 p-4 text-rose-800">
                <ul class="list-disc list-inside space-y-1 text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-750">Supplier Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Pfizer Pharmaceuticals" class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-teal-500 focus:bg-white focus:outline-none transition-all duration-150 shadow-xs" required>
            </div>

            <!-- Phone & Address -->
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-750">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 019-2834" class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-teal-500 focus:bg-white focus:outline-none transition-all duration-150 shadow-xs">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-750">Office Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="e.g. New York, USA" class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-teal-500 focus:bg-white focus:outline-none transition-all duration-150 shadow-xs">
                </div>
            </div>

            <!-- Action Button -->
            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-teal-500 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-teal-500/20 hover:bg-teal-400 active:scale-95 transition-all duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Save Supplier</span>
                </button>
            </div>
        </form>
    </div>
@endsection
