<div class="min-h-screen flex items-center justify-center bg-linear-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="w-full max-w-md px-8 py-10 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 shadow-2xl">

        {{-- Logo / Brand --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-600 shadow-lg shadow-indigo-500/30 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">SadevaLMS</h1>
            <p class="text-slate-400 text-sm mt-1">Sign in to your account</p>
        </div>

        {{-- Error Alert --}}
        @if (session('error'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <form wire:submit="login" class="flex flex-col gap-5">

            {{-- Email --}}
            <div class="flex flex-col gap-1.5">
                <label for="email" class="text-sm font-medium text-slate-300">Email address</label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    autocomplete="email"
                    placeholder="you@example.com"
                    class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 @error('email') ring-1 ring-red-500/60 @enderror text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition"
                />
                @error('email')
                    <span class="text-red-400 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="flex flex-col gap-1.5">
                <label for="password" class="text-sm font-medium text-slate-300">Password</label>
                <input
                    id="password"
                    type="password"
                    wire:model="password"
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 @error('password') ring-1 ring-red-500/60 @enderror text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition"
                />
                @error('password')
                    <span class="text-red-400 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember me --}}
            <div class="flex items-center gap-2">
                <input
                    id="remember"
                    type="checkbox"
                    wire:model="remember"
                    class="w-4 h-4 rounded border-white/20 bg-white/5 text-indigo-600 focus:ring-indigo-500/50 cursor-pointer"
                />
                <label for="remember" class="text-sm text-slate-400 cursor-pointer select-none">Remember me</label>
            </div>

            {{-- Submit --}}
            <button
                id="login-submit"
                type="submit"
                class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-lg shadow-indigo-500/20 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-60 cursor-not-allowed"
            >
                <svg wire:loading class="animate-spin w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span wire:loading.remove>Sign in</span>
                <span wire:loading>Signing in…</span>
            </button>
        </form>
    </div>
</div>
