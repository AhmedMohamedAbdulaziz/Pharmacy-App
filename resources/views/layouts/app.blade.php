<!DOCTYPE html>
<html lang="en" dir="ltr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Pharmacy Management System</title>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 flex flex-col">
    <x-navbar />

    <main class="flex-grow max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200/80 py-6 text-center text-sm text-slate-500">
        <div class="max-w-7xl mx-auto px-4">
            &copy; {{ date('Y') }} Pharmacy Management System. All rights reserved.
        </div>
    </footer>

    <!-- Toast Notifications -->
    @if (session('success'))
        <div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-sm p-4 text-slate-800 bg-white rounded-2xl shadow-xl border border-slate-100 transition-all duration-300 transform translate-x-12 opacity-0" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-teal-600 bg-teal-50 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                </svg>
            </div>
            <div class="ms-3 text-sm font-semibold text-slate-800">
                <span class="block text-xs font-bold uppercase text-teal-600 tracking-wide mb-0.5">Success</span>
                {{ session('success') }}
            </div>
            <button type="button" class="ms-auto bg-transparent text-slate-400 hover:text-slate-900 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8 hover:bg-slate-50 transition-colors cursor-pointer" onclick="dismissToast('toast-success')">
                <span class="sr-only">Close</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    @if (session('error') || $errors->has('error_message'))
        <div id="toast-error" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-sm p-4 text-slate-800 bg-white rounded-2xl shadow-xl border border-slate-100 transition-all duration-300 transform translate-x-12 opacity-0" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-rose-600 bg-rose-50 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
                </svg>
            </div>
            <div class="ms-3 text-sm font-semibold text-slate-800">
                <span class="block text-xs font-bold uppercase text-rose-600 tracking-wide mb-0.5">Error</span>
                {{ session('error') ?: $errors->first('error_message') }}
            </div>
            <button type="button" class="ms-auto bg-transparent text-slate-400 hover:text-slate-900 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8 hover:bg-slate-50 transition-colors cursor-pointer" onclick="dismissToast('toast-error')">
                <span class="sr-only">Close</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <script>
        function dismissToast(id) {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-12', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            ['toast-success', 'toast-error'].forEach(id => {
                const toast = document.getElementById(id);
                if (toast) {
                    // Trigger reflow to enable animation
                    void toast.offsetWidth;
                    toast.classList.remove('translate-x-12', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                    
                    // Auto dismiss after 4 seconds
                    setTimeout(() => {
                        dismissToast(id);
                    }, 4000);
                }
            });
        });
    </script>
</body>
</html>