<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lifeline HMS - Hospital Management System</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            h1, h2, h3, h4, h5, h6, .font-heading {
                font-family: 'Outfit', sans-serif;
            }
            .gradient-bg {
                background: radial-gradient(circle at 50% 50%, rgba(20, 184, 166, 0.15) 0%, rgba(20, 184, 166, 0.05) 50%, transparent 100%);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .dark .glass-card {
                background: rgba(23, 23, 23, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(63, 63, 70, 0.3);
            }
            .animate-pulse-slow {
                animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            @keyframes pulse {
                0%, 100% { opacity: 0.2; transform: scale(1); }
                50% { opacity: 0.4; transform: scale(1.1); }
            }
        </style>
    </head>
    <body class="bg-slate-50 dark:bg-zinc-950 text-slate-800 dark:text-zinc-200 antialiased selection:bg-teal-500 selection:text-white transition-colors duration-300 min-h-screen flex flex-col">
        
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-full h-[600px] overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-teal-500/10 dark:bg-teal-500/5 blur-3xl animate-pulse-slow"></div>
            <div class="absolute top-40 right-[-10%] w-96 h-96 rounded-full bg-sky-500/10 dark:bg-sky-500/5 blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        </div>

        <!-- Header / Navigation -->
        <header class="sticky top-0 z-50 w-full glass-card border-b border-slate-200/50 dark:border-zinc-800/50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
                <!-- Logo -->
                <a href="#" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-xl bg-teal-600 dark:bg-teal-500 flex items-center justify-center text-white shadow-lg shadow-teal-500/20 dark:shadow-teal-500/10 group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <span class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-white font-heading">
                        Lifeline<span class="text-teal-600 dark:text-teal-400">HMS</span>
                    </span>
                </a>

                <!-- Nav Links -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-semibold text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Features</a>
                    <a href="#departments" class="text-sm font-semibold text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Departments</a>
                    <a href="#stats" class="text-sm font-semibold text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Statistics</a>
                    <a href="#contact" class="text-sm font-semibold text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Contact</a>
                </nav>

                <!-- Auth Portal CTA -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/admin/login') }}" class="hidden sm:inline-flex text-sm font-semibold text-slate-700 dark:text-zinc-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors px-4 py-2">
                        Log In
                    </a>
                    <a href="{{ url('/admin') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 dark:bg-teal-500 dark:hover:bg-teal-600 text-white font-semibold text-sm shadow-lg shadow-teal-600/20 dark:shadow-teal-500/10 transition-all duration-300 hover:shadow-teal-700/30 hover:-translate-y-0.5">
                        Access Portal
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow z-10">

            <!-- Hero Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-20 sm:pt-20 sm:pb-32 grid lg:grid-cols-12 gap-12 items-center">
                <!-- Text Column -->
                <div class="lg:col-span-6 space-y-6 sm:space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 dark:bg-teal-500/10 border border-teal-100 dark:border-teal-500/20 text-teal-700 dark:text-teal-300 text-xs sm:text-sm font-semibold tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        Next-Gen Clinical Management System
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.1] font-heading">
                        Healthcare Management <br class="hidden sm:inline">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-sky-500 dark:from-teal-400 dark:to-sky-400">Reimagined.</span>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Lifeline HMS streamlines operations, connects doctors and patients, and delivers high-performance insights to hospital administrators. Manage admissions, scheduling, prescriptions, and billing all from one unified dashboard.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ url('/admin') }}" class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-teal-600 hover:bg-teal-700 dark:bg-teal-500 dark:hover:bg-teal-600 text-white font-bold shadow-xl shadow-teal-600/25 dark:shadow-teal-500/15 transition-all duration-300 hover:shadow-teal-700/40 hover:-translate-y-1">
                            Launch Dashboard
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 dark:bg-zinc-900 dark:hover:bg-zinc-800/80 text-slate-800 dark:text-white font-bold border border-slate-200 dark:border-zinc-800 shadow-sm transition-all duration-300 hover:border-slate-300 dark:hover:border-zinc-700 hover:-translate-y-1">
                            Explore Features
                        </a>
                    </div>
                </div>

                <!-- Dashboard Showcase Column -->
                <div class="lg:col-span-6 flex justify-center relative">
                    <!-- Glassmorphism ambient glow -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-teal-500/20 to-sky-500/20 dark:from-teal-500/10 dark:to-sky-500/10 rounded-3xl blur-2xl transform rotate-2 scale-95 pointer-events-none"></div>
                    
                    <!-- Dashboard Mockup Frame -->
                    <div class="w-full max-w-[540px] rounded-3xl border border-slate-200/80 dark:border-zinc-800/80 shadow-2xl overflow-hidden glass-card relative z-10 transform hover:scale-[1.02] transition-transform duration-500">
                        <!-- Browser Header bar -->
                        <div class="px-5 py-3 border-b border-slate-200/80 dark:border-zinc-800/80 bg-slate-100/50 dark:bg-zinc-900/50 flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <span class="w-3.5 h-3.5 rounded-full bg-red-400 dark:bg-red-500/80"></span>
                                <span class="w-3.5 h-3.5 rounded-full bg-amber-400 dark:bg-amber-500/80"></span>
                                <span class="w-3.5 h-3.5 rounded-full bg-green-400 dark:bg-green-500/80"></span>
                            </div>
                            <div class="text-[11px] font-semibold text-slate-400 dark:text-zinc-500 font-mono select-none">
                                portal.lifeline-hms.com
                            </div>
                            <div class="w-6"></div>
                        </div>

                        <!-- Mockup App Dashboard Content -->
                        <div class="p-6 bg-white/40 dark:bg-zinc-950/40 space-y-6">
                            <!-- Stats Widgets Row -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="p-4 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/50 dark:border-zinc-800/50 shadow-sm">
                                    <div class="text-xs text-slate-400 dark:text-zinc-500 font-semibold mb-1">Appointments</div>
                                    <div class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white font-heading">142</div>
                                    <div class="text-[10px] text-teal-600 dark:text-teal-400 font-bold flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 mr-0.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                                        </svg>
                                        +12%
                                    </div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/50 dark:border-zinc-800/50 shadow-sm">
                                    <div class="text-xs text-slate-400 dark:text-zinc-500 font-semibold mb-1">Active Rooms</div>
                                    <div class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white font-heading">24/30</div>
                                    <div class="text-[10px] text-sky-600 dark:text-sky-400 font-bold flex items-center mt-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-ping mr-1"></span>
                                        Occupied
                                    </div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/50 dark:border-zinc-800/50 shadow-sm">
                                    <div class="text-xs text-slate-400 dark:text-zinc-500 font-semibold mb-1">Revenue</div>
                                    <div class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white font-heading">$8.4k</div>
                                    <div class="text-[10px] text-teal-600 dark:text-teal-400 font-bold flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 mr-0.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                                        </svg>
                                        +8%
                                    </div>
                                </div>
                            </div>

                            <!-- List / Table view -->
                            <div class="p-5 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/50 dark:border-zinc-800/50 shadow-sm space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white">Recent Consultations</div>
                                    <div class="text-[10px] px-2 py-0.5 rounded-full bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 font-semibold">Live updates</div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between text-xs py-1 border-b border-slate-100 dark:border-zinc-850">
                                        <div class="flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-full bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold text-[10px]">JD</span>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-white">John Doe</div>
                                                <div class="text-[10px] text-slate-400">Cardiology</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-slate-800 dark:text-zinc-300">Dr. Sarah Connor</div>
                                            <div class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-50 dark:bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 inline-block font-bold">Completed</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between text-xs py-1 border-b border-slate-100 dark:border-zinc-850">
                                        <div class="flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-full bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center font-bold text-[10px]">AS</span>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-white">Alice Smith</div>
                                                <div class="text-[10px] text-slate-400">Pediatrics</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-slate-800 dark:text-zinc-300">Dr. Robert Vance</div>
                                            <div class="text-[9px] px-1.5 py-0.5 rounded bg-amber-50 dark:bg-amber-500/15 text-amber-600 dark:text-amber-400 inline-block font-bold">Pending</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistics section -->
            <section id="stats" class="bg-slate-100 dark:bg-zinc-900/50 py-16 sm:py-24 border-y border-slate-200/50 dark:border-zinc-800/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 sm:gap-12">
                        <div class="text-center space-y-2">
                            <div class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white font-heading">150+</div>
                            <div class="text-sm font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">Specialists</div>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white font-heading">50k+</div>
                            <div class="text-sm font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">Patients Served</div>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white font-heading">99.9%</div>
                            <div class="text-sm font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">System Uptime</div>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white font-heading">24/7</div>
                            <div class="text-sm font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">Active Care</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Grid Section -->
            <section id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-32">
                <div class="text-center max-w-3xl mx-auto space-y-4 mb-16 sm:mb-24">
                    <h2 class="text-base font-bold text-teal-600 dark:text-teal-400 uppercase tracking-wider">Comprehensive Management</h2>
                    <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white font-heading">
                        All modules fully integrated under one portal.
                    </p>
                    <p class="text-slate-600 dark:text-zinc-400 text-sm sm:text-base">
                        Optimize clinical workflows and keep patient health records accurate and up-to-date with our robust suite of modules.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 shadow-md shadow-slate-100/50 dark:shadow-none hover:shadow-xl dark:hover:border-zinc-700/60 hover:-translate-y-1.5 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 2.24V19.5m8.077-7.324H12" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 font-heading">Electronic Health Records</h3>
                        <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Maintain centralized, encrypted patient health directories, admissions, consultation records, and digital file folders.
                        </p>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 shadow-md shadow-slate-100/50 dark:shadow-none hover:shadow-xl dark:hover:border-zinc-700/60 hover:-translate-y-1.5 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 font-heading">Appointment Booking</h3>
                        <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Intuitive digital scheduling system allowing quick creation of doctor consultations, slots booking, and automated tracking.
                        </p>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 shadow-md shadow-slate-100/50 dark:shadow-none hover:shadow-xl dark:hover:border-zinc-700/60 hover:-translate-y-1.5 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.251.11a3.375 3.375 0 004.498-4.498.75.75 0 01.498-1.218 3.375 3.375 0 00-4.498-4.498M12 3v18" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 font-heading">Billing & Invoicing</h3>
                        <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Generate detailed billing receipts, track billing items (medications, fees, rooms), manage transaction statuses and invoices.
                        </p>
                    </div>

                    <!-- Feature Card 4 -->
                    <div class="p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 shadow-md shadow-slate-100/50 dark:shadow-none hover:shadow-xl dark:hover:border-zinc-700/60 hover:-translate-y-1.5 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 font-heading">Digital Prescriptions</h3>
                        <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Create digital prescriptions, link specific dosage instructions, schedule drugs, and automatically link to patient histories.
                        </p>
                    </div>

                    <!-- Feature Card 5 -->
                    <div class="p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 shadow-md shadow-slate-100/50 dark:shadow-none hover:shadow-xl dark:hover:border-zinc-700/60 hover:-translate-y-1.5 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1M5.25 10.75v10.25M6.75 16.5v.008m0-.008a.75.75 0 110-1.5.75.75 0 010 1.5zm0-3.5v.008m0-.008a.75.75 0 110-1.5.75.75 0 010 1.5zm0-3.5v.008m0-.008a.75.75 0 110-1.5.75.75 0 010 1.5zm6.5 7v.008m0-.008a.75.75 0 110-1.5.75.75 0 010 1.5zm0-3.5v.008m0-.008a.75.75 0 110-1.5.75.75 0 010 1.5zm0-3.5v.008m0-.008a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 font-heading">Room & Ward Allocation</h3>
                        <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Organize room types, check occupancy availability, manage inpatient admissions, and track patient transfers.
                        </p>
                    </div>

                    <!-- Feature Card 6 -->
                    <div class="p-8 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800/80 shadow-md shadow-slate-100/50 dark:shadow-none hover:shadow-xl dark:hover:border-zinc-700/60 hover:-translate-y-1.5 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 font-heading">Advanced Charts & Analytics</h3>
                        <p class="text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                            Integrated Filament charts, monthly consultation visual logs, revenue reports, and active patient volume analytics.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Departments Showcase Section -->
            <section id="departments" class="bg-slate-100 dark:bg-zinc-900/50 py-20 sm:py-32 border-y border-slate-200/50 dark:border-zinc-800/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                        <h2 class="text-base font-bold text-teal-600 dark:text-teal-400 uppercase tracking-wider">Clinical Specializations</h2>
                        <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white font-heading">
                            Optimized across multiple medical branches.
                        </p>
                        <p class="text-slate-600 dark:text-zinc-400 text-sm sm:text-base">
                            Lifeline HMS accommodates distinct workflows for various specialized departments.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                        <!-- Card 1 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 text-center space-y-4 shadow-sm hover:border-teal-500/50 dark:hover:border-teal-400/50 transition-colors duration-300">
                            <span class="w-10 h-10 rounded-lg bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto text-lg font-bold">♥</span>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">Cardiology</div>
                        </div>
                        <!-- Card 2 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 text-center space-y-4 shadow-sm hover:border-teal-500/50 dark:hover:border-teal-400/50 transition-colors duration-300">
                            <span class="w-10 h-10 rounded-lg bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto text-lg font-bold">🧠</span>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">Neurology</div>
                        </div>
                        <!-- Card 3 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 text-center space-y-4 shadow-sm hover:border-teal-500/50 dark:hover:border-teal-400/50 transition-colors duration-300">
                            <span class="w-10 h-10 rounded-lg bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto text-lg font-bold">👶</span>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">Pediatrics</div>
                        </div>
                        <!-- Card 4 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 text-center space-y-4 shadow-sm hover:border-teal-500/50 dark:hover:border-teal-400/50 transition-colors duration-300">
                            <span class="w-10 h-10 rounded-lg bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto text-lg font-bold">🦴</span>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">Orthopedics</div>
                        </div>
                        <!-- Card 5 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 text-center space-y-4 shadow-sm hover:border-teal-500/50 dark:hover:border-teal-400/50 transition-colors duration-300">
                            <span class="w-10 h-10 rounded-lg bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto text-lg font-bold">👁</span>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">Ophthalmology</div>
                        </div>
                        <!-- Card 6 -->
                        <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 text-center space-y-4 shadow-sm hover:border-teal-500/50 dark:hover:border-teal-400/50 transition-colors duration-300">
                            <span class="w-10 h-10 rounded-lg bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto text-lg font-bold">🩺</span>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">Gen. Medicine</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call to Action Banner -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-32">
                <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-teal-600 to-sky-600 dark:from-teal-600/90 dark:to-sky-700/80 px-8 py-16 sm:px-16 sm:py-24 text-center text-white shadow-2xl space-y-6">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(255,255,255,0.1),transparent)]"></div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight font-heading max-w-3xl mx-auto leading-tight">
                        Experience clinical management at the speed of thought.
                    </h2>
                    <p class="text-teal-50 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                        Log in as Administrator, Doctor, or Staff to view admissions, write prescriptions, handle billings, or book appointments.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                        <a href="{{ url('/admin/login') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-white hover:bg-slate-50 text-teal-700 font-bold transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                            Admin Login
                        </a>
                        <a href="{{ url('/admin') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-teal-850 hover:bg-teal-900 text-white font-bold border border-teal-500/30 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                            Enter Dashboard Portal
                        </a>
                    </div>
                </div>
            </section>

        </main>

        <!-- Footer -->
        <footer id="contact" class="bg-white dark:bg-zinc-900 border-t border-slate-200 dark:border-zinc-800 z-10 py-12 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-12 gap-8 text-center md:text-left">
                <!-- Branding -->
                <div class="md:col-span-4 space-y-4">
                    <a href="#" class="flex items-center gap-2 justify-center md:justify-start">
                        <div class="w-8 h-8 rounded-lg bg-teal-600 dark:bg-teal-500 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold tracking-tight text-slate-900 dark:text-white font-heading">
                            Lifeline<span class="text-teal-600 dark:text-teal-400 font-bold">HMS</span>
                        </span>
                    </a>
                    <p class="text-xs text-slate-500 dark:text-zinc-500 max-w-sm mx-auto md:mx-0">
                        Integrated, secure, and lightning-fast clinical intelligence for healthcare providers and clinical administrators.
                    </p>
                </div>

                <!-- Navigation Columns -->
                <div class="md:col-span-8 grid grid-cols-2 sm:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Product</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="#features" class="text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400">Features</a></li>
                            <li><a href="#stats" class="text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400">Stats Overview</a></li>
                            <li><a href="{{ url('/admin') }}" class="text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400">HMS Portal</a></li>
                        </ul>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Resources</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="#" class="text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400">Documentation</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400">Support Center</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-zinc-400 hover:text-teal-600 dark:hover:text-teal-400">System Status</a></li>
                        </ul>
                    </div>
                    <div class="col-span-2 sm:col-span-1 space-y-3">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">System Contact</h4>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-zinc-400">
                            <li>Email: support@lifeline-hms.com</li>
                            <li>Phone: +1 (555) 019-2834</li>
                            <li>Address: Medical Center Plaza, NY</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom footer -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 mt-8 border-t border-slate-100 dark:border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-[11px] text-slate-400 dark:text-zinc-500">
                    &copy; 2026 Lifeline HMS. All rights reserved. Made for clinical excellence.
                </p>
                <div class="flex items-center gap-6 text-[11px]">
                    <a href="#" class="text-slate-400 dark:text-zinc-500 hover:text-slate-600">Privacy Policy</a>
                    <a href="#" class="text-slate-400 dark:text-zinc-500 hover:text-slate-600">Terms of Service</a>
                </div>
            </div>
        </footer>

    </body>
</html>
