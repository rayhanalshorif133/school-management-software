<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'School Management') }} - Smart Campus ERP Platform</title>

  <!-- Early Dark Mode Detection Script -->
  <script>
    if (localStorage.getItem('app_theme') === 'dark' || (!('app_theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>

  <!-- Tailwind CSS & Vite Assets -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Google Fonts: Inter & Hind Siliguri -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', 'Hind Siliguri', sans-serif;
    }
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 9999px;
    }
    .dark ::-webkit-scrollbar-track {
      background: #090d16;
    }
    .dark ::-webkit-scrollbar-thumb {
      background: #1e293b;
    }
  </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased selection:bg-indigo-600 selection:text-white transition-colors duration-200 min-h-screen flex flex-col">

  <!-- Background Ambient Glows -->
  <div class="fixed top-0 left-1/4 w-96 h-96 bg-indigo-500/10 dark:bg-indigo-600/15 rounded-full blur-3xl pointer-events-none -z-10"></div>
  <div class="fixed top-1/3 right-10 w-96 h-96 bg-amber-500/10 dark:bg-amber-600/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
  <div class="fixed bottom-10 left-10 w-96 h-96 bg-sky-500/10 dark:bg-sky-600/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

  <!-- ======================== 1. TOP NAVBAR ======================== -->
  <header class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800/80 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-18">
        
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
          <div class="w-11 h-11 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-600/25 group-hover:scale-105 transition-transform text-xl">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <div>
            <div class="flex items-center gap-2">
              <span class="font-black text-slate-900 dark:text-white text-base tracking-tight leading-tight uppercase">
                {{ config('app.name', 'School Management') }}
              </span>
              <span class="text-[9px] bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-extrabold px-1.5 py-0.5 rounded border border-indigo-200 dark:border-indigo-800">
                PRO
              </span>
            </div>
            <p data-i18n="nav_sub" class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">স্মার্ট ডিজিটাল ক্যাম্পাস ইআরপি</p>
          </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden lg:flex items-center gap-7 text-xs font-bold text-slate-600 dark:text-slate-300">
          <a href="#features" data-i18n="nav_features" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">ফিচারসমূহ</a>
          <a href="#modules" data-i18n="nav_modules" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">মডিউলস</a>
          <a href="#stats" data-i18n="nav_stats" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">পরিসংখ্যান</a>
          <a href="#portals" data-i18n="nav_portals" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">পোর্টালসমূহ</a>
          <a href="#pricing" data-i18n="nav_pricing" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">প্যাকেজ</a>
          <a href="#faq" data-i18n="nav_faq" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">প্রশ্নোত্তর</a>
        </nav>

        <!-- Right Side Controls & Auth Buttons -->
        <div class="flex items-center gap-2.5 sm:gap-3">
          
          <!-- Language Toggle Button (English <-> Bangla) -->
          <button 
            id="langToggleBtn" 
            onclick="toggleLanguage()" 
            class="px-2.5 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-100/70 dark:bg-slate-800 hover:bg-slate-200/70 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs"
            title="Language: English / বাংলা"
          >
            <i class="fas fa-globe text-indigo-500"></i>
            <span id="langBtnText">English</span>
          </button>

          <!-- Dark / Light Mode Toggle Button -->
          <button 
            id="themeToggleBtn" 
            onclick="toggleTheme()" 
            class="w-8.5 h-8.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-100/70 dark:bg-slate-800 hover:bg-slate-200/70 dark:hover:bg-slate-700 text-slate-700 dark:text-amber-400 text-xs font-bold transition flex items-center justify-center cursor-pointer shadow-xs"
            title="Toggle Theme"
          >
            <i id="themeIcon" class="fas fa-moon text-indigo-600 dark:text-amber-400 text-sm"></i>
          </button>

          <!-- Auth Links -->
          @if (Route::has('login'))
            <div class="flex items-center gap-2 pl-2 border-l border-slate-200 dark:border-slate-800">
              @auth
                <a 
                  href="{{ url('/dashboard') }}" 
                  class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-600/25 transition flex items-center gap-2 cursor-pointer"
                >
                  <i class="fas fa-table-columns"></i>
                  <span data-i18n="nav_dashboard">ড্যাশবোর্ড</span>
                </a>
              @else
                <a 
                  href="{{ route('login') }}" 
                  class="px-3 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition flex items-center gap-1.5"
                >
                  <i class="fas fa-right-to-bracket text-slate-400"></i>
                  <span data-i18n="nav_login">লগইন</span>
                </a>

                @if (Route::has('register'))
                  <a 
                    href="{{ route('register') }}" 
                    class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-600/25 transition cursor-pointer"
                  >
                    <span data-i18n="nav_get_started">নিবন্ধন করুন</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                  </a>
                @endif
              @endauth
            </div>
          @endif

        </div>
      </div>
    </div>
  </header>

  <!-- ======================== 2. HERO SECTION ======================== -->
  <section class="relative pt-12 pb-20 lg:pt-20 lg:pb-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto">
        
        <!-- Hero Pill Announcement -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-50 dark:bg-indigo-950/70 border border-indigo-200 dark:border-indigo-800/80 text-indigo-700 dark:text-indigo-300 text-xs font-bold mb-6 shadow-xs">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
          <span data-i18n="hero_pill">✨ পরবর্তী প্রজন্মের ক্লাউড স্কুল ম্যানেজমেন্ট সফটওয়্যার • Smart School ERP</span>
        </div>

        <!-- Main Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tight leading-[1.15]">
          <span data-i18n="hero_title_1">স্মার্ট স্কুলের সম্পূর্ণ ব্যবস্থাপনা</span><br>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-indigo-500 to-amber-500" data-i18n="hero_title_2">
            এখন একটি মাত্র প্ল্যাটফর্মে
          </span>
        </h1>

        <!-- Subtitle Description -->
        <p data-i18n="hero_desc" class="mt-6 text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed font-normal">
          ভর্তি, ডিজিটাল হাজিরা, অনলাইন ফি কালেকশন, পরীক্ষার রেজাল্ট, স্বয়ংক্রিয় এসএমএস এবং শিক্ষক-অভিভাবক পোর্টাল—আপনার বিদ্যালয়ের দৈনন্দিন সব কাজ পরিচালনা করুন নির্ভুল ও স্বাচ্ছন্দ্যে।
        </p>

        <!-- CTA Action Buttons -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3.5">
          <a 
            href="{{ route('register') }}" 
            class="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm font-bold shadow-xl shadow-indigo-600/30 transition flex items-center justify-center gap-2 cursor-pointer group"
          >
            <span data-i18n="hero_cta_start">বিনামূল্যে ট্রায়াল শুরু করুন</span>
            <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
          </a>

          <a 
            href="{{ route('login') }}" 
            class="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-100 text-xs sm:text-sm font-bold border border-slate-200 dark:border-slate-800 shadow-md transition flex items-center justify-center gap-2 cursor-pointer"
          >
            <i class="fas fa-play text-indigo-600 text-xs"></i>
            <span data-i18n="hero_cta_demo">লাইভ ডেমো দেখুন (Demo Login)</span>
          </a>
        </div>

        <!-- Social Proof Stats Mini -->
        <div class="mt-10 flex flex-wrap items-center justify-center gap-6 sm:gap-8 text-xs text-slate-500 dark:text-slate-400 font-medium">
          <span class="flex items-center gap-2">
            <i class="fas fa-check-circle text-emerald-500"></i>
            <span data-i18n="proof_1">১,২০০+ শিক্ষা প্রতিষ্ঠান</span>
          </span>
          <span class="flex items-center gap-2">
            <i class="fas fa-bolt text-amber-500"></i>
            <span data-i18n="proof_2">তাত্ক্ষণিক সেটআপ</span>
          </span>
          <span class="flex items-center gap-2">
            <i class="fas fa-shield-halved text-indigo-500"></i>
            <span data-i18n="proof_3">১০০% নিরাপদ ক্লাউড ডেটা</span>
          </span>
          <span class="flex items-center gap-2">
            <i class="fas fa-headset text-sky-500"></i>
            <span data-i18n="proof_4">২৪/৭ কাস্টমার সাপোর্ট</span>
          </span>
        </div>

      </div>

      <!-- ======================== HERO DASHBOARD PREVIEW MOCKUP ======================== -->
      <div class="mt-14 relative max-w-5xl mx-auto">
        
        <!-- Floating Badges -->
        <div class="hidden sm:flex absolute -top-5 -left-5 z-20 items-center gap-3 p-3.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl">
          <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg">
            <i class="fas fa-user-graduate"></i>
          </div>
          <div>
            <span data-i18n="hero_badge_att_title" class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 block">আজকের উপস্থিতি</span>
            <span data-i18n="hero_badge_att_val" class="text-sm font-black text-slate-900 dark:text-white">৯৬.৫% (১,৩৯৯ জন)</span>
          </div>
        </div>

        <div class="hidden sm:flex absolute -bottom-5 -right-5 z-20 items-center gap-3 p-3.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl">
          <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-lg">
            <i class="fas fa-wallet"></i>
          </div>
          <div>
            <span data-i18n="hero_badge_fee_title" class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 block">চলতি মাসের ফি আদায়</span>
            <span data-i18n="hero_badge_fee_val" class="text-sm font-black text-slate-900 dark:text-white">৳ ৫,৮২,০০০ (৮৫%)</span>
          </div>
        </div>

        <!-- Card Mockup Frame -->
        <div class="rounded-3xl border border-slate-200/90 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-2xl overflow-hidden p-2 sm:p-4">
          
          <!-- Mockup Header Bar -->
          <div class="flex items-center justify-between px-3 py-2 border-b border-slate-100 dark:border-slate-800 mb-3 text-xs">
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full bg-rose-500"></span>
              <span class="w-3 h-3 rounded-full bg-amber-500"></span>
              <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
              <span class="ml-2 font-mono text-[11px] text-slate-400 dark:text-slate-500 font-bold">https://school.edumanage.bd/dashboard</span>
            </div>
            <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950 px-2 py-0.5 rounded-full">
              Live Campus View
            </span>
          </div>

          <!-- Inside Mockup Mini-Dashboard -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 text-left">
            
            <!-- Mini Sidebar -->
            <div class="hidden lg:block lg:col-span-3 bg-slate-50 dark:bg-slate-950/60 p-3 rounded-2xl border border-slate-100 dark:border-slate-800/80 space-y-1.5 text-xs font-semibold">
              <div class="p-2 rounded-xl bg-indigo-600 text-white font-bold flex items-center gap-2">
                <i class="fas fa-chart-pie"></i> ড্যাশবোর্ড ওভারভিউ
              </div>
              <div class="p-2 rounded-xl text-slate-600 dark:text-slate-400 flex items-center gap-2">
                <i class="fas fa-user-graduate text-indigo-500"></i> শিক্ষার্থী ও অভিভাবক
              </div>
              <div class="p-2 rounded-xl text-slate-600 dark:text-slate-400 flex items-center gap-2">
                <i class="fas fa-chalkboard-user text-emerald-500"></i> শিক্ষক ও কর্মকর্তা
              </div>
              <div class="p-2 rounded-xl text-slate-600 dark:text-slate-400 flex items-center gap-2">
                <i class="fas fa-calendar-check text-sky-500"></i> ক্লাস ও উপস্থিতি
              </div>
              <div class="p-2 rounded-xl text-slate-600 dark:text-slate-400 flex items-center gap-2">
                <i class="fas fa-coins text-amber-500"></i> ফি ও একাউন্টস
              </div>
            </div>

            <!-- Mini Content Area -->
            <div class="lg:col-span-9 space-y-3">
              <!-- Mini Metrics Row -->
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-100 dark:border-slate-800">
                  <span class="text-[10px] text-slate-400 font-bold block">মোট শিক্ষার্থী</span>
                  <span class="text-sm font-black text-slate-900 dark:text-white">১,৪৫০ জন</span>
                </div>
                <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-100 dark:border-slate-800">
                  <span class="text-[10px] text-slate-400 font-bold block">শিক্ষক ও স্টাফ</span>
                  <span class="text-sm font-black text-slate-900 dark:text-white">৪৮ জন</span>
                </div>
                <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-100 dark:border-slate-800">
                  <span class="text-[10px] text-slate-400 font-bold block">আজকের উপস্থিতি</span>
                  <span class="text-sm font-black text-emerald-600">৯৬.৫%</span>
                </div>
                <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-100 dark:border-slate-800">
                  <span class="text-[10px] text-slate-400 font-bold block">ফি আদায়</span>
                  <span class="text-sm font-black text-amber-600">৳ ৫,৮২,০০০</span>
                </div>
              </div>

              <!-- Mini Table Preview -->
              <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-100 dark:border-slate-800">
                <div class="flex items-center justify-between text-xs font-bold mb-2 text-slate-700 dark:text-slate-300">
                  <span>সাম্প্রতিক ভর্তি ও শিক্ষার্থী রেকর্ড</span>
                  <span class="text-indigo-600 text-[10px]">অটো সিঙ্কড</span>
                </div>
                <div class="space-y-1.5 text-[11px]">
                  <div class="p-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <span class="font-bold text-indigo-600">#1001 তানভীর হাসান (দশম শ্রেণি)</span>
                    <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-emerald-800">পেইড</span>
                  </div>
                  <div class="p-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <span class="font-bold text-slate-800 dark:text-slate-200">#1002 সাদিয়া রহমান (নবম শ্রেণি)</span>
                    <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-amber-100 text-amber-800">বকেয়া</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- ======================== 3. STATS HIGHLIGHTS ======================== -->
  <section id="stats" class="py-16 bg-indigo-600 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
          <h3 class="text-3xl sm:text-5xl font-black tracking-tight" data-i18n="stat_1_val">১,২০০+</h3>
          <p class="mt-2 text-xs sm:text-sm font-semibold text-indigo-100" data-i18n="stat_1_lbl">সক্রিয় স্কুল ও কলেজ</p>
        </div>
        <div>
          <h3 class="text-3xl sm:text-5xl font-black tracking-tight" data-i18n="stat_2_val">৪,৫০,০০০+</h3>
          <p class="mt-2 text-xs sm:text-sm font-semibold text-indigo-100" data-i18n="stat_2_lbl">শিক্ষার্থী ও অভিভাবক</p>
        </div>
        <div>
          <h3 class="text-3xl sm:text-5xl font-black tracking-tight" data-i18n="stat_3_val">৯৯.৮%</h3>
          <p class="mt-2 text-xs sm:text-sm font-semibold text-indigo-100" data-i18n="stat_3_lbl">গ্রাহক সন্তুষ্টির হার</p>
        </div>
        <div>
          <h3 class="text-3xl sm:text-5xl font-black tracking-tight" data-i18n="stat_4_val">১৫+ মিলিয়ন</h3>
          <p class="mt-2 text-xs sm:text-sm font-semibold text-indigo-100" data-i18n="stat_4_lbl">রিপোর্ট কার্ড ও এসএমএস</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ======================== 4. CORE MODULES & FEATURES ======================== -->
  <section id="modules" class="py-20 lg:py-28 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span data-i18n="mod_tag" class="text-xs font-extrabold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/70 px-3 py-1 rounded-full border border-indigo-200 dark:border-indigo-800">
          সর্বাধুনিক মডিউলসমূহ
        </span>
        <h2 data-i18n="mod_heading" class="mt-4 text-2xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">
          স্কুল পরিচালনার জন্য প্রয়োজনীয় সকল ফিচার এক ছাদের নিচে
        </h2>
        <p data-i18n="mod_sub" class="mt-3 text-sm text-slate-600 dark:text-slate-400">
          অফিসের কাগজপত্রের ঝামেলা চিরতরে দূর করে স্কুলকে রূপান্তর করুন দ্রুত ও স্বয়ংক্রিয় ডিজিটাল প্রতিষ্ঠানে।
        </p>
      </div>

      <!-- Feature Grid (6 Cards) -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        
        <!-- Card 1 -->
        <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs hover:shadow-xl hover:border-indigo-300 dark:hover:border-indigo-700 transition duration-300 group">
          <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition-transform">
            <i class="fas fa-user-graduate"></i>
          </div>
          <h3 data-i18n="feat_1_title" class="text-base font-bold text-slate-900 dark:text-white mb-2">অনলাইন ভর্তি ও শিক্ষার্থী তথ্য</h3>
          <p data-i18n="feat_1_desc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
            অনলাইনে আবেদন গ্রহণ, স্বয়ংক্রিয় রোল নির্ধারণ, বারকোডসহ ডিজিটাল আইডি কার্ড তৈরি এবং শিক্ষার্থীর পূর্ণাঙ্গ বায়োডাটা সংরক্ষণ।
          </p>
        </div>

        <!-- Card 2 -->
        <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs hover:shadow-xl hover:border-emerald-300 dark:hover:border-emerald-700 transition duration-300 group">
          <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition-transform">
            <i class="fas fa-calendar-check"></i>
          </div>
          <h3 data-i18n="feat_2_title" class="text-base font-bold text-slate-900 dark:text-white mb-2">স্মার্ট হাজিরা ও ইনস্ট্যান্ট SMS</h3>
          <p data-i18n="feat_2_desc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
            বায়োমেট্রিক, আরএফআইডি বা মোবাইল দিয়ে হাজিরা গ্রহণ। কোনো শিক্ষার্থী অনুপস্থিত থাকলে সাথে সাথে অভিভাবকের ফোনে এসএমএস অ্যালার্ট।
          </p>
        </div>

        <!-- Card 3 -->
        <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs hover:shadow-xl hover:border-amber-300 dark:hover:border-amber-700 transition duration-300 group">
          <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition-transform">
            <i class="fas fa-receipt"></i>
          </div>
          <h3 data-i18n="feat_3_title" class="text-base font-bold text-slate-900 dark:text-white mb-2">ফি কালেকশন ও অনলাইন পেমেন্ট</h3>
          <p data-i18n="feat_3_desc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
            বিকাশ, নগদ ও ব্যাংকের মাধ্যমে টিউশন ফি গ্রহণ, স্বয়ংক্রিয় ডিজিটাল রিসিট ও বকেয়া ফি-র জন্য অভিভাবককে অটো রিমাইন্ডার পাঠানো।
          </p>
        </div>

        <!-- Card 4 -->
        <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs hover:shadow-xl hover:border-rose-300 dark:hover:border-rose-700 transition duration-300 group">
          <div class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition-transform">
            <i class="fas fa-award"></i>
          </div>
          <h3 data-i18n="feat_4_title" class="text-base font-bold text-slate-900 dark:text-white mb-2">পরীক্ষা, গ্রেডিং ও মার্কশিট</h3>
          <p data-i18n="feat_4_desc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
            জাতীয় শিক্ষা কারিকুলাম ও জিপিএ গ্রেডিং সিস্টেমের আলোকে নির্ভুল পরীক্ষার রেজাল্ট, প্রোগ্রেস রিপোর্ট কার্ড এবং মেধা তালিকা প্রস্তুতকরণ।
          </p>
        </div>

        <!-- Card 5 -->
        <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs hover:shadow-xl hover:border-sky-300 dark:hover:border-sky-700 transition duration-300 group">
          <div class="w-12 h-12 rounded-2xl bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition-transform">
            <i class="fas fa-chalkboard-user"></i>
          </div>
          <h3 data-i18n="feat_5_title" class="text-base font-bold text-slate-900 dark:text-white mb-2">শিক্ষক ও স্টাফ পেরোল</h3>
          <p data-i18n="feat_5_desc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
            শিক্ষক ও কর্মচারীদের ডিজিটাল প্রোফাইল, বিষয় বণ্টন, ছুটির হিসাব, স্বয়ংক্রিয় বেতন শীট ও বোনাস হিসাব ব্যবস্থাপনা।
          </p>
        </div>

        <!-- Card 6 -->
        <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs hover:shadow-xl hover:border-purple-300 dark:hover:border-purple-700 transition duration-300 group">
          <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition-transform">
            <i class="fas fa-bullhorn"></i>
          </div>
          <h3 data-i18n="feat_6_title" class="text-base font-bold text-slate-900 dark:text-white mb-2">ডিজিটাল রুটিন ও নোটিশ বোর্ড</h3>
          <p data-i18n="feat_6_desc" class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
            ক্লাস রুটিন, পরীক্ষার সময়সূচি এবং জরুরি অ্যাকাডেমিক নোটিশ সরাসরি মোবাইল অ্যাপ ও ওয়েব পোর্টালে প্রকাশ করার সুবিধা।
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- ======================== 5. PORTALS / ROLES SECTION ======================== -->
  <section id="portals" class="py-20 bg-slate-100/70 dark:bg-slate-900/50 border-y border-slate-200/80 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span data-i18n="portal_tag" class="text-xs font-extrabold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/70 px-3 py-1 rounded-full border border-indigo-200 dark:border-indigo-800">
          সমন্বিত সমাধান
        </span>
        <h2 data-i18n="portal_heading" class="mt-4 text-2xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">
          স্কুলের প্রত্যেকের জন্য আলাদা ও ডেডিকেটেড পোর্টাল
        </h2>
        <p data-i18n="portal_sub" class="mt-3 text-sm text-slate-600 dark:text-slate-400">
          প্রিন্সিপাল, শিক্ষক, অভিভাবক ও হিসাব শাখার জন্য আলাদা ড্যাশবোর্ড ও সিকিউর অ্যাক্সেস।
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Role 1 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-base mb-4">
              <i class="fas fa-shield-halved"></i>
            </div>
            <h4 data-i18n="role_1_title" class="font-bold text-slate-900 dark:text-white text-sm mb-1.5">সুপার অ্যাডমিন ড্যাশবোর্ড</h4>
            <p data-i18n="role_1_desc" class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
              স্কুলের সার্বিক কার্যক্রম, শিক্ষক ও শিক্ষার্থী রেকর্ড, আর্থিক অডিট এবং যেকোনো সময় কেন্দ্রীয় মনিটরিং।
            </p>
          </div>
          <span class="mt-4 text-[11px] font-bold text-indigo-600 dark:text-indigo-400 flex items-center gap-1">
            ফুল কন্ট্রোল প্যানেল <i class="fas fa-chevron-right text-[9px]"></i>
          </span>
        </div>

        <!-- Role 2 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-base mb-4">
              <i class="fas fa-chalkboard-user"></i>
            </div>
            <h4 data-i18n="role_2_title" class="font-bold text-slate-900 dark:text-white text-sm mb-1.5">শিক্ষক প্যানেল</h4>
            <p data-i18n="role_2_desc" class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
              ক্লাসের হাজিরা গ্রহণ, পরীক্ষার মার্কস প্রদান, বাড়ির কাজ আপলোড এবং রুটিন অনুযায়ী ক্লাস পরিচালনা।
            </p>
          </div>
          <span class="mt-4 text-[11px] font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
            টিচার্স ওয়ার্কস্পেস <i class="fas fa-chevron-right text-[9px]"></i>
          </span>
        </div>

        <!-- Role 3 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center text-base mb-4">
              <i class="fas fa-mobile-screen-button"></i>
            </div>
            <h4 data-i18n="role_3_title" class="font-bold text-slate-900 dark:text-white text-sm mb-1.5">অভিভাবক ও শিক্ষার্থী পোর্টাল</h4>
            <p data-i18n="role_3_desc" class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
              সন্তানের দৈনিক হাজিরা, প্রোগ্রেস কার্ড, ছুটির নোটিশ ও বিকাশ/নগদে ঘরে বসে ফি পরিশোধ করার সুবিধা।
            </p>
          </div>
          <span class="mt-4 text-[11px] font-bold text-amber-600 dark:text-amber-400 flex items-center gap-1">
            প্যারেন্টস মোবাইল অ্যাপ <i class="fas fa-chevron-right text-[9px]"></i>
          </span>
        </div>

        <!-- Role 4 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center text-base mb-4">
              <i class="fas fa-calculator"></i>
            </div>
            <h4 data-i18n="role_4_title" class="font-bold text-slate-900 dark:text-white text-sm mb-1.5">অ্যাকাউন্টিং ও ফিন্যান্স শাখা</h4>
            <p data-i18n="role_4_desc" class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
              ফি কালেকশন, দৈনিক ক্যাশবুক, আয়-ব্যয় অডিট, বেতন বিতরণ ও ব্যাংকিং লেনদেনের স্বয়ংক্রিয় রিকনসিলিয়েশন।
            </p>
          </div>
          <span class="mt-4 text-[11px] font-bold text-sky-600 dark:text-sky-400 flex items-center gap-1">
            স্মার্ট হিসাব শাখা <i class="fas fa-chevron-right text-[9px]"></i>
          </span>
        </div>

      </div>

    </div>
  </section>

  <!-- ======================== 6. PRICING PLANS ======================== -->
  <section id="pricing" class="py-20 lg:py-28 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span data-i18n="price_tag" class="text-xs font-extrabold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/70 px-3 py-1 rounded-full border border-indigo-200 dark:border-indigo-800">
          স্বচ্ছ ও সাশ্রয়ী প্যাকেজ
        </span>
        <h2 data-i18n="price_heading" class="mt-4 text-2xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">
          আপনার প্রতিষ্ঠানের আকারের সাথে মানানসই প্ল্যান বেছে নিন
        </h2>
        <p data-i18n="price_sub" class="mt-3 text-sm text-slate-600 dark:text-slate-400">
          কোনো গোপন চার্জ নেই। বিনামূল্যে ১৪ দিনের ট্রায়াল উপভোগ করুন।
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        
        <!-- Plan 1: Basic -->
        <div class="p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col justify-between">
          <div>
            <span data-i18n="plan_1_title" class="font-extrabold text-slate-900 dark:text-white text-base block">প্রাইমারি / কিন্ডারগার্টেন</span>
            <p data-i18n="plan_1_sub" class="text-xs text-slate-500 mt-1">ছোট ও মাঝারি স্কুলের জন্য উপযোগী</p>
            <div class="mt-6 flex items-baseline gap-1">
              <span class="text-3xl font-black text-slate-900 dark:text-white">৳ ২,৪৯৯</span>
              <span class="text-xs text-slate-400">/প্রতি মাস</span>
            </div>
            <ul class="mt-6 space-y-3 text-xs text-slate-600 dark:text-slate-300">
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> সর্বোচ্চ ৫০০ জন শিক্ষার্থী</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> শিক্ষার্থী ও শিক্ষক প্রোফাইল</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> ডিজিটাল হাজিরা ও রিপোর্ট</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> ফি কালেকশন ও রিসিট</li>
              <li class="flex items-center gap-2 text-slate-400"><i class="fas fa-times text-slate-300"></i> কাস্টম ডোমেইন সাপোর্ট</li>
            </ul>
          </div>
          <a href="{{ route('register') }}" class="mt-8 w-full py-3 text-center rounded-xl font-bold text-xs bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-100 transition cursor-pointer">
            শুরু করুন
          </a>
        </div>

        <!-- Plan 2: Pro (Featured) -->
        <div class="p-7 rounded-3xl bg-indigo-600 text-white shadow-2xl relative flex flex-col justify-between transform md:-translate-y-2">
          <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3 py-1 bg-amber-400 text-slate-900 text-[10px] font-black rounded-full uppercase tracking-wider shadow-md">
            সবচেয়ে জনপ্রিয় (Most Popular)
          </div>
          <div>
            <span data-i18n="plan_2_title" class="font-extrabold text-white text-base block">হাই স্কুল ও কলেজ</span>
            <p data-i18n="plan_2_sub" class="text-xs text-indigo-100 mt-1">পূর্ণাঙ্গ ডিজিটাল ক্যাম্পাসের জন্য সেরা সমাধান</p>
            <div class="mt-6 flex items-baseline gap-1">
              <span class="text-3xl font-black text-white">৳ ৪,৯৯৯</span>
              <span class="text-xs text-indigo-200">/প্রতি মাস</span>
            </div>
            <ul class="mt-6 space-y-3 text-xs text-indigo-100">
              <li class="flex items-center gap-2"><i class="fas fa-check text-amber-300"></i> সর্বোচ্চ ২,০০০ জন শিক্ষার্থী</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-amber-300"></i> স্বয়ংক্রিয় এসএমএস গেটওয়ে সংযুক্ত</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-amber-300"></i> অনলাইন ফি গেটওয়ে (বিকাশ/নগদ)</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-amber-300"></i> মার্কশিট ও জিপিএ রেজাল্ট কার্ড</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-amber-300"></i> অভিভাবক ও শিক্ষার্থী মোবাইল পোর্টাল</li>
            </ul>
          </div>
          <a href="{{ route('register') }}" class="mt-8 w-full py-3 text-center rounded-xl font-bold text-xs bg-white hover:bg-slate-100 text-indigo-700 shadow-md transition cursor-pointer">
            ১৪ দিনের ফ্রি ট্রায়াল নিন
          </a>
        </div>

        <!-- Plan 3: Enterprise -->
        <div class="p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col justify-between">
          <div>
            <span data-i18n="plan_3_title" class="font-extrabold text-slate-900 dark:text-white text-base block">ক্যাডেট / ইউনিভার্সিটি শাখা</span>
            <p data-i18n="plan_3_sub" class="text-xs text-slate-500 mt-1">বৃহৎ শিক্ষা প্রতিষ্ঠান ও চেইন ক্যাম্পাসের জন্য</p>
            <div class="mt-6 flex items-baseline gap-1">
              <span class="text-3xl font-black text-slate-900 dark:text-white">৳ ৮,৯৯৯</span>
              <span class="text-xs text-slate-400">/প্রতি মাস</span>
            </div>
            <ul class="mt-6 space-y-3 text-xs text-slate-600 dark:text-slate-300">
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> আনলিমিটেড শিক্ষার্থী ও শিক্ষক</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> একাধিক ব্রাঞ্চ ও ক্যাম্পাস সিঙ্ক</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> কাস্টম ডোমেইন ও নিজস্ব লোগো</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> ডেডিকেটেড সাপোর্ট অ্যাকাউন্ট ম্যানেজার</li>
              <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> দৈনিক ক্লাউড ডেটা ব্যাকআপ</li>
            </ul>
          </div>
          <a href="{{ route('register') }}" class="mt-8 w-full py-3 text-center rounded-xl font-bold text-xs bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-100 transition cursor-pointer">
            কাস্টম যোগাযোগ করুন
          </a>
        </div>

      </div>

    </div>
  </section>

  <!-- ======================== 7. FAQ SECTION ======================== -->
  <section id="faq" class="py-20 bg-slate-100/70 dark:bg-slate-900/50 border-t border-slate-200/80 dark:border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center mb-14">
        <span data-i18n="faq_tag" class="text-xs font-extrabold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/70 px-3 py-1 rounded-full border border-indigo-200 dark:border-indigo-800">
          সচরাচর জিজ্ঞাসিত প্রশ্ন
        </span>
        <h2 data-i18n="faq_heading" class="mt-4 text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
          সফটওয়্যার সম্পর্কে সাধারণ প্রশ্নের উত্তর
        </h2>
      </div>

      <div class="space-y-4 text-xs sm:text-sm">
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
          <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-1.5 flex items-center gap-2">
            <i class="fas fa-circle-question text-indigo-600"></i>
            সফটওয়্যারটি সেটআপ করতে কত সময় লাগে?
          </h4>
          <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
            রেজিস্ট্রেশন করার পর মাত্র ৩০ মিনিটের মধ্যেই আপনার স্কুলের যাবতীয় তথ্য ও শিক্ষার্থীর তালিকা এক্সেল শিট থেকে আপলোড করে সফটওয়্যার পুরোপুরি চালু করতে পারবেন।
          </p>
        </div>

        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
          <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-1.5 flex items-center gap-2">
            <i class="fas fa-circle-question text-indigo-600"></i>
            অভিভাবকরা কি মোবাইল ফোন থেকে দেখতে পারবেন?
          </h4>
          <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
            হ্যাঁ, অভিভাবকরা যেকোনো স্মার্টফোন ব্রাউজার বা আমাদের অ্যান্ড্রয়েড মোবাইল অ্যাপের মাধ্যমে সন্তানের হাজিরা, রিপোর্ট কার্ড এবং বকেয়া ফি সহজে পর্যবেক্ষণ করতে পারবেন।
          </p>
        </div>

        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
          <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-1.5 flex items-center gap-2">
            <i class="fas fa-circle-question text-indigo-600"></i>
            আমাদের স্কুলের ডাটা কি সম্পূর্ণ নিরাপদ থাকবে?
          </h4>
          <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
            আমরা সর্বাধুনিক ক্লাউড এনক্রিপশন ও ক্লাউড সার্ভার ব্যবহার করি। প্রতিদিন স্বয়ংক্রিয়ভাবে ডাটাবেজ ব্যাকআপ রাখা হয়, তাই কোনো তথ্য হারানোর কোনো ঝুঁকি নেই।
          </p>
        </div>
      </div>

    </div>
  </section>

  <!-- ======================== 8. BOTTOM CTA BANNER ======================== -->
  <section class="py-20 relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="rounded-3xl bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-900 text-white p-8 sm:p-14 text-center shadow-2xl relative overflow-hidden">
        
        <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
          <i class="fas fa-graduation-cap text-[220px]"></i>
        </div>

        <span class="text-xs font-bold bg-white/20 px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">
          আজই যোগ দিন
        </span>
        <h2 data-i18n="cta_title" class="text-2xl sm:text-4xl font-black tracking-tight leading-snug">
          আপনার বিদ্যালয়কে রূপান্তর করুন আগামী প্রজন্মের স্মার্ট ক্যাম্পাসে
        </h2>
        <p data-i18n="cta_desc" class="mt-4 text-xs sm:text-sm text-indigo-100 max-w-xl mx-auto leading-relaxed">
          কোনো ক্রেডিট কার্ড ছাড়াই আজই ১৪ দিনের ফ্রি ট্রায়াল শুরু করুন এবং স্কুলের প্রশাসনিক কাজের গতি বৃদ্ধি করুন বহু গুণে।
        </p>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3.5">
          <a 
            href="{{ route('register') }}" 
            class="px-8 py-3.5 rounded-2xl bg-white text-indigo-700 hover:bg-indigo-50 font-bold text-xs sm:text-sm shadow-lg transition flex items-center gap-2 cursor-pointer"
          >
            <span>ফ্রি ট্রায়াল শুরু করুন (Sign Up)</span>
            <i class="fas fa-arrow-right text-xs"></i>
          </a>
          <a 
            href="{{ route('login') }}" 
            class="px-8 py-3.5 rounded-2xl bg-indigo-800/80 hover:bg-indigo-800 text-white border border-indigo-500 font-bold text-xs sm:text-sm transition flex items-center gap-2 cursor-pointer"
          >
            <i class="fas fa-key text-xs"></i>
            <span>লগইন পোর্টাল</span>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- ======================== 9. FOOTER ======================== -->
  <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12 text-xs text-slate-500 dark:text-slate-400 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        
        <!-- Col 1: Brand -->
        <div class="space-y-3">
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-sm">
              <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="font-black text-slate-900 dark:text-white text-sm uppercase">
              {{ config('app.name', 'School Management') }}
            </span>
          </div>
          <p class="text-[11px] leading-relaxed">
            বাংলাদেশের আধুনিক স্কুল, কলেজ ও মাদ্রাসার জন্য একটি সমন্বিত ও নির্ভরযোগ্য ডিজিটাল অ্যাকাডেমিক ইআরপি প্ল্যাটফর্ম।
          </p>
        </div>

        <!-- Col 2: Quick Links -->
        <div>
          <h5 class="font-bold text-slate-900 dark:text-white uppercase text-[11px] tracking-wider mb-3">দ্রুত লিঙ্কস</h5>
          <ul class="space-y-2 text-[11px]">
            <li><a href="#features" class="hover:text-indigo-600 transition">ফিচারসমূহ</a></li>
            <li><a href="#modules" class="hover:text-indigo-600 transition">মডিউলস</a></li>
            <li><a href="#pricing" class="hover:text-indigo-600 transition">প্রাইসিং প্যাকেজ</a></li>
            <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition">অ্যাডমিন লগইন</a></li>
          </ul>
        </div>

        <!-- Col 3: Modules -->
        <div>
          <h5 class="font-bold text-slate-900 dark:text-white uppercase text-[11px] tracking-wider mb-3">মডিউল</h5>
          <ul class="space-y-2 text-[11px]">
            <li>ডিজিটাল হাজিরা</li>
            <li>অনলাইন ফি কালেকশন</li>
            <li>মার্কশিট ও জিপিএ রেজাল্ট</li>
            <li>এসএমএস নোটিফিকেশন</li>
          </ul>
        </div>

        <!-- Col 4: Contact -->
        <div>
          <h5 class="font-bold text-slate-900 dark:text-white uppercase text-[11px] tracking-wider mb-3">যোগাযোগ ও সহায়তা</h5>
          <ul class="space-y-2 text-[11px]">
            <li class="flex items-center gap-2"><i class="fas fa-phone text-indigo-500"></i> +৮৮০ ১৭০০-০০০০০০</li>
            <li class="flex items-center gap-2"><i class="fas fa-envelope text-indigo-500"></i> support@edumanage.bd</li>
            <li class="flex items-center gap-2"><i class="fas fa-location-dot text-indigo-500"></i> ঢাকা, বাংলাদেশ</li>
          </ul>
        </div>

      </div>

      <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px]">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'School Management') }}. সর্বস্বত্ব সংরক্ষিত।</p>
        <div class="flex items-center gap-4 text-slate-400">
          <a href="#" class="hover:text-indigo-600"><i class="fab fa-facebook text-sm"></i></a>
          <a href="#" class="hover:text-indigo-600"><i class="fab fa-twitter text-sm"></i></a>
          <a href="#" class="hover:text-indigo-600"><i class="fab fa-linkedin text-sm"></i></a>
          <a href="#" class="hover:text-indigo-600"><i class="fab fa-youtube text-sm"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ======================== INTERACTIVE JAVASCRIPT ======================== -->
  <script>
    // ----------------- i18n Translation Dictionary -----------------
    const I18N = {
      bn: {
        nav_sub: "স্মার্ট ডিজিটাল ক্যাম্পাস ইআরপি",
        nav_features: "ফিচারসমূহ",
        nav_modules: "মডিউলস",
        nav_stats: "পরিসংখ্যান",
        nav_portals: "পোর্টালসমূহ",
        nav_pricing: "প্যাকেজ",
        nav_faq: "প্রশ্নোত্তর",
        nav_dashboard: "ড্যাশবোর্ড",
        nav_login: "লগইন",
        nav_get_started: "নিবন্ধন করুন",
        hero_pill: "✨ পরবর্তী প্রজন্মের ক্লাউড স্কুল ম্যানেজমেন্ট সফটওয়্যার • Smart School ERP",
        hero_title_1: "স্মার্ট স্কুলের সম্পূর্ণ ব্যবস্থাপনা",
        hero_title_2: "এখন একটি মাত্র প্ল্যাটফর্মে",
        hero_desc: "ভর্তি, ডিজিটাল হাজিরা, অনলাইন ফি কালেকশন, পরীক্ষার রেজাল্ট, স্বয়ংক্রিয় এসএমএস এবং শিক্ষক-অভিভাবক পোর্টাল—আপনার বিদ্যালয়ের দৈনন্দিন সব কাজ পরিচালনা করুন নির্ভুল ও স্বাচ্ছন্দ্যে।",
        hero_cta_start: "বিনামূল্যে ট্রায়াল শুরু করুন",
        hero_cta_demo: "লাইভ ডেমো দেখুন (Demo Login)",
        proof_1: "১,২০০+ শিক্ষা প্রতিষ্ঠান",
        proof_2: "তাত্ক্ষণিক সেটআপ",
        proof_3: "১০০% নিরাপদ ক্লাউড ডেটা",
        proof_4: "২৪/৭ কাস্টমার সাপোর্ট",
        hero_badge_att_title: "আজকের উপস্থিতি",
        hero_badge_att_val: "৯৬.৫% (১,৩৯৯ জন)",
        hero_badge_fee_title: "চলতি মাসের ফি আদায়",
        hero_badge_fee_val: "৳ ৫,৮২,০০০ (৮৫%)",
        stat_1_val: "১,২০০+",
        stat_1_lbl: "সক্রিয় স্কুল ও কলেজ",
        stat_2_val: "৪,৫০,০০০+",
        stat_2_lbl: "শিক্ষার্থী ও অভিভাবক",
        stat_3_val: "৯৯.৮%",
        stat_3_lbl: "গ্রাহক সন্তুষ্টির হার",
        stat_4_val: "১৫+ মিলিয়ন",
        stat_4_lbl: "রিপোর্ট কার্ড ও এসএমএস",
        mod_tag: "সর্বাধুনিক মডিউলসমূহ",
        mod_heading: "স্কুল পরিচালনার জন্য প্রয়োজনীয় সকল ফিচার এক ছাদের নিচে",
        mod_sub: "অফিসের কাগজপত্রের ঝামেলা চিরতরে দূর করে স্কুলকে রূপান্তর করুন দ্রুত ও স্বয়ংক্রিয় ডিজিটাল প্রতিষ্ঠানে।",
        feat_1_title: "অনলাইন ভর্তি ও শিক্ষার্থী তথ্য",
        feat_1_desc: "অনলাইনে আবেদন গ্রহণ, স্বয়ংক্রিয় রোল নির্ধারণ, বারকোডসহ ডিজিটাল আইডি কার্ড তৈরি এবং শিক্ষার্থীর পূর্ণাঙ্গ বায়োডাটা সংরক্ষণ।",
        feat_2_title: "স্মার্ট হাজিরা ও ইনস্ট্যান্ট SMS",
        feat_2_desc: "বায়োমেট্রিক, আরএফআইডি বা মোবাইল দিয়ে হাজিরা গ্রহণ। কোনো শিক্ষার্থী অনুপস্থিত থাকলে সাথে সাথে অভিভাবকের ফোনে এসএমএস অ্যালার্ট।",
        feat_3_title: "ফি কালেকশন ও অনলাইন পেমেন্ট",
        feat_3_desc: "বিকাশ, নগদ ও ব্যাংকের মাধ্যমে টিউশন ফি গ্রহণ, স্বয়ংক্রিয় ডিজিটাল রিসিট ও বকেয়া ফি-র জন্য অভিভাবককে অটো রিমাইন্ডার পাঠানো।",
        feat_4_title: "পরীক্ষা, গ্রেডিং ও মার্কশিট",
        feat_4_desc: "জাতীয় শিক্ষা কারিকুলাম ও জিপিএ গ্রেডিং সিস্টেমের আলোকে নির্ভুল পরীক্ষার রেজাল্ট, প্রোগ্রেস রিপোর্ট কার্ড এবং মেধা তালিকা প্রস্তুতকরণ।",
        feat_5_title: "শিক্ষক ও স্টাফ পেরোল",
        feat_5_desc: "শিক্ষক ও কর্মচারীদের ডিজিটাল প্রোফাইল, বিষয় বণ্টন, ছুটির হিসাব, স্বয়ংক্রিয় বেতন শীট ও বোনাস হিসাব ব্যবস্থাপনা।",
        feat_6_title: "ডিজিটাল রুটিন ও নোটিশ বোর্ড",
        feat_6_desc: "ক্লাস রুটিন, পরীক্ষার সময়সূচি এবং জরুরি অ্যাকাডেমিক নোটিশ সরাসরি মোবাইল অ্যাপ ও ওয়েব পোর্টালে প্রকাশ করার সুবিধা।",
        portal_tag: "সমন্বিত সমাধান",
        portal_heading: "স্কুলের প্রত্যেকের জন্য আলাদা ও ডেডিকেটেড পোর্টাল",
        portal_sub: "প্রিন্সিপাল, শিক্ষক, অভিভাবক ও হিসাব শাখার জন্য আলাদা ড্যাশবোর্ড ও সিকিউর অ্যাক্সেস।",
        role_1_title: "সুপার অ্যাডমিন ড্যাশবোর্ড",
        role_1_desc: "স্কুলের সার্বিক কার্যক্রম, শিক্ষক ও শিক্ষার্থী রেকর্ড, আর্থিক অডিট এবং যেকোনো সময় কেন্দ্রীয় মনিটরিং।",
        role_2_title: "শিক্ষক প্যানেল",
        role_2_desc: "ক্লাসের হাজিরা গ্রহণ, পরীক্ষার মার্কস প্রদান, বাড়ির কাজ আপলোড এবং রুটিন অনুযায়ী ক্লাস পরিচালনা।",
        role_3_title: "অভিভাবক ও শিক্ষার্থী পোর্টাল",
        role_3_desc: "সন্তানের দৈনিক হাজিরা, প্রোগ্রেস কার্ড, ছুটির নোটিশ ও বিকাশ/নগদে ঘরে বসে ফি পরিশোধ করার সুবিধা।",
        role_4_title: "অ্যাকাউন্টিং ও ফিন্যান্স শাখা",
        role_4_desc: "ফি কালেকশন, দৈনিক ক্যাশবুক, আয়-ব্যয় অডিট, বেতন বিতরণ ও ব্যাংকিং লেনদেনের স্বয়ংক্রিয় রিকনসিলিয়েশন।",
        price_tag: "স্বচ্ছ ও সাশ্রয়ী প্যাকেজ",
        price_heading: "আপনার প্রতিষ্ঠানের আকারের সাথে মানানসই প্ল্যান বেছে নিন",
        price_sub: "কোনো গোপন চার্জ নেই। বিনামূল্যে ১৪ দিনের ট্রায়াল উপভোগ করুন।",
        plan_1_title: "প্রাইমারি / কিন্ডারগার্টেন",
        plan_1_sub: "ছোট ও মাঝারি স্কুলের জন্য উপযোগী",
        plan_2_title: "হাই স্কুল ও কলেজ",
        plan_2_sub: "পূর্ণাঙ্গ ডিজিটাল ক্যাম্পাসের জন্য সেরা সমাধান",
        plan_3_title: "ক্যাডেট / ইউনিভার্সিটি শাখা",
        plan_3_sub: "বৃহৎ শিক্ষা প্রতিষ্ঠান ও চেইন ক্যাম্পাসের জন্য",
        faq_tag: "সচরাচর জিজ্ঞাসিত প্রশ্ন",
        faq_heading: "সফটওয়্যার সম্পর্কে সাধারণ প্রশ্নের উত্তর",
        cta_title: "আপনার বিদ্যালয়কে রূপান্তর করুন আগামী প্রজন্মের স্মার্ট ক্যাম্পাসে",
        cta_desc: "কোনো ক্রেডিট কার্ড ছাড়াই আজই ১৪ দিনের ফ্রি ট্রায়াল শুরু করুন এবং স্কুলের প্রশাসনিক কাজের গতি বৃদ্ধি করুন বহু গুণে।"
      },
      en: {
        nav_sub: "Smart Digital Campus ERP",
        nav_features: "Features",
        nav_modules: "Modules",
        nav_stats: "Statistics",
        nav_portals: "Portals",
        nav_pricing: "Pricing",
        nav_faq: "FAQ",
        nav_dashboard: "Dashboard",
        nav_login: "Log In",
        nav_get_started: "Get Started",
        hero_pill: "✨ Next-Gen Cloud School Management Software • Smart Campus ERP",
        hero_title_1: "Complete School Management",
        hero_title_2: "Now on a Single Smart Platform",
        hero_desc: "Admissions, biometric attendance, online fees collection, exam report cards, automated SMS and parent-teacher portals—run your campus flawlessly.",
        hero_cta_start: "Start Free 14-Day Trial",
        hero_cta_demo: "Explore Live Demo",
        proof_1: "1,200+ Educational Institutions",
        proof_2: "Instant Setup",
        proof_3: "100% Encrypted Cloud Data",
        proof_4: "24/7 Priority Support",
        hero_badge_att_title: "Today's Attendance",
        hero_badge_att_val: "96.5% (1,399 students)",
        hero_badge_fee_title: "Monthly Fees Collected",
        hero_badge_fee_val: "৳ 582,000 (85%)",
        stat_1_val: "1,200+",
        stat_1_lbl: "Active Schools & Colleges",
        stat_2_val: "450,000+",
        stat_2_lbl: "Students & Parents",
        stat_3_val: "99.8%",
        stat_3_lbl: "Customer Satisfaction",
        stat_4_val: "15M+",
        stat_4_lbl: "Report Cards & SMS Sent",
        mod_tag: "Comprehensive Modules",
        mod_heading: "Every Academic & Administrative Tool Under One Roof",
        mod_sub: "Say goodbye to paper chaos and manual registers. Automate your educational institute today.",
        feat_1_title: "Admissions & Student Bio",
        feat_1_desc: "Online applicant portal, auto roll assignment, barcode ID card generator and complete digital academic profiles.",
        feat_2_title: "Smart Attendance & SMS Alerts",
        feat_2_desc: "Biometric, RFID or mobile app attendance. Automatic instant SMS triggers to parents when a student is absent.",
        feat_3_title: "Fee Collection & Payments",
        feat_3_desc: "Integrated online payments via bKash, Nagad & cards, automated PDF receipts, and recurring dues notifications.",
        feat_4_title: "Exams, GPA & Marksheets",
        feat_4_desc: "Custom GPA grading formulas, automated term report cards, transcript generation and student merit rankings.",
        feat_5_title: "Teacher & Staff HR Payroll",
        feat_5_desc: "Teacher profiles, subject allotment, leave requests, automated salary slips and overtime calculations.",
        feat_6_title: "Digital Routine & Notices",
        feat_6_desc: "Class routines, exam timetables, event calendars, and emergency announcements published directly to mobile apps.",
        portal_tag: "Unified Solution",
        portal_heading: "Dedicated Portals Designed for Every Stakeholder",
        portal_sub: "Tailored dashboards for Principals, Teachers, Parents and Accountants with fine-grained access control.",
        role_1_title: "Super Admin Dashboard",
        role_1_desc: "Complete executive overview, institutional statistics, real-time audit trails and global configuration.",
        role_2_title: "Teacher Workspace",
        role_2_desc: "Quick classroom attendance, exam marks entry, homework submissions, and schedule management.",
        role_3_title: "Parent & Student App",
        role_3_desc: "Track student performance, daily attendance records, exam results and pay tuition fees from home.",
        role_4_title: "Accounts & Finance Branch",
        role_4_desc: "Fee collection vouchers, daily cash book, expense ledger, salary distribution and bank reconciliation.",
        price_tag: "Transparent & Affordable",
        price_heading: "Choose the Perfect Plan for Your Institute's Size",
        price_sub: "No hidden charges. Enjoy a full-featured 14-day free trial on us.",
        plan_1_title: "Primary / Kindergarten",
        plan_1_sub: "Tailored for small and medium schools",
        plan_2_title: "High School & College",
        plan_2_sub: "The complete digital campus solution",
        plan_3_title: "Cadet / University Branch",
        plan_3_sub: "For large enterprise campuses & chains",
        faq_tag: "Frequently Asked Questions",
        faq_heading: "Common Questions About the Platform",
        cta_title: "Transform Your Campus into a Smart Digital Institution Today",
        cta_desc: "Start your free 14-day trial without entering any credit card and accelerate your school's productivity exponentially."
      }
    };

    let currentLang = localStorage.getItem('app_lang') || 'bn';

    function applyLanguage(lang) {
      currentLang = lang;
      localStorage.setItem('app_lang', lang);
      const dict = I18N[lang];

      document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (dict && dict[key]) {
          el.textContent = dict[key];
        }
      });

      const langBtnText = document.getElementById('langBtnText');
      if (langBtnText) {
        langBtnText.textContent = (lang === 'bn') ? 'English' : 'বাংলা';
      }
    }

    function toggleLanguage() {
      const newLang = (currentLang === 'bn') ? 'en' : 'bn';
      applyLanguage(newLang);
    }

    // ----------------- Dark / Light Theme -----------------
    function applyTheme(theme) {
      const icon = document.getElementById('themeIcon');
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        localStorage.setItem('app_theme', 'dark');
        if (icon) {
          icon.className = "fas fa-sun text-amber-400 text-sm";
        }
      } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('app_theme', 'light');
        if (icon) {
          icon.className = "fas fa-moon text-indigo-600 text-sm";
        }
      }
    }

    function toggleTheme() {
      const isDark = document.documentElement.classList.contains('dark');
      applyTheme(isDark ? 'light' : 'dark');
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
      const savedTheme = localStorage.getItem('app_theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
      applyTheme(savedTheme);
      applyLanguage(currentLang);
    });
  </script>
</body>
</html>

