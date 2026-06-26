@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto rounded-2xl bg-white p-6 sm:p-8 shadow-sm border border-slate-200 mt-10">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-slate-900">Create Account</h1>
        <p class="text-sm text-slate-500 mt-1">Get started with a new account</p>
    </div>

    @if($errors->any())
        <div class="mb-5 rounded-xl bg-rose-50 border border-rose-200 px-4 py-3 text-rose-600 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border @error('name') border-rose-500 @else border-slate-200 @enderror bg-slate-50/50 px-3.5 py-2.5 text-sm focus:border-teal-500 focus:outline-none transition-all" required>
            @error('name')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border @error('email') border-rose-500 @else border-slate-200 @enderror bg-slate-50/50 px-3.5 py-2.5 text-sm focus:border-teal-500 focus:outline-none transition-all" required>
            @error('email')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
            <input type="password" name="password" class="w-full rounded-lg border @error('password') border-rose-500 @else border-slate-200 @enderror bg-slate-50/50 px-3.5 py-2.5 text-sm focus:border-teal-500 focus:outline-none transition-all" required>
            @error('password')
                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm focus:border-teal-500 focus:outline-none transition-all" required>
        </div>
        <button type="submit" class="w-full rounded-lg bg-teal-500 py-2.5 text-sm font-semibold text-white hover:bg-teal-400 transition-all cursor-pointer shadow-md shadow-teal-500/20">Register</button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-slate-500">Already have an account? <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:text-teal-500">Sign in</a></p>
    </div>
</div>
@endsection