<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>CampusMS</title>
</head>
<body class="bg-zinc-950 text-white overflow-x-hidden">

<section class="relative min-h-screen overflow-hidden">
    <!-- Background effects -->
    <div class="absolute inset-0">
        <div class="relative h-full w-full bg-slate-950"><div class="absolute bottom-0 left-0 right-0 top-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_2px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:40px_48px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div></div>
    </div>

    <!-- Navbar -->
    <nav
    x-data="{ open: false }"
    class="relative z-[9999] max-w-7xl mx-auto px-4 sm:px-6 pt-6">
        <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/[0.03] backdrop-blur-xl px-4 sm:px-6 py-4">
            <!-- Logo -->
            <div class="min-w-0 flex-1">
                <div class="truncate text-lg sm:text-xl font-bold tracking-tight">
                    {{ __('welcome.nav.brand') }}
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-8 text-sm text-zinc-400 mx-8">
                <a href="#features" class="hover:text-white transition whitespace-nowrap">
                    {{ __('welcome.nav.features') }}
                </a>

                <a href="#platform" class="hover:text-white transition whitespace-nowrap">
                    {{ __('welcome.nav.platform') }}
                </a>

                <a href="#security" class="hover:text-white transition whitespace-nowrap">
                    {{ __('welcome.nav.security') }}
                </a>
            </div>

            <!-- Desktop Actions -->
            <div class="hidden lg:flex items-center gap-4 flex-shrink-0">

                <div class="flex rounded-xl border border-white/10 bg-white/5 p-1 backdrop-blur-md">
                    @foreach (['en' => 'EN', 'ar' => 'AR'] as $locale => $label)
                        <a
                            href="{{ route('lang.switch', $locale) }}"
                            class="min-w-[52px] rounded-lg px-3 py-2 text-center text-sm font-medium transition-all duration-300
                            {{ app()->getLocale() === $locale
                                ? 'bg-white text-zinc-900'
                                : 'text-zinc-400 hover:bg-white/10 hover:text-white'
                            }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <a
                    href="/school_admin"
                    class="whitespace-nowrap rounded-xl bg-cyan-700 px-5 py-2.5 text-sm font-medium transition hover:bg-cyan-500">
                    {{ __('welcome.nav.dashboard') }}
                </a>

            </div>

            <!-- Mobile Button -->
            <button
                @click="open = !open"
                class="lg:hidden relative flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/5 backdrop-blur-md transition hover:bg-white/10">

                <span class="sr-only">Toggle Menu</span>

                <div class="relative h-4 w-5">
                    <span
                        class="absolute left-0 top-0 h-0.5 w-5 bg-white rounded-full transition-all duration-300 origin-center"
                        :class="open ? 'top-1/2 -translate-y-1/2 rotate-45' : ''">
                    </span>

                    <span
                        class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 w-5 bg-white rounded-full transition-all duration-300"
                        :class="open ? 'opacity-0' : ''">
                    </span>

                    <span
                        class="absolute left-0 bottom-0 h-0.5 w-5 bg-white rounded-full transition-all duration-300 origin-center"
                        :class="open ? 'bottom-1/2 translate-y-1/2 -rotate-45' : ''">
                    </span>
                </div>
            </button>
        </div>

        <!-- Mobile Menu -->
        <!-- Mobile Dropdown -->
        <div
            x-show="open"
            x-cloak
            @click.outside="open = false"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
            class="absolute left-4 right-4 top-full mt-3 z-[99999] lg:hidden">

            <div
                class="overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-r from-blue-900/50 via-cyan-950/50 to-emerald-400/5 backdrop-blur-2xl shadow-[0_20px_80px_rgba(0,0,0,0.6)]">

                <div class="space-y-1 p-3">

                    <a href="#features" @click="open = false"
                        class="block rounded-xl px-4 py-3 hover:bg-white/5">
                        {{ __('welcome.nav.features') }}
                    </a>

                    <a href="#platform" @click="open = false"
                        class="block rounded-xl px-4 py-3 hover:bg-white/5">
                        {{ __('welcome.nav.platform') }}
                    </a>

                    <a href="#security" @click="open = false"
                        class="block rounded-xl px-4 py-3 hover:bg-white/5">
                        {{ __('welcome.nav.security') }}
                    </a>

                    <div class="my-3 h-px bg-white/10"></div>

                    <div class="flex rounded-xl border border-white/10 bg-white/5 p-1">

                        @foreach(['en'=>'EN','ar'=>'AR'] as $locale => $label)
                            <a
                                href="{{ route('lang.switch',$locale) }}"
                                class="flex-1 rounded-lg px-3 py-2 text-center
                                {{ app()->getLocale()===$locale
                                    ? 'bg-white text-zinc-900'
                                    : 'text-zinc-400 hover:bg-white/10 hover:text-white'
                                }}">
                                {{ $label }}
                            </a>
                        @endforeach

                    </div>

                    <a
                        href="/school_admin"
                        class="mt-3 block rounded-xl bg-cyan-700 px-5 py-3 text-center font-medium hover:bg-cyan-500">
                        {{ __('welcome.nav.dashboard') }}
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-20">
        <div class="text-center max-w-5xl mx-auto">
            <p class="hero-badge inline-flex items-center gap-2 rounded-full border border-blue-500/30 bg-blue-500/10 px-5 py-2 text-sm text-blue-300">✦ {{ __('welcome.hero.badge') }}</p>

            <h1 class="hero-title mt-8 text-6xl md:text-8xl font-bold tracking-tight leading-[0.95]">
                {{ __('welcome.hero.title_line1') }}
                <br>
                <span class="bg-gradient-to-r from-blue-400 via-cyan-300 to-emerald-400 text-transparent bg-clip-text">{{ __('welcome.hero.title_line2') }}</span>
            </h1>

            <p class="hero-description mt-8 mx-auto max-w-2xl text-lg text-zinc-400 leading-relaxed">{{ __('welcome.hero.description') }}</p>

            <div class="hero-actions mt-10 flex justify-center gap-4 flex-wrap">
                <a href="/school_admin" class="rounded-xl bg-white text-black px-8 py-4 font-semibold hover:scale-105 transition">{{ __('welcome.hero.launch_dashboard') }}</a>
                <a href="#features" class="rounded-xl border border-white/10 bg-white/5 px-8 py-4 hover:bg-white/10 transition">{{ __('welcome.hero.explore_platform') }}</a>
            </div>
        </div>

        <!-- Dashboard -->
        <div class="dashboard-preview relative mt-24 mx-auto max-w-6xl">
            <!-- Glow -->
            <div class="absolute inset-0 bg-blue-500/20 blur-[100px]"></div>

            <div class="relative rounded-3xl border border-cyan-500/20 bg-[#0b1120] shadow-2xl overflow-hidden">
                <!-- Browser -->
                <div class="flex items-center gap-2 px-6 py-4 border-b border-cyan-500/20">
                    <span class="w-3 h-3 rounded-full bg-red-400"></span>
                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                    <span class="w-3 h-3 rounded-full bg-green-400"></span>
                    <div class="ml-5 rounded-lg bg-white/5 px-5 py-2 text-xs text-zinc-400">{{ __('welcome.hero.browser_url') }}</div>
                </div>

                <div class="grid lg:grid-cols-4">
                    <div class="hidden lg:block border-r border-cyan-500/20 p-6">
                        <div class="space-y-5 text-zinc-400 text-sm">
                            <p class="text-white">{{ __('welcome.hero.sidebar.dashboard') }}</p>
                            <p>{{ __('welcome.hero.sidebar.students') }}</p>
                            <p>{{ __('welcome.hero.sidebar.attendance') }}</p>
                            <p>{{ __('welcome.hero.sidebar.schedule') }}</p>
                            <p>{{ __('welcome.hero.sidebar.reports') }}</p>
                        </div>
                    </div>

                    <div class="lg:col-span-3 p-8">
                        <div class="grid md:grid-cols-3 gap-5">

                            <div class="relative group rounded-2xl p-[1px] overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 via-cyan-400/10 to-transparent blur-xl opacity-70 group-hover:opacity-100 transition"></div>

                                <div class="relative rounded-2xl bg-white/[0.07] backdrop-blur-xl border border-cyan-500/20 p-6 shadow-[0_0_40px_rgba(37,99,235,0.15)]">
                                    <p class="text-zinc-400">{{ __('welcome.hero.stats.students') }}</p>
                                    <h3 class="text-4xl font-bold mt-2 text-white">1245</h3>
                                </div>
                            </div>


                            <div class="relative group rounded-2xl p-[1px] overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/20 via-blue-500/10 to-transparent blur-xl opacity-70 group-hover:opacity-100 transition"></div>

                                <div class="relative rounded-2xl bg-white/[0.07] backdrop-blur-xl border border-cyan-500/20 p-6 shadow-[0_0_40px_rgba(6,182,212,0.15)]">
                                    <p class="text-zinc-400">{{ __('welcome.hero.stats.attendance') }}</p>
                                    <h3 class="text-4xl font-bold mt-2 text-white">96%</h3>
                                </div>
                            </div>


                            <div class="relative group rounded-2xl p-[1px] overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 via-green-400/10 to-transparent blur-xl opacity-70 group-hover:opacity-100 transition"></div>

                                <div class="relative rounded-2xl bg-white/[0.07] backdrop-blur-xl border border-cyan-500/20 p-6 shadow-[0_0_40px_rgba(16,185,129,0.15)]">
                                    <p class="text-zinc-400">{{ __('welcome.hero.stats.teachers') }}</p>
                                    <h3 class="text-4xl font-bold mt-2 text-white">86</h3>
                                </div>
                            </div>

                        </div>


                        <!-- Glass chart placeholder -->
                        <div class="relative mt-6 rounded-2xl p-[1px] overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-cyan-400/10 to-emerald-500/20 blur-xl"></div>

                            <div class="relative h-48 rounded-2xl bg-white/[0.06] backdrop-blur-xl border border-cyan-500/20">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute z-[999] bottom-0 left-0 w-full overflow-visible leading-none pointer-events-none">
        <svg
            class="relative block w-full h-40 overflow-visible"
            viewBox="0 0 1440 140"
            preserveAspectRatio="none"
        >
            <defs>

                <!-- Stroke gradient -->
                <linearGradient id="heroCurveStroke" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#2563eb" />
                    <stop offset="50%" stop-color="#06b6d4" />
                    <stop offset="100%" stop-color="#10b981" />
                </linearGradient>


                <!-- Smooth thickness mask -->
                <linearGradient id="strokeThickness" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="black"/>
                    <stop offset="20%" stop-color="white"/>
                    <stop offset="40%" stop-color="white"/>
                    <stop offset="50%" stop-color="white"/>
                    <stop offset="60%" stop-color="white"/>
                    <stop offset="80%" stop-color="white"/>
                    <stop offset="100%" stop-color="black"/>
                </linearGradient>

                <mask id="thicknessMask">
                    <rect 
                        width="1440" 
                        height="140"
                        fill="url(#strokeThickness)"
                    />
                </mask>


                <!-- Upper neon glow only -->
                <filter 
                    id="upperGlow"
                    x="-50%"
                    y="-100%"
                    width="200%"
                    height="200%"
                >

                    <!-- Move glow upward -->
                    <feOffset 
                        dy="-6"
                        result="offsetGlow"
                    />

                    <feGaussianBlur
                        in="offsetGlow"
                        stdDeviation="10"
                        result="blurGlow"
                    />

                    <feColorMatrix
                        in="blurGlow"
                        type="matrix"
                        values="
                        1 0 0 0 0
                        0 1 0 0 0
                        0 0 1 0 0
                        0 0 0 0.8 0"
                    />

                    <feMerge>
                        <feMergeNode/>
                    </feMerge>

                </filter>


            </defs>


            <!-- Background fill -->
            <path
                d="
                M0,20
                C260,170 1180,170 1440,20
                L1440,140
                L0,140
                Z"
                fill="#09090b"
            />


            <!-- Glow layer ABOVE the curve -->
            <path
                d="
                M0,20
                C260,170 1180,170 1440,20"
                fill="none"
                stroke="url(#heroCurveStroke)"
                stroke-width="4"
                stroke-linecap="round"
                filter="url(#upperGlow)"
            />


            <!-- Single adaptive stroke -->
            <path
                d="
                M0,20
                C260,170 1180,170 1440,20"
                fill="none"
                stroke="url(#heroCurveStroke)"
                stroke-width="4"
                stroke-linecap="round"
                mask="url(#thicknessMask)"
            />


        </svg>
    </div>
</section>

<section id="features" class="modules-section py-32 relative">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Heading -->
        <div class="max-w-3xl mb-16">
            <p class="text-sky-400 uppercase tracking-widest text-sm font-semibold">{{ __('welcome.features_section.eyebrow') }}</p>
            <h2 class="mt-4 text-4xl md:text-6xl font-bold">
                {{ __('welcome.features_section.heading_white') }}
                <span class="text-zinc-500">{{ __('welcome.features_section.heading_muted') }}</span>
            </h2>
            <p class="mt-6 text-zinc-400 text-lg">{{ __('welcome.features_section.description') }}</p>
        </div>

        <!-- Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="module-card group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-sky-500/20 mb-6"><i data-lucide="users" class="text-sky-400"></i></div>
                <h3 class="text-xl font-semibold">{{ __('welcome.features_section.cards.student_management.title') }}</h3>
                <p class="mt-4 text-zinc-400 leading-relaxed">{{ __('welcome.features_section.cards.student_management.description') }}</p>
            </div>

            <div class="module-card group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-sky-500/20 mb-6"><i data-lucide="clipboard-check" class="text-sky-400"></i></div>
                <h3 class="text-xl font-semibold">{{ __('welcome.features_section.cards.smart_attendance.title') }}</h3>
                <p class="mt-4 text-zinc-400 leading-relaxed">{{ __('welcome.features_section.cards.smart_attendance.description') }}</p>
            </div>

            <div class="module-card group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-sky-500/20 mb-6"><i data-lucide="calendar-days" class="text-sky-400"></i></div>
                <h3 class="text-xl font-semibold">{{ __('welcome.features_section.cards.scheduling.title') }}</h3>
                <p class="mt-4 text-zinc-400 leading-relaxed">{{ __('welcome.features_section.cards.scheduling.description') }}</p>
            </div>

            <div class="module-card group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-sky-500/20 mb-6"><i data-lucide="bar-chart-3" class="text-sky-400"></i></div>
                <h3 class="text-xl font-semibold">{{ __('welcome.features_section.cards.reports_analytics.title') }}</h3>
                <p class="mt-4 text-zinc-400 leading-relaxed">{{ __('welcome.features_section.cards.reports_analytics.description') }}</p>
            </div>
        </div>
    </div>
</section>

<section id="platform" class="dashboard-section py-32 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="dashboard-section-content text-center max-w-3xl mx-auto mb-16">
            <p class="text-sky-400 uppercase tracking-widest text-sm font-semibold">{{ __('welcome.dashboard_section.eyebrow') }}</p>
            <h2 class="mt-4 text-4xl md:text-6xl font-bold">{{ __('welcome.dashboard_section.heading') }}</h2>
            <p class="mt-6 text-zinc-400 text-lg">{{ __('welcome.dashboard_section.description') }}</p>
        </div>

        <!-- Browser -->
        <div class="dashboard-section-content rounded-3xl border border-white/10 bg-gradient-to-r from-blue-300/10 via-cyan-100/5 to-transparent shadow-2xl overflow-hidden">
            <!-- Browser header -->
            <div class="flex items-center gap-2 px-6 py-4 border-b border-white/10">
                <span class="w-3 h-3 rounded-full bg-red-400"></span>
                <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                <span class="w-3 h-3 rounded-full bg-green-400"></span>
                <div class="ml-6 rounded-lg bg-white/5 px-6 py-2 text-sm text-zinc-400">{{ __('welcome.dashboard_section.browser_url') }}</div>
            </div>

            <div class="grid lg:grid-cols-[220px_1fr]">
                <!-- Sidebar -->
                <aside class="hidden lg:block border-r border-white/10 p-6">
                    <h3 class="font-bold mb-8">{{ __('welcome.dashboard_section.brand') }}</h3>
                    <nav class="space-y-5 text-zinc-400">
                        <div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>{{ __('welcome.dashboard_section.sidebar.dashboard') }}</div>
                        <div class="flex items-center gap-2"><i data-lucide="users" class="w-4 h-4"></i>{{ __('welcome.dashboard_section.sidebar.students') }}</div>
                        <div class="flex items-center gap-2"><i data-lucide="clipboard-check" class="w-4 h-4"></i>{{ __('welcome.dashboard_section.sidebar.attendance') }}</div>
                        <div class="flex items-center gap-2"><i data-lucide="calendar-days" class="w-4 h-4"></i>{{ __('welcome.dashboard_section.sidebar.schedule') }}</div>
                        <div class="flex items-center gap-2"><i data-lucide="bar-chart-3" class="w-4 h-4"></i>{{ __('welcome.dashboard_section.sidebar.reports') }}</div>
                    </nav>
                </aside>

                <!-- Content -->
                <div class="p-6">
                    <!-- Stats -->
                    <div class="grid md:grid-cols-4 gap-5">
                        <div class="rounded-2xl bg-white/5 p-6">
                            <p class="text-zinc-400">{{ __('welcome.dashboard_section.stats.students') }}</p>
                            <h3 class="counter text-4xl font-bold" data-value="1245">0</h3>
                        </div>
                        <div class="rounded-2xl bg-white/5 p-6">
                            <p class="text-zinc-400">{{ __('welcome.dashboard_section.stats.teachers') }}</p>
                            <h3 class="counter text-4xl font-bold" data-value="86">0</h3>
                        </div>
                        <div class="rounded-2xl bg-white/5 p-6">
                            <p class="text-zinc-400">{{ __('welcome.dashboard_section.stats.attendance') }}</p>
                            <h3 class="text-4xl font-bold">96%</h3>
                        </div>
                        <div class="rounded-2xl bg-white/5 p-6">
                            <p class="text-zinc-400">{{ __('welcome.dashboard_section.stats.reports') }}</p>
                            <h3 class="counter text-4xl font-bold" data-value="42">0</h3>
                        </div>
                    </div>

                    <!-- Lower widgets -->
                    <div class="grid md:grid-cols-2 gap-6 mt-6">
                        <!-- Chart -->
                        <div class="rounded-2xl bg-white/5 p-6">
                            <h3 class="font-semibold mb-6">{{ __('welcome.dashboard_section.chart_title') }}</h3>
                            <div class="flex items-end gap-3 h-40">
                                <div class="w-full bg-sky-500/40 rounded-t-lg h-[60%]"></div>
                                <div class="w-full bg-sky-500/40 rounded-t-lg h-[80%]"></div>
                                <div class="w-full bg-sky-500/40 rounded-t-lg h-[45%]"></div>
                                <div class="w-full bg-sky-500/40 rounded-t-lg h-[90%]"></div>
                                <div class="w-full bg-sky-500/40 rounded-t-lg h-[70%]"></div>
                            </div>
                        </div>

                        <!-- Activity -->
                        <div class="rounded-2xl bg-white/5 p-6">
                            <h3 class="font-semibold mb-6">{{ __('welcome.dashboard_section.activity_title') }}</h3>
                            <div class="space-y-5 text-zinc-400">
                                <p class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400"></i>{{ __('welcome.dashboard_section.activity.item1') }}</p>
                                <p class="flex items-center gap-2"><i data-lucide="user-plus" class="w-4 h-4"></i>{{ __('welcome.dashboard_section.activity.item2') }}</p>
                                <p class="flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4"></i>{{ __('welcome.dashboard_section.activity.item3') }}</p>
                                <p class="flex items-center gap-2"><i data-lucide="file-text" class="w-4 h-4"></i>{{ __('welcome.dashboard_section.activity.item4') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="roadmap-section py-32 relative">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Heading -->
        <div class="max-w-3xl mb-20">
            <p class="text-sky-400 uppercase tracking-widest text-sm font-semibold">{{ __('welcome.roadmap_section.eyebrow') }}</p>
            <h2 class="mt-4 text-4xl md:text-6xl font-bold">
                {{ __('welcome.roadmap_section.heading_line1') }}
                <br>
                <span class="text-zinc-500">{{ __('welcome.roadmap_section.heading_line2') }}</span>
            </h2>
            <p class="mt-6 text-zinc-400 text-lg">{{ __('welcome.roadmap_section.description') }}</p>
        </div>

        <!-- Timeline -->
        <div class="relative">
            <!-- vertical line -->
            <div class="absolute {{ app()->getLocale() === 'ar' ? 'right-5' : 'left-5' }} top-0 bottom-0 w-px bg-white/10 hidden md:block"></div>

            <div class="space-y-10">
                <!-- Gradebook -->
                <div class="roadmap-item relative md:flex gap-10">
                    <div class="hidden md:flex w-10 h-10 rounded-full bg-sky-600 items-center justify-center z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-pen-icon lucide-notebook-pen"><path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><path d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/></svg>
                    </div>
                    <div class="flex-1 rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                        <h3 class="text-2xl font-bold">{{ __('welcome.roadmap_section.gradebook.title') }}</h3>
                        <p class="mt-3 text-zinc-400">{{ __('welcome.roadmap_section.gradebook.description') }}</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <span class="feature-pill">{{ __('welcome.roadmap_section.gradebook.pills.gpa_calculation') }}</span>
                            <span class="feature-pill">{{ __('welcome.roadmap_section.gradebook.pills.report_cards') }}</span>
                            <span class="feature-pill">{{ __('welcome.roadmap_section.gradebook.pills.performance_analytics') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Communication -->
                <div class="roadmap-item relative md:flex gap-10">
                    <div class="hidden md:flex w-10 h-10 rounded-full bg-sky-600 items-center justify-center z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-icon lucide-bell"><path d="M10.268 21a2 2 0 0 0 3.464 0"/><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/></svg>
                    </div>
                    <div class="flex-1 rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                        <h3 class="text-2xl font-bold">{{ __('welcome.roadmap_section.communication.title') }}</h3>
                        <p class="mt-3 text-zinc-400">{{ __('welcome.roadmap_section.communication.description') }}</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <span class="feature-pill">{{ __('welcome.roadmap_section.communication.pills.announcements') }}</span>
                            <span class="feature-pill">{{ __('welcome.roadmap_section.communication.pills.email_sms_alerts') }}</span>
                            <span class="feature-pill">{{ __('welcome.roadmap_section.communication.pills.messaging') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Exams -->
                <div class="roadmap-item relative md:flex gap-10">
                    <div class="hidden md:flex w-10 h-10 rounded-full bg-sky-600 items-center justify-center z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-monitor-icon lucide-monitor"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>                    </div>
                    <div class="flex-1 rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                        <h3 class="text-2xl font-bold">{{ __('welcome.roadmap_section.exams.title') }}</h3>
                        <p class="mt-3 text-zinc-400">{{ __('welcome.roadmap_section.exams.description') }}</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <span class="feature-pill">{{ __('welcome.roadmap_section.exams.pills.quizzes') }}</span>
                            <span class="feature-pill">{{ __('welcome.roadmap_section.exams.pills.auto_grading') }}</span>
                            <span class="feature-pill">{{ __('welcome.roadmap_section.exams.pills.teacher_feedback') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="security" class="trust-section py-32">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-sky-400 uppercase tracking-widest text-sm font-semibold">{{ __('welcome.trust_section.eyebrow') }}</p>
            <h2 class="mt-4 text-4xl md:text-6xl font-bold">{{ __('welcome.trust_section.heading') }}</h2>
            <p class="mt-6 text-zinc-400 text-lg">{{ __('welcome.trust_section.description') }}</p>
        </div>

        <!-- Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex-1 trust-card rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="mb-6 bg-sky-500/20 w-14 h-14 flex items-center justify-center rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="oklch(71.5% 0.143 215.221)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <h3 class="text-xl font-bold">{{ __('welcome.trust_section.cards.secure.title') }}</h3>
                <p class="mt-4 text-zinc-400">{{ __('welcome.trust_section.cards.secure.description') }}</p>
            </div>

            <div class="flex-1 trust-card rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="mb-6 bg-sky-500/20 w-14 h-14 flex items-center justify-center rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="oklch(71.5% 0.143 215.221)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap-icon lucide-zap"><path d="M15.914 4a1.5 1.5 0 00-2.474-1.561l-9 9A1.5 1.5 0 005.5 14h4.002a.5.5 0 01.471.666L8.086 20a1.5 1.5 0 002.475 1.56l9-9A1.5 1.5 0 0018.5 10h-3.997a.5.5 0 01-.472-.667z"/></svg>
                </div>
                <h3 class="text-xl font-bold">{{ __('welcome.trust_section.cards.fast.title') }}</h3>
                <p class="mt-4 text-zinc-400">{{ __('welcome.trust_section.cards.fast.description') }}</p>
            </div>

            <div class="flex-1 trust-card rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="mb-6 bg-sky-500/20 w-14 h-14 flex items-center justify-center rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="oklch(71.5% 0.143 215.221)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-column-icon lucide-chart-column"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
                </div>
                <h3 class="text-xl font-bold">{{ __('welcome.trust_section.cards.data_driven.title') }}</h3>
                <p class="mt-4 text-zinc-400">{{ __('welcome.trust_section.cards.data_driven.description') }}</p>
            </div>

            <div class="trust-card rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8">
                <div class="mb-6 bg-sky-500/20 w-14 h-14 flex items-center justify-center rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="oklch(71.5% 0.143 215.221)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rocket-icon lucide-rocket"><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09"/><path d="M9 12a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.4 22.4 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 .05 5 .05"/></svg>
                </div>
                <h3 class="text-xl font-bold">{{ __('welcome.trust_section.cards.scalable.title') }}</h3>
                <p class="mt-4 text-zinc-400">{{ __('welcome.trust_section.cards.scalable.description') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="cta-section py-32 relative overflow-hidden">
    <!-- Background glow -->
    <div class="absolute inset-0 -z-10 h-full w-full bg-black [background:radial-gradient(125%_125%_at_50%_10%,#09090b_40%,#33CCEE_100%)]"></div>

    <div class="cta-content relative max-w-5xl mx-auto px-6 text-center">
        <h2 class="text-5xl md:text-7xl font-bold leading-tight">{{ __('welcome.cta_section.heading') }}</h2>
        <p class="mt-8 max-w-2xl mx-auto text-lg text-zinc-400">{{ __('welcome.cta_section.description') }}</p>

        <div class="mt-10 flex justify-center gap-5 flex-wrap">
            <a href="/school_admin" class="px-8 py-4 rounded-2xl bg-cyan-600 hover:bg-cyan-500 transition font-semibold shadow-lg shadow-sky-400/30">{{ __('welcome.cta_section.open_dashboard') }}</a>
            <a href="#features" class="px-8 py-4 rounded-2xl border border-white/10 hover:bg-white/5 transition">{{ __('welcome.cta_section.explore_platform') }}</a>
        </div>
    </div>
</section>

</body>

<footer class="border-t border-cyan-300/70 py-10">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between gap-6 text-zinc-400">
        <div>
            <h3 class="text-white font-bold text-xl">{{ __('welcome.footer.brand') }}</h3>
            <p class="mt-2 text-sm">{{ __('welcome.footer.tagline') }}</p>
        </div>

        <div class="flex gap-8 text-sm">
            <a href="#features" class="hover:text-white transition">{{ __('welcome.footer.features') }}</a>
            <a href="/school_admin" class="hover:text-white transition">{{ __('welcome.footer.dashboard') }}</a>
            <a href="#" class="hover:text-white transition">{{ __('welcome.footer.contact') }}</a>
        </div>

        <div class="text-sm">© {{ date('Y') }} {{ __('welcome.footer.brand') }}. {{ __('welcome.footer.rights') }}</div>
    </div>
</footer>

</html>