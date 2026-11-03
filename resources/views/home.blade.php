@extends('layouts.app')

@section('content')
<div class="relative w-full min-h-screen">

    <!-- ========================================== -->
    <!-- 1. DESKTOP LAYOUT (Screen width >= 1024px) -->
    <!-- ========================================== -->
    <div class="desktop-layout hidden lg:grid lg:grid-cols-[72px_1fr_340px] xl:grid-cols-[240px_1fr_360px] max-w-[1440px] w-full mx-auto min-h-screen">
        
        <!-- SIDEBAR -->
        <aside class="side bg-[var(--color-surface)] border-r border-[var(--color-border)] p-5 flex flex-col gap-1.5 sticky top-0 h-screen z-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo flex items-center gap-2.5 mb-6 no-underline" title="Gabe Medica">
                <img src="{{ asset('images/gabe-medica-logo.png') }}" alt="Gabe Medica" class="h-9 w-auto object-contain hidden xl:block" />
                <img src="{{ asset('images/gabe-medica-icon.png') }}" alt="Gabe Medica" class="h-9 w-auto object-contain block xl:hidden" />
            </a>

            <!-- Navigation Items -->
            <nav class="flex flex-col gap-1 w-full" aria-label="Navigasi Utama">
                <!-- Beranda (Active) -->
                <button class="nav flex items-center gap-3 p-2.5 rounded-xl text-[var(--color-primary)] bg-[var(--color-primary-tint)] font-semibold relative text-left w-full transition-colors" aria-current="page">
                    <span class="hidden xl:block absolute -left-5 top-2.5 bottom-2.5 w-[3px] rounded-r bg-[var(--color-primary)]"></span>
                    <svg class="app-svg-icon text-[var(--color-primary)]"><use href="#icon-home"/></svg>
                    <span class="hidden xl:inline text-[14px]">Beranda</span>
                </button>

                <!-- Jadwal -->
                <button class="nav flex items-center gap-3 p-2.5 rounded-xl text-[var(--color-text-secondary)] hover:bg-[var(--color-primary-tint)]/60 text-left w-full transition-colors" onclick="window.showToast('Membuka tab Jadwal...')">
                    <svg class="app-svg-icon"><use href="#icon-cal"/></svg>
                    <span class="hidden xl:inline text-[14px]">Jadwal</span>
                </button>

                <!-- Dokter -->
                <button class="nav flex items-center gap-3 p-2.5 rounded-xl text-[var(--color-text-secondary)] hover:bg-[var(--color-primary-tint)]/60 text-left w-full transition-colors" onclick="window.showToast('Membuka direktori Dokter...')">
                    <svg class="app-svg-icon"><use href="#icon-user"/></svg>
                    <span class="hidden xl:inline text-[14px]">Dokter</span>
                </button>

                <!-- Rekam Medis -->
                <button class="nav flex items-center gap-3 p-2.5 rounded-xl text-[var(--color-text-secondary)] hover:bg-[var(--color-primary-tint)]/60 text-left w-full transition-colors" onclick="window.showToast('Membuka Rekam Medis pasien...')">
                    <svg class="app-svg-icon"><use href="#icon-doc"/></svg>
                    <span class="hidden xl:inline text-[14px]">Rekam Medis</span>
                </button>

                <!-- Pengaturan -->
                <button class="nav flex items-center gap-3 p-2.5 rounded-xl text-[var(--color-text-secondary)] hover:bg-[var(--color-primary-tint)]/60 text-left w-full transition-colors" onclick="window.showToast('Membuka Pengaturan...')">
                    <svg class="app-svg-icon"><use href="#icon-set"/></svg>
                    <span class="hidden xl:inline text-[14px]">Pengaturan</span>
                </button>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav flex items-center gap-3 p-2.5 rounded-xl text-purple-700 bg-purple-50 hover:bg-purple-100 text-left w-full transition-colors font-medium">
                            <svg class="app-svg-icon text-purple-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span class="hidden xl:inline text-[14px]">Portal Admin</span>
                        </a>
                    @endif

                    <!-- Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="nav flex items-center gap-3 p-2.5 rounded-xl text-red-600 hover:bg-red-50 text-left w-full transition-colors font-medium">
                            <svg class="app-svg-icon text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            <span class="hidden xl:inline text-[14px]">Keluar</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav flex items-center gap-3 p-2.5 rounded-xl text-[var(--color-primary)] bg-[var(--color-primary-tint)] hover:brightness-105 text-left w-full transition-colors font-semibold">
                        <svg class="app-svg-icon text-[var(--color-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        <span class="hidden xl:inline text-[14px]">Masuk / Login</span>
                    </a>
                @endauth
            </nav>

            <!-- AI Assistant Promo Card -->
            <div class="ai-assistant-card hidden xl:block mt-auto rounded-[18px] text-white p-4 text-[12px] leading-relaxed shadow-sm" style="background: linear-gradient(135deg, #1F6F73 0%, #2F8386 45%, #6FA9AA 100%);">
                <div class="flex items-center gap-1.5 font-bold text-[14px] mb-1">
                    <svg class="app-svg-icon w-4 h-4 text-teal-200"><use href="#icon-sparkle"/></svg>
                    <span>AI Assistant</span>
                </div>
                <p class="text-white/85 text-[11.5px]">Tanyakan gejala dan dapatkan saran dokter serta langkah medis yang tepat secara instan.</p>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="main-content px-8 py-6 min-w-0 flex flex-col gap-6">
            
            <!-- Top Bar -->
            <header class="top-bar flex items-center gap-4">
                <!-- Search Input Pill -->
                <div class="search-box flex-1 max-w-[480px] flex items-center gap-2.5 bg-[var(--color-surface)] border border-[var(--color-border)] rounded-full px-4 h-11 text-[var(--color-text-muted)] focus-within:border-[var(--color-primary)] focus-within:shadow-[var(--focus-ring)] transition-all">
                    <svg class="app-svg-icon w-4 h-4 text-[var(--color-text-muted)]"><use href="#icon-search"/></svg>
                    <input id="search-input" type="search" placeholder="Cari dokter atau spesialisasi..." class="flex-1 bg-transparent border-none text-[var(--color-text)] placeholder-[var(--color-text-muted)] text-[13.5px] outline-none h-full" aria-label="Cari dokter">
                </div>

                <div class="flex-1"></div>

                <!-- Theme Toggle Button -->
                <button id="theme-toggle" class="glass-btn !bg-[var(--color-surface)] !text-[var(--color-text)] !border-[var(--color-border)] hover:!border-[var(--color-primary)]" aria-label="Ubah tema gelap / terang" title="Ubah tema">
                    <svg class="app-svg-icon w-4 h-4"><use href="#icon-sun"/></svg>
                </button>

                <!-- Notification Bell -->
                <button class="glass-btn !bg-[var(--color-surface)] !text-[var(--color-text)] !border-[var(--color-border)] relative hover:!border-[var(--color-primary)]" aria-label="Notifikasi" onclick="window.showToast('Tidak ada notifikasi baru.')">
                    <svg class="app-svg-icon w-4 h-4"><use href="#icon-bell"/></svg>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500"></span>
                </button>

                <!-- User Profile / Auth Action -->
                @auth
                    <div class="user-pill flex items-center gap-2.5 pl-2">
                        <div class="avatar-initials w-11 h-11 text-[14px]">{{ $user['initials'] }}</div>
                        <div class="hidden xl:block leading-tight text-left">
                            <b class="block text-[13.5px] text-[var(--color-text)]">{{ $user['name'] }}</b>
                            <small class="block text-[11.5px] text-[var(--color-text-muted)]">{{ $user['role'] }}</small>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-primary !h-11 !px-5 !py-0 flex items-center gap-2 text-[13.5px] rounded-full font-semibold shadow-sm hover:opacity-95 transition-all">
                        <svg class="app-svg-icon w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        <span>Masuk</span>
                    </a>
                @endauth
            </header>

            <!-- Greeting Banner with Integrated Next Appointment Card -->
            <section class="banner rounded-[24px] p-7 flex justify-between items-center gap-6 flex-wrap text-white shadow-sm" style="background: linear-gradient(135deg, #1F6F73 0%, #2F8386 45%, #6FA9AA 100%);">
                <div class="max-w-[340px]">
                    <small class="text-white/80 text-[13px] block">Good afternoon,</small>
                    <h1 class="text-[30px] font-semibold leading-[1.2] mt-1 text-white">What’s on your health today?</h1>
                </div>

                <!-- Next Appointment Card -->
                <div class="next-appt-card bg-[var(--color-surface)] text-[var(--color-text)] rounded-[22px] p-4 w-[370px] max-w-full shadow-[var(--shadow-card)]">
                    <small class="text-[var(--color-text-muted)] text-[11px] font-medium block mb-2.5 uppercase tracking-wider">Next Appointment</small>
                    <div class="flex items-center gap-3">
                        <div class="w-[52px] h-[52px] rounded-[14px] bg-[var(--color-primary-soft)] overflow-hidden flex items-end justify-center flex-shrink-0 border border-[var(--color-border)]">
                            <img src="{{ asset($nextAppointment['image']) }}" alt="{{ $nextAppointment['doctor_name'] }}" class="h-full w-auto object-contain object-bottom">
                        </div>
                        <div class="min-w-0">
                            <b class="block text-[14.5px] truncate">{{ $nextAppointment['doctor_name'] }}</b>
                            <small class="block text-[var(--color-text-secondary)] text-[11.5px] mt-0.5 truncate">{{ $nextAppointment['specialty'] }}</small>
                            <small class="block text-[var(--color-primary-dark)] font-medium text-[11px] mt-0.5">{{ $nextAppointment['date_time'] }}</small>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5 mt-3.5">
                        <button class="btn-reschedule h-9 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] text-[var(--color-text)] font-medium text-[12px] hover:bg-[var(--color-primary-tint)] transition-colors">Reschedule</button>
                        <button class="btn-join-call h-9 rounded-xl bg-[var(--color-primary)] hover:brightness-105 text-white font-medium text-[12px] flex items-center justify-center gap-1.5 transition-all">
                            <svg class="app-svg-icon w-3.5 h-3.5"><use href="#icon-vid"/></svg>
                            Join Call
                        </button>
                    </div>
                </div>
            </section>

            <!-- Category Specialty Chips -->
            <div class="specialty-chips-wrapper flex flex-wrap gap-2 pt-1" role="group" aria-label="Kategori Spesialisasi">
                @foreach ($categories as $cat)
                    <button class="specialty-chip desktop-chip {{ $cat['id'] === 'all' ? 'active' : '' }}" data-cat="{{ $cat['id'] }}">
                        {{ $cat['name'] }}
                    </button>
                @endforeach
            </div>

            <!-- Doctors Section Header -->
            <div class="section-header flex justify-between items-center mt-2">
                <h2 class="text-[20px] font-semibold text-[var(--color-text)]">Find a Doctor</h2>
                <a href="javascript:void(0)" onclick="window.showToast('Menampilkan seluruh dokter')" class="text-[var(--color-primary)] hover:underline text-[13px] font-medium">View All</a>
            </div>

            <!-- Doctor Grid -->
            <div id="doctors-grid" class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-10 pb-8">
                @foreach ($doctors as $index => $doc)
                    <button class="doctor-card group {{ $index === 2 ? 'selected' : '' }}" 
                            data-id="{{ $doc['id'] }}"
                            data-name="{{ $doc['name'] }}"
                            data-specialty="{{ $doc['specialty'] }}"
                            data-category="{{ $doc['category'] }}"
                            data-rating="{{ $doc['rating'] }}"
                            data-price="{{ $doc['price'] }}"
                            data-initials="{{ $doc['initials'] }}"
                            data-image="{{ asset($doc['image']) }}"
                            data-availability="{{ $doc['availability'] }}"
                            data-experience="{{ $doc['experience'] }}"
                            data-patients="{{ $doc['patients'] }}">
                        
                        <!-- 3D Microscope Icon (Out-of-Bounds Pop-out at Top Right) -->
                        <div class="absolute -top-7 -right-2 w-16 h-16 sm:w-20 sm:h-20 z-30 pointer-events-none transition-transform duration-300 ease-out group-hover:scale-110 group-hover:-rotate-6 drop-shadow-[0_8px_16px_rgba(0,0,0,0.12)]">
                            <img src="{{ asset('images/3d/microscope.png') }}" alt="3D Microscope" class="w-full h-full object-contain">
                        </div>

                        <!-- 3D Stethoscope with Heart (Subtle Depth in Background) -->
                        <div class="absolute top-12 left-3 w-14 h-14 sm:w-16 sm:h-16 z-0 pointer-events-none opacity-20 -rotate-12 transition-transform duration-500 ease-out group-hover:rotate-0 group-hover:scale-105">
                            <img src="{{ asset('images/3d/stethoscope.png') }}" alt="3D Stethoscope" class="w-full h-full object-contain">
                        </div>

                        <!-- Top pastel block (rounded top, overflow visible for pop-out) -->
                        <div class="relative w-full h-[180px] bg-teal-50/90 rounded-t-[22px] flex items-end justify-center overflow-visible">
                            <!-- Rating pill at top left -->
                            <div class="absolute top-3 left-3 z-30 inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-xs px-2.5 py-1 rounded-full shadow-xs border border-slate-100">
                                <svg class="w-3.5 h-3.5 text-amber-400 fill-amber-400" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-xs font-bold text-slate-900 leading-none">{{ $doc['rating'] }}</span>
                            </div>

                            <!-- Doctor Cut-out Photo with Out-of-Bounds Pop-out Effect -->
                            <div class="relative w-full h-full flex items-end justify-center overflow-visible">
                                <img src="{{ asset($doc['image']) }}" 
                                     alt="{{ $doc['name'] }}" 
                                     class="relative z-20 h-[126%] w-auto max-w-none object-contain object-bottom -top-6 sm:-top-7 pointer-events-none transition-transform duration-300 ease-out group-hover:scale-108 group-hover:-translate-y-2 drop-shadow-[0_14px_18px_rgba(15,118,110,0.20)]">
                            </div>
                        </div>

                        <!-- Bottom content area (white background, rounded bottom) -->
                        <div class="relative z-20 p-4 sm:p-5 flex flex-col flex-1 justify-between bg-white rounded-b-[22px] text-left">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 truncate leading-snug">{{ $doc['name'] }}</h3>
                                <p class="text-sm font-normal text-slate-500 truncate mt-0.5">{{ $doc['specialty'] }}</p>
                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-teal-800 bg-teal-50 px-2.5 py-0.5 rounded-full mt-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-600 animate-pulse"></span>
                                    5 Slots Available
                                </span>
                            </div>
                            <div class="mt-3.5 flex items-baseline gap-1">
                                <span class="text-base font-bold text-teal-700">{{ $doc['price'] }}</span>
                                <span class="text-xs font-normal text-slate-400">/per session</span>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>

            <div id="doctors-empty" class="hidden text-center py-12 text-[var(--color-text-muted)]">
                Tidak ada dokter yang cocok dengan kriteria pencarian.
            </div>
        </main>

        <!-- RIGHT PANEL (Doctor Details & Booking) -->
        <aside class="panel bg-[var(--color-surface)] border-l border-[var(--color-border)] p-6 sticky top-0 h-screen overflow-y-auto flex flex-col z-20">
            <!-- Doctor Header -->
            <div class="flex items-center gap-3.5">
                <div class="w-[84px] h-[84px] rounded-[18px] bg-teal-50 overflow-hidden flex items-end justify-center flex-shrink-0 shadow-sm border border-[var(--color-border)]">
                    <img id="pav-img" src="{{ asset($doctors[2]['image']) }}" alt="{{ $doctors[2]['name'] }}" class="h-full w-auto object-contain object-bottom">
                </div>
                <div class="min-w-0">
                    <h3 id="pn" class="text-[19px] font-bold text-[var(--color-text)] leading-tight truncate">{{ $doctors[2]['name'] }}</h3>
                    <small id="ps" class="text-[var(--color-text-secondary)] text-[12.5px] block mt-0.5">{{ $doctors[2]['specialty'] }}</small>
                    <div class="text-[12px] text-[var(--color-text-secondary)] mt-1 flex items-center gap-1 font-semibold">
                        <span class="text-[var(--color-rating)]">★</span> <span id="pr">{{ $doctors[2]['rating'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Pricing & Stats Card -->
            <div class="pricing-card mt-5 border border-[var(--color-border)] rounded-[20px] p-3.5 bg-gradient-to-b from-[var(--color-primary-tint)] to-[var(--color-surface)]">
                <small class="text-[var(--color-text-secondary)] text-[11.5px]">Starting from</small>
                <b id="pp" class="block text-[23px] font-bold text-[var(--color-text)] my-0.5">
                    {{ $doctors[2]['price'] }} <span class="text-[11px] font-normal text-[var(--color-text-muted)]">/per session</span>
                </b>

                <!-- 3 Stat Tiles -->
                <div class="grid grid-cols-3 gap-2 mt-3">
                    <div class="stat-tile bg-[var(--color-surface)] rounded-[14px] p-2 text-center shadow-sm">
                        <i class="w-6 h-6 rounded-full bg-[var(--color-primary-tint)] text-[var(--color-primary)] grid place-items-center mx-auto mb-1">
                            <svg class="app-svg-icon w-3 h-3"><use href="#icon-clock"/></svg>
                        </i>
                        <small class="text-[9.5px] text-[var(--color-text-muted)] block">Availability</small>
                        <b id="pav-avail" class="text-[11px] font-bold block mt-0.5">{{ $doctors[2]['availability'] }}</b>
                    </div>
                    <div class="stat-tile bg-[var(--color-surface)] rounded-[14px] p-2 text-center shadow-sm">
                        <i class="w-6 h-6 rounded-full bg-[var(--color-primary-tint)] text-[var(--color-primary)] grid place-items-center mx-auto mb-1">
                            <svg class="app-svg-icon w-3 h-3"><use href="#icon-cal"/></svg>
                        </i>
                        <small class="text-[9.5px] text-[var(--color-text-muted)] block">Experience</small>
                        <b id="pav-exp" class="text-[11px] font-bold block mt-0.5">{{ $doctors[2]['experience'] }}</b>
                    </div>
                    <div class="stat-tile bg-[var(--color-surface)] rounded-[14px] p-2 text-center shadow-sm">
                        <i class="w-6 h-6 rounded-full bg-[var(--color-primary-tint)] text-[var(--color-primary)] grid place-items-center mx-auto mb-1">
                            <svg class="app-svg-icon w-3 h-3"><use href="#icon-user"/></svg>
                        </i>
                        <small class="text-[9.5px] text-[var(--color-text-muted)] block">Patients</small>
                        <b id="pav-patients" class="text-[11px] font-bold block mt-0.5">{{ $doctors[2]['patients'] }}</b>
                    </div>
                </div>
            </div>

            <!-- Date Picker -->
            <div class="font-semibold text-[15px] mt-5 mb-2.5 text-[var(--color-text)]">Select a date &amp; time</div>
            <div class="days-container grid grid-cols-7 gap-1.5">
                @php
                    $days = [
                        ['name' => 'Su', 'date' => '10'],
                        ['name' => 'Mo', 'date' => '11'],
                        ['name' => 'Tu', 'date' => '12'],
                        ['name' => 'We', 'date' => '13'],
                        ['name' => 'Th', 'date' => '14'],
                        ['name' => 'Fr', 'date' => '15'],
                        ['name' => 'Sa', 'date' => '16'],
                    ];
                @endphp
                @foreach ($days as $day)
                    <button class="day-pill {{ $day['date'] === '12' ? 'active' : '' }}" data-day="{{ $day['name'] }}" data-date="{{ $day['date'] }}">
                        <small>{{ $day['name'] }}</small>
                        <b>{{ $day['date'] }}</b>
                    </button>
                @endforeach
            </div>

            <!-- Time Slots -->
            <div class="slots-container grid grid-cols-3 gap-2 mt-3">
                @php
                    $slots = ['09 AM', '10 AM', '11 AM', '12 PM', '01 PM', '02 PM'];
                @endphp
                @foreach ($slots as $slot)
                    <button class="slot-pill {{ $slot === '01 PM' ? 'active' : '' }}" data-time="{{ $slot }}">
                        {{ $slot }}
                    </button>
                @endforeach
            </div>

            <!-- Sticky CTA Button -->
            <div class="mt-auto pt-6 sticky bottom-0 bg-gradient-to-t from-[var(--color-surface)] via-[var(--color-surface)] to-transparent">
                <button class="btn-book-session w-full h-12 rounded-[16px] bg-[var(--color-primary)] hover:brightness-105 text-white font-semibold text-[14.5px] transition-all shadow-md">
                    Book a Session
                </button>
            </div>
        </aside>
    </div>


    <!-- ========================================== -->
    <!-- 2. MOBILE LAYOUT (Screen width < 1024px)   -->
    <!-- ========================================== -->
    <div class="mobile-layout block lg:hidden min-h-screen relative pb-28">

        <!-- Teal Gradient Header -->
        <header class="bg-[var(--gradient-mobile)] pt-12 px-5 pb-8 text-white">
            <div class="flex justify-between items-center">
                <!-- User Avatar -->
                <div class="avatar-initials w-10 h-10 border-2 border-white text-[14px]">
                    {{ $user['initials'] }}
                </div>

                <!-- Gabe Medica Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-1.5 bg-white/20 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/30 no-underline shadow-sm" title="Gabe Medica">
                    <img src="{{ asset('images/gabe-medica-logo-white.png') }}" alt="Gabe Medica" class="h-5 w-auto object-contain" />
                </a>

                <!-- Right Glass Buttons -->
                <div class="flex items-center gap-2">
                    <button id="mobile-search-trigger" class="glass-btn" aria-label="Cari Dokter">
                        <svg class="app-svg-icon w-4 h-4"><use href="#icon-search"/></svg>
                    </button>
                    <button class="glass-btn" aria-label="Notifikasi" onclick="window.showToast('Tidak ada notifikasi baru.')">
                        <svg class="app-svg-icon w-4 h-4"><use href="#icon-bell"/></svg>
                    </button>
                </div>
            </div>

            <!-- Expandable Search Bar on Mobile -->
            <div id="mobile-search-bar" class="hidden mt-4">
                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-md rounded-full px-4 h-10 border border-white/30 text-white">
                    <svg class="app-svg-icon w-4 h-4 text-white"><use href="#icon-search"/></svg>
                    <input id="mobile-search-input" type="search" placeholder="Cari dokter atau spesialis..." class="flex-1 bg-transparent border-none text-white placeholder-white/70 text-[13px] outline-none">
                </div>
            </div>

            <!-- Personal Greeting -->
            <div class="text-center mt-5">
                <span class="text-white/90 text-[13px]">Good afternoon,</span>
                <b class="block text-[20px] font-bold text-white mt-0.5">What’s on your health today?</b>
            </div>

            <!-- Next Appointment Label -->
            <div class="text-center text-white/80 text-[11px] font-medium tracking-wider mt-4 mb-2 uppercase">
                Next Appointment
            </div>

            <!-- Stacked Appointment Card -->
            <div class="stacked-card mx-1 bg-[var(--color-surface)] text-[var(--color-text)] rounded-[22px] p-3.5 shadow-[var(--shadow-card)]">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-[12px] bg-[var(--color-primary-soft)] overflow-hidden flex items-end justify-center flex-shrink-0 border border-[var(--color-border)]">
                        <img src="{{ asset($nextAppointment['image']) }}" alt="{{ $nextAppointment['doctor_name'] }}" class="h-full w-auto object-contain object-bottom">
                    </div>
                    <div class="min-w-0 flex-1">
                        <b class="text-[13.5px] text-[var(--color-text)] truncate block">{{ $nextAppointment['doctor_name'] }}</b>
                        <small class="text-[var(--color-text-secondary)] text-[11px] block mt-0.5">{{ $nextAppointment['specialty'] }}</small>
                        <small class="text-[var(--color-primary-dark)] text-[10.5px] font-medium block mt-0.5">{{ $nextAppointment['date_time'] }}</small>
                    </div>
                    <span class="w-8 h-8 rounded-full border border-[var(--color-border)] flex items-center justify-center text-[var(--color-text)] flex-shrink-0">
                        <svg class="app-svg-icon w-3.5 h-3.5"><use href="#icon-up"/></svg>
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <button class="btn-reschedule h-8 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] text-[var(--color-text)] font-medium text-[11.5px]">Reschedule</button>
                    <button class="btn-join-call h-8 rounded-xl bg-[var(--color-primary)] text-white font-medium text-[11.5px] flex items-center justify-center gap-1">
                        <svg class="app-svg-icon w-3 h-3"><use href="#icon-vid"/></svg>
                        Join Call
                    </button>
                </div>
            </div>
        </header>

        <!-- White Curved Sheet -->
        <section class="sheet bg-[var(--color-surface)] rounded-t-[28px] -mt-4 px-4 pt-5 pb-6 min-h-[500px]">
            <!-- Specialty Chips (Horizontal Scrollable) -->
            <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1">
                @foreach ($categories as $cat)
                    <button class="specialty-chip mobile-chip flex-none text-[12px] h-[32px] px-3.5 {{ $cat['id'] === 'all' ? 'active' : '' }}" data-cat="{{ $cat['id'] }}">
                        {{ $cat['name'] }}
                    </button>
                @endforeach
            </div>

            <!-- Section Header -->
            <div class="flex justify-between items-center mt-4 mb-3 px-1">
                <b class="text-[15px] text-[var(--color-text)]">Find a Doctor</b>
                <a href="javascript:void(0)" onclick="window.showToast('Menampilkan seluruh dokter')" class="text-[12px] text-[var(--color-primary)] font-medium">View All</a>
            </div>

            <!-- Horizontal Doctor Cards (Scrollable) -->
            <div class="flex gap-4 overflow-x-auto overflow-y-visible no-scrollbar pt-6 pb-3 px-1">
                @foreach ($doctors as $index => $doc)
                    <div class="doctor-card flex-none w-[155px] cursor-pointer group {{ $index === 2 ? 'selected' : '' }}"
                         data-id="{{ $doc['id'] }}"
                         data-name="{{ $doc['name'] }}"
                         data-specialty="{{ $doc['specialty'] }}"
                         data-category="{{ $doc['category'] }}"
                         data-rating="{{ $doc['rating'] }}"
                         data-price="{{ $doc['price'] }}"
                         data-initials="{{ $doc['initials'] }}"
                         data-image="{{ asset($doc['image']) }}"
                         data-availability="{{ $doc['availability'] }}"
                         data-experience="{{ $doc['experience'] }}"
                         data-patients="{{ $doc['patients'] }}">
                        
                        <!-- 3D Microscope Icon (Out-of-bounds top right) -->
                        <div class="absolute -top-5 -right-1.5 w-12 h-12 z-30 pointer-events-none drop-shadow-sm">
                            <img src="{{ asset('images/3d/microscope.png') }}" alt="3D Microscope" class="w-full h-full object-contain">
                        </div>

                        <!-- Top pastel block (rounded top, overflow visible) -->
                        <div class="relative w-full h-[135px] bg-teal-50/90 rounded-t-[22px] flex items-end justify-center overflow-visible">
                            <div class="absolute top-2 left-2 z-30 inline-flex items-center gap-1 bg-white/95 px-2 py-0.5 rounded-full shadow-xs border border-slate-100">
                                <svg class="w-3 h-3 text-amber-400 fill-amber-400" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-[10px] font-bold text-slate-900 leading-none">{{ $doc['rating'] }}</span>
                            </div>
                            <div class="relative w-full h-full flex items-end justify-center overflow-visible">
                                <img src="{{ asset($doc['image']) }}" alt="{{ $doc['name'] }}" class="relative z-20 h-[122%] w-auto max-w-none object-contain object-bottom -top-4 pointer-events-none drop-shadow-[0_8px_12px_rgba(15,118,110,0.18)]">
                            </div>
                        </div>

                        <!-- Bottom content area -->
                        <div class="relative z-20 p-3 bg-white rounded-b-[22px] text-left">
                            <b class="text-sm font-bold text-slate-900 block truncate">{{ $doc['name'] }}</b>
                            <small class="text-slate-500 font-normal text-xs block truncate mt-0.5">{{ $doc['specialty'] }}</small>
                            <div class="mt-2 flex items-baseline gap-1">
                                <span class="text-xs font-bold text-teal-700">{{ $doc['price'] }}</span>
                                <span class="text-[10px] font-normal text-slate-400">/per session</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Floating Bottom Navigation -->
        <nav class="floating-bottom-nav" aria-label="Navigasi Bawah">
            <button aria-label="Jadwal" onclick="window.showToast('Tab Jadwal...')">
                <svg class="app-svg-icon w-5 h-5"><use href="#icon-cal"/></svg>
            </button>
            <button class="active" aria-label="Beranda">
                <svg class="app-svg-icon w-5 h-5"><use href="#icon-home"/></svg>
            </button>
            <button aria-label="Pengaturan" onclick="window.showToast('Tab Pengaturan...')">
                <svg class="app-svg-icon w-5 h-5"><use href="#icon-set"/></svg>
            </button>
        </nav>

        <!-- Mobile Doctor Detail & Booking Bottom Sheet Modal -->
        <div id="mobile-sheet-backdrop" class="mobile-sheet-backdrop"></div>
        <div id="mobile-detail-sheet" class="mobile-sheet">
            <!-- Drag Handle & Close -->
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-1 bg-[var(--color-border)] rounded-full mx-auto"></div>
                <button id="mobile-sheet-close" class="p-1 text-[var(--color-text-muted)] hover:text-[var(--color-text)]" aria-label="Tutup Detail">
                    <svg class="app-svg-icon w-5 h-5"><use href="#icon-close"/></svg>
                </button>
            </div>

            <!-- Doctor Profile -->
            <div class="flex items-center gap-3">
                <div class="w-16 h-16 rounded-[14px] bg-teal-50 overflow-hidden flex items-end justify-center flex-shrink-0 shadow-sm border border-[var(--color-border)]">
                    <img id="m-pav-img" src="{{ asset($doctors[2]['image']) }}" alt="{{ $doctors[2]['name'] }}" class="h-full w-auto object-contain object-bottom">
                </div>
                <div class="min-w-0">
                    <span class="rating-pill text-[11px] mb-1 inline-flex">★ <span id="m-pr">{{ $doctors[2]['rating'] }}</span></span>
                    <h3 id="m-pn" class="text-[17px] font-bold text-[var(--color-text)] leading-tight truncate">{{ $doctors[2]['name'] }}</h3>
                    <small id="m-ps" class="text-[var(--color-text-secondary)] text-[12px] block">{{ $doctors[2]['specialty'] }}</small>
                </div>
            </div>

            <!-- Price & Stat Tiles -->
            <div class="pricing-card mt-4 border border-[var(--color-border)] rounded-[20px] p-3 bg-gradient-to-b from-[var(--color-primary-tint)] to-[var(--color-surface)]">
                <small class="text-[var(--color-text-secondary)] text-[11px]">Starting from</small>
                <b id="m-pp" class="block text-[21px] font-bold text-[var(--color-text)] my-0.5">
                    {{ $doctors[2]['price'] }} <span class="text-[10px] font-normal text-[var(--color-text-muted)]">/per session</span>
                </b>

                <div class="grid grid-cols-3 gap-1.5 mt-2.5">
                    <div class="stat-tile bg-[var(--color-surface)] rounded-[12px] p-2 text-center shadow-sm">
                        <i class="w-5 h-5 rounded-full bg-[var(--color-primary-tint)] text-[var(--color-primary)] grid place-items-center mx-auto mb-1">
                            <svg class="app-svg-icon w-2.5 h-2.5"><use href="#icon-clock"/></svg>
                        </i>
                        <small class="text-[8.5px] text-[var(--color-text-muted)] block">Availability</small>
                        <b id="m-pav-avail" class="text-[10px] font-bold block mt-0.5">{{ $doctors[2]['availability'] }}</b>
                    </div>
                    <div class="stat-tile bg-[var(--color-surface)] rounded-[12px] p-2 text-center shadow-sm">
                        <i class="w-5 h-5 rounded-full bg-[var(--color-primary-tint)] text-[var(--color-primary)] grid place-items-center mx-auto mb-1">
                            <svg class="app-svg-icon w-2.5 h-2.5"><use href="#icon-cal"/></svg>
                        </i>
                        <small class="text-[8.5px] text-[var(--color-text-muted)] block">Experience</small>
                        <b id="m-pav-exp" class="text-[10px] font-bold block mt-0.5">{{ $doctors[2]['experience'] }}</b>
                    </div>
                    <div class="stat-tile bg-[var(--color-surface)] rounded-[12px] p-2 text-center shadow-sm">
                        <i class="w-5 h-5 rounded-full bg-[var(--color-primary-tint)] text-[var(--color-primary)] grid place-items-center mx-auto mb-1">
                            <svg class="app-svg-icon w-2.5 h-2.5"><use href="#icon-user"/></svg>
                        </i>
                        <small class="text-[8.5px] text-[var(--color-text-muted)] block">Patients</small>
                        <b id="m-pav-patients" class="text-[10px] font-bold block mt-0.5">{{ $doctors[2]['patients'] }}</b>
                    </div>
                </div>
            </div>

            <!-- Date Selection -->
            <div class="font-semibold text-[13.5px] mt-4 mb-2 text-[var(--color-text)]">Select a date &amp; time</div>
            <div class="days-container grid grid-cols-7 gap-1">
                @foreach ($days as $day)
                    <button class="day-pill text-[10px] py-1 {{ $day['date'] === '12' ? 'active' : '' }}" data-day="{{ $day['name'] }}" data-date="{{ $day['date'] }}">
                        <small class="text-[8.5px]">{{ $day['name'] }}</small>
                        <b class="text-[13px]">{{ $day['date'] }}</b>
                    </button>
                @endforeach
            </div>

            <!-- Time Slots Selection -->
            <div class="slots-container grid grid-cols-3 gap-1.5 mt-2.5">
                @foreach ($slots as $slot)
                    <button class="slot-pill h-8 text-[11px] {{ $slot === '01 PM' ? 'active' : '' }}" data-time="{{ $slot }}">
                        {{ $slot }}
                    </button>
                @endforeach
            </div>

            <!-- CTA Button -->
            <button class="btn-book-session w-full h-11 rounded-[14px] bg-[var(--color-primary)] text-white font-semibold text-[14px] mt-5 shadow-md">
                Book a Session
            </button>
        </div>
    </div>
</div>
@endsection
