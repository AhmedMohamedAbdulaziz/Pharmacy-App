@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto rounded-2xl bg-white p-6 sm:p-8 shadow-sm border border-slate-200 mt-10">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-slate-900">Welcome Back</h1>
        <p class="text-sm text-slate-500 mt-1">Sign in to your account</p>
    </div>
    
    @if($errors->any())
        <div class="mb-4 rounded-xl bg-rose-50 border border-rose-200 px-4 py-3 text-rose-600 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email Address</label>
            <input type="email" name="email" class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm focus:border-teal-500 focus:outline-none transition-all" required value="{{ old('email') }}">
        </div>
        <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
            <input type="password" name="password" class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm focus:border-teal-500 focus:outline-none transition-all" required>
        </div>
        <button type="submit" class="w-full rounded-lg bg-teal-500 py-2.5 text-sm font-semibold text-white hover:bg-teal-400 transition-all cursor-pointer shadow-md shadow-teal-500/20">Sign In</button>
    </form>
    
    <div class="mt-6 text-center">
        <p class="text-sm text-slate-500">Don't have an account? <a href="{{ route('register') }}" class="text-teal-600 font-semibold hover:text-teal-500">Create one</a></p>
    </div>
</div>
@endsection
