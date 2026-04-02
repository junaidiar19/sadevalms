<div class="min-h-screen bg-linear-to-br from-slate-900 via-slate-800 to-slate-900">

    {{-- Top Nav --}}
    <nav class="border-b border-white/10 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-violet-600 shadow-lg shadow-violet-500/30">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <span class="text-white font-semibold text-sm">SadevaLMS</span>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-violet-500 flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="hidden sm:block">
                    <p class="text-white text-sm font-medium leading-tight">{{ $user->name }}</p>
                    <p class="text-slate-400 text-xs leading-tight">{{ $user->email }}</p>
                </div>
            </div>

            <livewire:auth.logout />
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex items-center justify-center min-h-[calc(100vh-65px)] p-6">
        <div class="text-center">
            <span class="inline-block px-3 py-1 rounded-full bg-violet-500/10 border border-violet-500/20 text-violet-400 text-xs font-medium mb-4">
                Super Admin
            </span>
            <h1 class="text-3xl font-bold text-white mb-2">Welcome back, {{ $user->name }}!</h1>
            <p class="text-slate-400 text-sm">Your Super Admin dashboard is ready. Content coming soon.</p>
        </div>
    </main>
</div>
