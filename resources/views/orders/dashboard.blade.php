@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between border-b border-slate-150 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Admin Dashboard (Sales Log)</h1>
            <p class="text-sm text-slate-500">Track all medicine items sold to customers</p>
        </div>
        <a href="{{ route('medicines.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded-lg text-sm font-semibold">Add New Medicine</a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="w-full text-left border-collapse text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">Customer Name</th>
                    <th class="px-6 py-4">Medicine</th>
                    <th class="px-6 py-4 text-center">Qty Purchased</th>
                    <th class="px-6 py-4 text-right">Total Income</th>
                    <th class="px-6 py-4">Date & Time</th>
                    <th class="px-6 py-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-900">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 text-slate-700">{{ $order->medicine->name }}</td>
                        <td class="px-6 py-4 text-center font-bold text-slate-600">{{ $order->quantity }}</td>
                        <td class="px-6 py-4 text-right font-bold text-emerald-600">${{ number_format($order->total_price, 2) }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-0.5 text-xs font-bold border border-emerald-100">Sold (اتباع)</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400">No sales recorded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection