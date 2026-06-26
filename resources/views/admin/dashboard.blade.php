@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard</h1>
        <p class="text-sm text-slate-500 mt-1">Overview of the pharmacy management system.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Medicines</h3>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['medicines'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Categories</h3>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['categories'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Suppliers</h3>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['suppliers'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Orders</h3>
            <p class="text-3xl font-bold text-teal-600 mt-2">{{ $stats['orders'] }}</p>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mt-6">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Recent Orders</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Medicine</th>
                        <th class="px-6 py-4 text-right">Qty</th>
                        <th class="px-6 py-4 text-right">Total Price</th>
                        <th class="px-6 py-4 text-center">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ substr($order->id, 0, 8) }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-teal-600 font-semibold">{{ $order->medicine->name ?? 'Deleted' }}</td>
                            <td class="px-6 py-4 text-right">{{ $order->quantity }}</td>
                            <td class="px-6 py-4 text-right font-bold text-slate-900">${{ number_format($order->total_price, 2) }}</td>
                            <td class="px-6 py-4 text-center text-slate-500">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">No orders placed yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
