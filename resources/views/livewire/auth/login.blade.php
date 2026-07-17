<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden transition-colors duration-300 {{ $theme === 'modern' ? 'bg-gradient-to-tr from-slate-900 via-zinc-900 to-teal-950 text-white' : 'bg-white text-slate-900' }}">
    
    <!-- Background Blur Blobs for Modern UI -->
    @if ($theme === 'modern')
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-teal-500/10 blur-3xl animate-pulse pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-sky-500/10 blur-3xl animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
    @endif

    <!-- Header bar with Theme Toggle -->
    {{-- <div class="absolute top-6 right-6 z-50">
        <button wire:click="toggleTheme" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-wider border transition-colors {{ $theme === 'modern' ? 'border-teal-500/30 text-teal-400 hover:bg-teal-500/10 rounded-xl' : 'border-slate-800 text-slate-800 hover:bg-slate-100 font-black' }}">
            Style: <span class="underline">{{ strtoupper($theme) }}</span>
        </button>
    </div> --}}

    <!-- Main Card container -->
    <div class="sm:mx-auto sm:w-full sm:max-w-md z-10">
        <div class="flex justify-center">
            <div class="w-12 h-12 flex items-center justify-center bg-teal-600 text-white {{ $theme === 'modern' ? 'rounded-2xl shadow-lg shadow-teal-500/20' : 'border-2 border-slate-900 font-bold' }}">
                ✚
            </div>
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold tracking-tight font-heading">
            Sign in to <span class="{{ $theme === 'modern' ? 'text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-sky-400' : 'text-slate-900' }}">Lifeline HMS</span>
        </h2>
        <p class="mt-2 text-center text-sm {{ $theme === 'modern' ? 'text-zinc-400' : 'text-slate-500' }}">
            Enter your credentials to access the clinical portal
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md z-10 p-4">
        <!-- Login Card -->
        <div class="py-8 px-4 sm:rounded-2xl sm:px-10 border transition-all duration-300 {{ $theme === 'modern' ? 'bg-zinc-900/60 backdrop-blur-md border-zinc-800/80 shadow-2xl' : 'bg-white border-2 border-slate-300 shadow-none' }}">
            
            @if ($errorMessage)
                <div class="mb-4 p-3.5 text-xs font-semibold rounded-lg {{ $theme === 'modern' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : 'bg-red-50 text-red-800 border-2 border-red-300' }}">
                    ⚠ {{ $errorMessage }}
                </div>
            @endif

            <form wire:submit.prevent="login" class="space-y-6">
                <!-- Email field -->
                <div>
                    <label for="email" class="block text-sm font-bold {{ $theme === 'modern' ? 'text-zinc-300' : 'text-slate-700' }}">
                        Email Address
                    </label>
                    <div class="mt-1">
                        <input wire:model="email" id="email" type="email" autocomplete="email" required 
                            class="appearance-none block w-full px-3.5 py-2.5 border placeholder-slate-400 focus:outline-none transition-all {{ $theme === 'modern' ? 'bg-zinc-950/40 border-zinc-800 rounded-xl focus:border-teal-500 text-white' : 'bg-white border-2 border-slate-300 focus:border-slate-800 text-slate-900' }}">
                    </div>
                    @error('email') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Password field -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-bold {{ $theme === 'modern' ? 'text-zinc-300' : 'text-slate-700' }}">
                            Password
                        </label>
                    </div>
                    <div class="mt-1">
                        <input wire:model="password" id="password" type="password" autocomplete="current-password" required 
                            class="appearance-none block w-full px-3.5 py-2.5 border placeholder-slate-400 focus:outline-none transition-all {{ $theme === 'modern' ? 'bg-zinc-950/40 border-zinc-800 rounded-xl focus:border-teal-500 text-white' : 'bg-white border-2 border-slate-300 focus:border-slate-800 text-slate-900' }}">
                    </div>
                    @error('password') <span class="text-xs text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Submit button -->
                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent font-bold text-sm shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $theme === 'modern' ? 'bg-teal-600 hover:bg-teal-700 text-white rounded-xl focus:ring-teal-500' : 'bg-slate-800 hover:bg-slate-900 text-white focus:ring-slate-800' }}">
                        Sign In to Portal
                    </button>
                </div>
            </form>

            <div class="mt-6 border-t pt-6 text-center text-xs {{ $theme === 'modern' ? 'border-zinc-800 text-zinc-500' : 'border-slate-200 text-slate-500' }}">
                Demo Accounts: <br>
                <span class="font-semibold text-teal-500 select-all">admin@hms.com</span> (Password: <span class="font-semibold">password</span>)
            </div>

        </div>
    </div>
</div>
