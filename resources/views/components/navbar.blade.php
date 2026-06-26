<nav class="bg-slate-900 border-b border-slate-800 sticky top-0 z-50 backdrop-blur-md bg-opacity-95 shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('medicines.index') }}" class="flex items-center gap-2 group">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-teal-500 text-white shadow-md shadow-teal-500/20 group-hover:scale-105 transition-transform duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-white tracking-wide">PharmaKeep</span>
                </a>
                
                <!-- Nav Links -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('medicines.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::routeIs('medicines.*') ? 'bg-teal-500/10 text-teal-400 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        Medicines
                    </a>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::routeIs('admin.dashboard') ? 'bg-teal-500/10 text-teal-400 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::routeIs('categories.*') ? 'bg-teal-500/10 text-teal-400 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        Categories
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ Request::routeIs('suppliers.*') ? 'bg-teal-500/10 text-teal-400 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        Suppliers
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Quick Action button / CTA -->
            <div class="flex items-center gap-4">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('medicines.create') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-teal-500 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-teal-500/20 hover:bg-teal-400 active:scale-95 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>New Medicine</span>
                    </a>
                @endif
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors cursor-pointer">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
        
        <!-- Mobile Navigation (shown on small screens) -->
        <div class="md:hidden flex items-center justify-around border-t border-slate-800/60 py-2.5">
            <a href="{{ route('medicines.index') }}" class="text-xs font-semibold px-2.5 py-1 rounded-md {{ Request::routeIs('medicines.*') ? 'text-teal-400 bg-teal-500/10' : 'text-slate-400 hover:text-slate-200' }}">Medicines</a>
            @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold px-2.5 py-1 rounded-md {{ Request::routeIs('admin.dashboard') ? 'text-teal-400 bg-teal-500/10' : 'text-slate-400 hover:text-slate-200' }}">Dashboard</a>
            <a href="{{ route('categories.index') }}" class="text-xs font-semibold px-2.5 py-1 rounded-md {{ Request::routeIs('categories.*') ? 'text-teal-400 bg-teal-500/10' : 'text-slate-400 hover:text-slate-200' }}">Categories</a>
            <a href="{{ route('suppliers.index') }}" class="text-xs font-semibold px-2.5 py-1 rounded-md {{ Request::routeIs('suppliers.*') ? 'text-teal-400 bg-teal-500/10' : 'text-slate-400 hover:text-slate-200' }}">Suppliers</a>
            @endif
        </div>
    </div>
</nav>