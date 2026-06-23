@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto rounded-2xl bg-white p-6 sm:p-8 shadow-sm border border-slate-200">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between gap-4 border-b border-slate-150 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Edit Category</h1>
                <p class="text-sm text-slate-500">Update the classification category name.</p>
            </div>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-semibold text-slate-750 hover:bg-slate-50 transition-colors shadow-xs">
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
        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-750">Category Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-900 focus:border-teal-500 focus:bg-white focus:outline-none transition-all duration-150 shadow-xs" required>
            </div>

            <!-- Action Button -->
            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-teal-500 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-teal-500/20 hover:bg-teal-400 active:scale-95 transition-all duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span>Update Category</span>
                </button>
            </div>
        </form>
    </div>
@endsection
