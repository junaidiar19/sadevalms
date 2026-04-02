@if (session('toast'))
    <div
        x-data="{
            show: false,
            type: '{{ session('toast.type', 'success') }}',
            message: '{{ addslashes(session('toast.message', '')) }}',
            init() {
                this.$nextTick(() => { this.show = true });
                setTimeout(() => { this.show = false }, 3500);
            }
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
        class="fixed bottom-6 right-6 z-50 flex items-center gap-3 min-w-72 max-w-sm px-4 py-3 rounded-xl border shadow-lg bg-white dark:bg-gray-800"
        :class="{
            'border-green-200 dark:border-green-800 text-green-700 dark:text-green-300': type === 'success',
            'border-red-200 dark:border-red-800 text-red-700 dark:text-red-300': type === 'error',
            'border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-300': type === 'warning',
        }"
    >
        {{-- Icon --}}
        <template x-if="type === 'success'">
            <div class="w-8 h-8 rounded-lg bg-green-50 dark:bg-green-900/40 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
        </template>
        <template x-if="type === 'error'">
            <div class="w-8 h-8 rounded-lg bg-red-50 dark:bg-red-900/40 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </template>
        <template x-if="type === 'warning'">
            <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-900/40 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
        </template>

        <p class="text-sm font-medium leading-snug flex-1" x-text="message"></p>

        <button
            @click="show = false"
            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition cursor-pointer shrink-0"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
