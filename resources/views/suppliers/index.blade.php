@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Suppliers</h1>
                <p class="text-sm text-slate-500">List of registered suppliers and pharmaceutical manufacturers.</p>
            </div>
            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-teal-500/20 hover:bg-teal-400 active:scale-95 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add Supplier</span>
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
                            <th class="px-6 py-4">Phone</th>
                            <th class="px-6 py-4">Address</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($suppliers as $supplier)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    {{ $supplier->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $supplier->phone ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $supplier->address ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="text-teal-600 hover:text-teal-500 font-semibold transition-colors">Edit</a>
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-500 font-semibold transition-colors cursor-pointer">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-slate-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25M3 14.25h15v4.5m0-4.5V11.25m0 1.875c0-1.036-.84-1.875-1.875-1.875H3.75A1.875 1.875 0 0 0 1.875 13.125v1.875m17.25-1.875V9c0-1.036-.84-1.875-1.875-1.875M3.75 7.125h13.5c1.036 0 1.875.84 1.875 1.875v1.875M3.75 7.125A1.875 1.875 0 0 1 1.875 9v1.875M3.75 7.125c-.251 0-.489-.099-.667-.274L1.875 5.625M19.125 5.625l-1.208 1.226c-.178.175-.416.274-.667.274m1.875-1.875a1.125 1.125 0 0 0-1.125-1.125H5.625a1.125 1.125 0 0 0-1.125 1.125m15 0v1.5m-15-1.5v1.5" />
                                        </svg>
                                        <span class="text-sm font-medium">No suppliers registered yet.</span>
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
