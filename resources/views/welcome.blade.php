<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cybersecurity Awareness Quiz</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">
            <div class="relative min-h-screen flex flex-col">
                <!-- Navigation -->
                <header class="w-full px-6 py-4">
                    <div class="max-w-7xl mx-auto flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <svg class="h-8 w-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="text-xl font-bold text-white">CyberQuiz</span>
                        </div>
                        @if (Route::has('login'))
                            <nav class="flex items-center space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-white hover:text-blue-300 transition font-medium">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-white hover:text-blue-300 transition font-medium">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">Get Started</a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </div>
                </header>

                <!-- Hero Section -->
                <main class="flex-1 flex items-center justify-center px-6 py-12">
                    <div class="max-w-4xl mx-auto text-center">
                        <div class="mb-8">
                            <span class="inline-block bg-blue-500/20 text-blue-300 text-sm font-medium px-4 py-1.5 rounded-full border border-blue-500/30">
                                Free Security Training
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                            Test Your <span class="text-blue-400">Cybersecurity</span> Knowledge
                        </h1>
                        <p class="text-lg md:text-xl text-slate-300 mb-10 max-w-2xl mx-auto">
                            Interactive quizzes covering phishing awareness, password security, malware protection, social engineering, and data handling best practices.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold text-lg transition shadow-lg shadow-blue-500/25">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold text-lg transition shadow-lg shadow-blue-500/25">
                                    Start Learning Free
                                </a>
                                <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 text-white px-8 py-3 rounded-lg font-semibold text-lg transition border border-white/20">
                                    Sign In
                                </a>
                            @endauth
                        </div>
                    </div>
                </main>

                <!-- Features Section -->
                <section class="px-6 py-16 bg-slate-900/50">
                    <div class="max-w-6xl mx-auto">
                        <h2 class="text-2xl md:text-3xl font-bold text-white text-center mb-12">What You'll Learn</h2>
                        <div class="grid md:grid-cols-3 gap-8">
                            <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-white mb-2">Phishing Detection</h3>
                                <p class="text-slate-400">Learn to identify suspicious emails, links, and social engineering tactics used by attackers.</p>
                            </div>
                            <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                                <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-white mb-2">Password Security</h3>
                                <p class="text-slate-400">Master strong password creation, multi-factor authentication, and credential management.</p>
                            </div>
                            <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-white mb-2">Data Protection</h3>
                                <p class="text-slate-400">Understand how to handle sensitive information and protect personal and company data.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <footer class="px-6 py-8 border-t border-slate-800">
                    <div class="max-w-7xl mx-auto text-center text-slate-500 text-sm">
                        <p>Cybersecurity Awareness Quiz Platform</p>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
