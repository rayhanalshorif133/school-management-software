<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - {{ config('app.name', 'School Management') }}</title>

  <!-- Early Dark Mode Detection Script to prevent flashing -->
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

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', 'Hind Siliguri', sans-serif;
    }
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 9999px;
    }
    .dark ::-webkit-scrollbar-track {
      background: #0f172a;
    }
    .dark ::-webkit-scrollbar-thumb {
      background: #334155;
    }
  </style>
</head>
<body class="bg-slate-100/90 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased h-screen overflow-hidden flex flex-col transition-colors duration-200">

  <!-- Top Navigation Bar -->
  <header class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 sticky top-0 z-30 shadow-xs shrink-0 transition-colors duration-200">
    <div class="px-3 sm:px-6 py-2.5 sm:py-3 flex items-center justify-between gap-2 sm:gap-4">

      <!-- Left: Mobile Menu Toggle & Brand Logo -->
      <div class="flex items-center gap-2 sm:gap-3 min-w-0">
        <!-- Mobile Sidebar Drawer Toggle Button (Visible only on < lg) -->
        <button
          id="mobileMenuToggleBtn"
          onclick="toggleMobileMenu()"
          class="lg:hidden w-8.5 h-8.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-200 flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-700 transition cursor-pointer shadow-xs shrink-0"
          title="Open Navigation Menu"
          aria-label="Open Navigation Menu"
        >
          <i class="fas fa-bars text-sm"></i>
        </button>

        <!-- Brand Icon -->
        <div class="w-8.5 h-8.5 sm:w-10 sm:h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-200 dark:shadow-indigo-950 text-base sm:text-lg shrink-0">
          <i class="fas fa-school"></i>
        </div>

        <!-- Brand Name & Badges -->
        <div class="min-w-0">
          <h1 class="font-black text-slate-900 dark:text-white text-xs sm:text-base leading-tight tracking-tight flex items-center gap-1.5 truncate">
            <span data-i18n="brand_title" class="truncate">SCHOOL HQ</span>
            <span class="hidden sm:inline-block text-[10px] bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-bold px-2 py-0.5 rounded-full border border-indigo-200 dark:border-indigo-800 shrink-0">Super Admin</span>
          </h1>
          <p data-i18n="brand_sub" class="hidden md:block text-[11px] text-slate-400 dark:text-slate-500 font-medium truncate">স্মার্ট ডিজিটাল স্কুল ও অ্যাকাডেমিক ম্যানেজমেন্ট পোর্টাল</p>
        </div>
      </div>

      <!-- Right: Controls, User Profile & Actions -->
      <div class="flex items-center gap-1.5 sm:gap-2.5 shrink-0">

        <!-- Language Switcher Toggle Button (Bangla <-> English) -->
        <button
          id="langToggleBtn"
          onclick="toggleLanguage()"
          class="h-8.5 px-2 sm:px-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs"
          title="Switch Language (English / বাংলা)"
        >
          <i class="fas fa-globe text-indigo-500 text-xs sm:text-sm"></i>
          <span id="langBtnText" class="hidden sm:inline">English</span>
        </button>

        <!-- Dark / Light Mode Toggle Button -->
        <button 
          id="themeToggleBtn" 
          onclick="toggleTheme()" 
          class="h-8.5 px-2 sm:px-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-100/80 dark:bg-slate-800 hover:bg-slate-200/80 dark:hover:bg-slate-700 text-slate-700 dark:text-amber-400 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs"
          title="Toggle Light / Dark Mode"
        >
          <i id="themeIcon" class="fas fa-moon text-indigo-600 dark:text-amber-400 text-xs sm:text-sm"></i>
          <span id="themeLabelText" class="hidden sm:inline">Dark</span>
        </button>

        <!-- Quick Action Badge (Desktop Only) -->
        <button
          onclick="openStudentModal()"
          class="hidden md:flex items-center gap-1.5 h-8.5 px-3 bg-indigo-50 dark:bg-indigo-950/60 hover:bg-indigo-100 dark:hover:bg-indigo-900/60 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 rounded-xl text-xs font-bold transition cursor-pointer"
        >
          <i class="fas fa-plus-circle text-indigo-600 dark:text-indigo-400"></i>
          <span data-i18n="btn_new_student">নতুন শিক্ষার্থী ভর্তি</span>
        </button>

        <!-- Admin Live Status Badge (XL screens) -->
        <div class="hidden xl:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
          <span data-i18n="badge_admin">SUPER ADMIN HQ</span>
        </div>

        <!-- User Info -->
        <div class="flex items-center gap-2 pl-1 sm:pl-2 border-l border-slate-200 dark:border-slate-700">
          <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs shadow-xs shrink-0" title="{{ Auth::user()->name }}">
            <i class="fas fa-user-shield"></i>
          </div>
          <div class="hidden lg:block text-left">
            <span class="text-xs font-bold text-slate-800 dark:text-slate-100 block leading-tight">{{ Auth::user()->name }}</span>
            <span class="text-[10px] text-slate-400 dark:text-slate-500 font-medium">{{ Auth::user()->email }}</span>
          </div>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="inline m-0">
          @csrf
          <button
            type="submit"
            title="Sign Out"
            class="h-8.5 px-2.5 sm:px-3 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-rose-300 dark:hover:border-rose-800 text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition flex items-center gap-1.5 text-xs font-bold cursor-pointer"
          >
            <i class="fas fa-right-from-bracket"></i>
            <span data-i18n="btn_logout" class="hidden sm:inline">লগআউট</span>
          </button>
        </form>

      </div>
    </div>
  </header>

  <!-- Mobile Navigation Drawer Overlay & Panel -->
  <div id="mobileDrawer" class="fixed inset-0 z-50 lg:hidden hidden">
    <!-- Backdrop -->
    <div onclick="toggleMobileMenu()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>

    <!-- Sliding Menu Panel -->
    <div class="fixed inset-y-0 left-0 w-72 max-w-[85vw] bg-white dark:bg-slate-900 shadow-2xl border-r border-slate-200 dark:border-slate-800 flex flex-col z-10 p-4 overflow-y-auto">
      <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100 dark:border-slate-800">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-xs shadow-xs">
            <i class="fas fa-school"></i>
          </div>
          <div>
            <h3 class="font-black text-slate-900 dark:text-white text-xs leading-tight">SCHOOL HQ</h3>
            <span class="text-[10px] text-slate-400 dark:text-slate-500 font-medium">মোবাইল নেভিগেশন</span>
          </div>
        </div>
        <button onclick="toggleMobileMenu()" class="w-7 h-7 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 cursor-pointer">
          <i class="fas fa-times text-xs"></i>
        </button>
      </div>

      <!-- Mobile Quick Action Button -->
      <button
        onclick="toggleMobileMenu(); openStudentModal();"
        class="w-full flex items-center justify-center gap-2 px-3 py-2.5 mb-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-200 dark:shadow-indigo-950 transition cursor-pointer"
      >
        <i class="fas fa-plus-circle"></i>
        <span data-i18n="btn_new_student">নতুন শিক্ষার্থী ভর্তি</span>
      </button>

      <!-- Navigation Modules -->
      <div data-i18n="modules_title" class="text-[11px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider px-2 mb-2">
        অ্যাডমিন মডিউল সমূহ
      </div>

      <nav class="space-y-1.5 flex-1">
        <button
          id="m-btn-tab-overview"
          onclick="switchTab('overview'); toggleMobileMenu();"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-xs bg-indigo-600 text-white shadow-md shadow-indigo-200 dark:shadow-indigo-950 transition cursor-pointer"
        >
          <i class="fas fa-chart-pie w-4 text-center"></i>
          <span data-i18n="tab_overview">ড্যাশবোর্ড ওভারভিউ</span>
        </button>

        <button
          id="m-btn-tab-students"
          onclick="switchTab('students'); toggleMobileMenu();"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-user-graduate w-4 text-center text-indigo-500"></i>
          <span data-i18n="tab_students">শিক্ষার্থী ও অভিভাবক</span>
        </button>

        <button
          id="m-btn-tab-teachers"
          onclick="switchTab('teachers'); toggleMobileMenu();"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-chalkboard-user w-4 text-center text-emerald-500"></i>
          <span data-i18n="tab_teachers">শিক্ষক ও কর্মকর্তা</span>
        </button>

        <button
          id="m-btn-tab-attendance"
          onclick="switchTab('attendance'); toggleMobileMenu();"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-calendar-check w-4 text-center text-sky-500"></i>
          <span data-i18n="tab_attendance">ক্লাস ও উপস্থিতি</span>
        </button>

        <button
          id="m-btn-tab-finance"
          onclick="switchTab('finance'); toggleMobileMenu();"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-coins w-4 text-center text-amber-500"></i>
          <span data-i18n="tab_finance" class="flex-1 text-left">ফি ও অ্যাকাউন্টস</span>
          <span data-i18n="badge_new" class="text-[10px] bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 font-extrabold px-1.5 py-0.5 rounded border border-amber-200 dark:border-amber-800">অডিট</span>
        </button>

        <button
          id="m-btn-tab-exams"
          onclick="switchTab('exams'); toggleMobileMenu();"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-award w-4 text-center text-rose-500"></i>
          <span data-i18n="tab_exams">পরীক্ষা ও ফলাফল</span>
        </button>

        <button
          id="m-btn-tab-project_plan"
          onclick="switchTab('project_plan'); toggleMobileMenu();"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-list-check w-4 text-center text-indigo-500"></i>
          <span data-i18n="tab_project_plan" class="flex-1 text-left">প্রজেক্ট প্ল্যান ও রোডম্যাপ</span>
          <span id="m_planPercentageBadge" class="text-[10px] bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-extrabold px-1.5 py-0.5 rounded border border-indigo-200 dark:border-indigo-800">
            {{ $stats['percentage'] ?? 0 }}%
          </span>
        </button>
      </nav>

      <!-- Class Fast Links in Mobile Drawer -->
      <div class="pt-4 mt-2 border-t border-slate-100 dark:border-slate-800">
        <span data-i18n="class_filter_title" class="text-[11px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider px-2 block mb-2">শ্রেণি অনুযায়ী ফিল্টার:</span>
        <div class="space-y-1 text-xs">
          <button onclick="filterClass('all'); toggleMobileMenu();" class="w-full text-left px-2 py-1.5 rounded-lg text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-950/60 font-bold flex justify-between cursor-pointer border border-indigo-100 dark:border-indigo-900/40">
            <span data-i18n="class_all">সকল শ্রেণি (All Classes)</span><span class="text-[10px] bg-indigo-200 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 px-1.5 rounded">১,৪৫০</span>
          </button>
          <button onclick="filterClass('Class 10'); toggleMobileMenu();" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_10">দশম শ্রেণি (Class 10)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৪৫</span>
          </button>
          <button onclick="filterClass('Class 9'); toggleMobileMenu();" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_9">নবম শ্রেণি (Class 9)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৫০</span>
          </button>
          <button onclick="filterClass('Class 8'); toggleMobileMenu();" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_8">অষ্টম শ্রেণি (Class 8)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৬০</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Container -->
  <div class="flex-1 flex overflow-hidden min-h-0">

    <!-- Sidebar -->
    <aside class="hidden lg:flex flex-col w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-4 shrink-0 h-full overflow-y-auto transition-colors duration-200">

      <div data-i18n="modules_title" class="text-[11px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider px-3 mb-2.5">
        অ্যাডমিন মডিউল সমূহ
      </div>

      <nav class="space-y-1.5 flex-1">
        <button
          id="btn-tab-overview"
          onclick="switchTab('overview')"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-xs bg-indigo-600 text-white shadow-md shadow-indigo-200 dark:shadow-indigo-950 transition cursor-pointer"
        >
          <i class="fas fa-chart-pie w-4 text-center"></i>
          <span data-i18n="tab_overview">ড্যাশবোর্ড ওভারভিউ</span>
        </button>

        <button
          id="btn-tab-students"
          onclick="switchTab('students')"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-user-graduate w-4 text-center text-indigo-500"></i>
          <span data-i18n="tab_students">শিক্ষার্থী ও অভিভাবক</span>
        </button>

        <button
          id="btn-tab-teachers"
          onclick="switchTab('teachers')"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-chalkboard-user w-4 text-center text-emerald-500"></i>
          <span data-i18n="tab_teachers">শিক্ষক ও কর্মকর্তা</span>
        </button>

        <button
          id="btn-tab-attendance"
          onclick="switchTab('attendance')"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-calendar-check w-4 text-center text-sky-500"></i>
          <span data-i18n="tab_attendance">ক্লাস ও উপস্থিতি</span>
        </button>

        <button
          id="btn-tab-finance"
          onclick="switchTab('finance')"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-coins w-4 text-center text-amber-500"></i>
          <span data-i18n="tab_finance" class="flex-1 text-left">ফি ও অ্যাকাউন্টস</span>
          <span data-i18n="badge_new" class="text-[10px] bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 font-extrabold px-1.5 py-0.5 rounded border border-amber-200 dark:border-amber-800">অডিট</span>
        </button>

        <button
          id="btn-tab-exams"
          onclick="switchTab('exams')"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-award w-4 text-center text-rose-500"></i>
          <span data-i18n="tab_exams">পরীক্ষা ও ফলাফল</span>
        </button>

        <button
          id="btn-tab-project_plan"
          onclick="switchTab('project_plan')"
          class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer"
        >
          <i class="fas fa-list-check w-4 text-center text-indigo-500"></i>
          <span data-i18n="tab_project_plan" class="flex-1 text-left">প্রজেক্ট প্ল্যান ও রোডম্যাপ</span>
          <span id="planPercentageBadge" class="text-[10px] bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-extrabold px-1.5 py-0.5 rounded border border-indigo-200 dark:border-indigo-800">
            {{ $stats['percentage'] ?? 0 }}%
          </span>
        </button>
      </nav>

      <!-- Class Fast Links -->
      <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
        <span data-i18n="class_filter_title" class="text-[11px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider px-2 block mb-2">শ্রেণি অনুযায়ী ফিল্টার:</span>
        <div class="space-y-1 max-h-48 overflow-y-auto pr-1 text-xs">
          <button onclick="filterClass('all')" class="w-full text-left px-2 py-1.5 rounded-lg text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-950/60 font-bold flex justify-between cursor-pointer border border-indigo-100 dark:border-indigo-900/40">
            <span data-i18n="class_all">সকল শ্রেণি (All Classes)</span><span class="text-[10px] bg-indigo-200 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 px-1.5 rounded">১,৪৫০</span>
          </button>
          <button onclick="filterClass('Class 10')" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_10">দশম শ্রেণি (Class 10)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৪৫</span>
          </button>
          <button onclick="filterClass('Class 9')" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_9">নবম শ্রেণি (Class 9)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৫০</span>
          </button>
          <button onclick="filterClass('Class 8')" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_8">অষ্টম শ্রেণি (Class 8)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৬০</span>
          </button>
          <button onclick="filterClass('Class 7')" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_7">সপ্তম শ্রেণি (Class 7)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৪০</span>
          </button>
          <button onclick="filterClass('Class 6')" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_6">ষষ্ঠ শ্রেণি (Class 6)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">১৫৫</span>
          </button>
          <button onclick="filterClass('Primary')" class="w-full text-left px-2 py-1 rounded text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white flex justify-between cursor-pointer">
            <span data-i18n="class_primary">প্রাথমিক শাখা (Class 1-5)</span><span class="text-[10px] text-slate-400 dark:text-slate-500">৭০০</span>
          </button>
        </div>
      </div>

    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 h-full overflow-y-auto p-4 sm:p-6 lg:p-8 min-h-0">

      <!-- Tab 1: Overview Content -->
      <div id="tabContent-overview" class="tab-pane space-y-6">

        <!-- Top Metrics Row (4 Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <!-- Metric 1: Total Students -->
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between transition-colors">
          <div>
            <span data-i18n="metric_students_title" class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">মোট শিক্ষার্থী</span>
            <h3 data-i18n="metric_students_val" class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">১,৪৫০ জন</h3>
            <span data-i18n="metric_students_sub" class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1 mt-1">
              <i class="fas fa-arrow-trend-up text-[10px]"></i> +২৫ জন চলতি মাসে
            </span>
          </div>
          <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
            <i class="fas fa-user-graduate"></i>
          </div>
        </div>

        <!-- Metric 2: Total Teachers -->
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between transition-colors">
          <div>
            <span data-i18n="metric_teachers_title" class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">শিক্ষক ও স্টাফ</span>
            <h3 data-i18n="metric_teachers_val" class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">৪৮ জন</h3>
            <span data-i18n="metric_teachers_sub" class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1 mt-1">
              <i class="fas fa-check-circle text-[10px]"></i> সকল শিক্ষক উপস্থিত
            </span>
          </div>
          <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl">
            <i class="fas fa-chalkboard-user"></i>
          </div>
        </div>

        <!-- Metric 3: Today's Attendance -->
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between transition-colors">
          <div>
            <span data-i18n="metric_att_title" class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">আজকের উপস্থিতি</span>
            <h3 data-i18n="metric_att_val" class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">৯৬.৫%</h3>
            <span data-i18n="metric_att_sub" class="text-[11px] text-indigo-600 dark:text-indigo-400 font-bold flex items-center gap-1 mt-1">
              <i class="fas fa-users text-[10px]"></i> ১,৩৯৯ জন উপস্থিত
            </span>
          </div>
          <div class="w-12 h-12 rounded-2xl bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xl">
            <i class="fas fa-calendar-check"></i>
          </div>
        </div>

        <!-- Metric 4: Fee Collection -->
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between transition-colors">
          <div>
            <span data-i18n="metric_fee_title" class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">চলতি মাসের ফি আদায়</span>
            <h3 data-i18n="metric_fee_val" class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">৳ ৫,৮২,০০০</h3>
            <span data-i18n="metric_fee_sub" class="text-[11px] text-amber-600 dark:text-amber-400 font-bold flex items-center gap-1 mt-1">
              <i class="fas fa-chart-line text-[10px]"></i> ৮৫% ফি কালেকশন সম্পন্ন
            </span>
          </div>
          <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl">
            <i class="fas fa-wallet"></i>
          </div>
        </div>

      </div>
      </div>
      <!-- End of Overview Tab Content -->

      <!-- Tab 2: Project Plan & Development Roadmap -->
      <div id="tabContent-project_plan" class="tab-pane hidden space-y-6">

        <!-- Top Header & Actions Banner -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4 transition-colors">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl shadow-md shadow-indigo-200 dark:shadow-indigo-950 shrink-0">
              <i class="fas fa-list-check"></i>
            </div>
            <div>
              <div class="flex items-center gap-2">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-950/60 px-2 py-0.5 rounded border border-indigo-200 dark:border-indigo-800">
                  সফটওয়্যার ডেভেলপমেন্ট ব্লুপ্রিন্ট ও রোডম্যাপ
                </span>
                <span class="text-xs text-slate-400 font-mono">v{{ $plan->version ?? '1.0.0' }}</span>
              </div>
              <h2 class="text-xl font-black text-slate-900 dark:text-white tracking-tight mt-1">
                {{ $plan->title ?? 'স্কুল ম্যানেজমেন্ট সিস্টেম - মাস্টার প্রজেক্ট প্ল্যান' }}
              </h2>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-2xl leading-relaxed">
                কোন মডিউলের কাজ সম্পন্ন হয়েছে, কোনটিতে কাজ চলছে, আর কোনটি অপেক্ষমাণ — সব স্ট্যাটাস সরাসরি ট্র্যাক ও আপডেট করুন।
              </p>
            </div>
          </div>

          <div class="flex items-center gap-2.5 shrink-0">
            <!-- Download PDF Button -->
            <a
              href="{{ route('project-plan.pdf') }}"
              target="_blank"
              class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 dark:shadow-indigo-950 transition flex items-center gap-2 cursor-pointer"
              title="Download or Print PDF Document"
            >
              <i class="fas fa-file-pdf"></i>
              <span>PDF ডাউনলোড / প্রিন্ট</span>
            </a>

            <!-- Add New Task Modal Trigger -->
            <button
              onclick="openAddTaskModal()"
              class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition flex items-center gap-2 cursor-pointer"
            >
              <i class="fas fa-plus text-indigo-600 dark:text-indigo-400"></i>
              <span>নতুন টাস্ক যোগ</span>
            </button>
          </div>
        </div>

        <!-- KPI Cards Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <!-- Total Modules & Tasks -->
          <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
              <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">সর্বমোট ডেলিভারেবল</span>
              <h3 id="statTotal" class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['total'] ?? 0 }} টি</h3>
              <span class="text-[11px] text-slate-500 font-medium block mt-1">১২টি মূল আর্কিটেকচারাল মডিউল</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
              <i class="fas fa-cubes"></i>
            </div>
          </div>

          <!-- Completed -->
          <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
              <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">কাজ সম্পন্ন (Done)</span>
              <h3 id="statCompleted" class="text-2xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight">{{ $stats['completed'] ?? 0 }} টি</h3>
              <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1 mt-1">
                <i class="fas fa-check-circle text-[10px]"></i> সম্পূর্ণ রেডি ও টেস্টেড
              </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl">
              <i class="fas fa-circle-check"></i>
            </div>
          </div>

          <!-- In Progress -->
          <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
              <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">চলমান কাজ (In Progress)</span>
              <h3 id="statInProgress" class="text-2xl font-black text-amber-600 dark:text-amber-400 tracking-tight">{{ $stats['in_progress'] ?? 0 }} টি</h3>
              <span class="text-[11px] text-amber-600 dark:text-amber-400 font-bold flex items-center gap-1 mt-1">
                <i class="fas fa-spinner fa-spin text-[10px]"></i> অ্যাক্টিভ ডেভেলপমেন্ট ফেজ
              </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl">
              <i class="fas fa-arrows-rotate"></i>
            </div>
          </div>

          <!-- Pending -->
          <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
              <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1">অপেক্ষমাণ (Pending)</span>
              <h3 id="statPending" class="text-2xl font-black text-slate-700 dark:text-slate-300 tracking-tight">{{ $stats['pending'] ?? 0 }} টি</h3>
              <span class="text-[11px] text-slate-400 font-medium block mt-1">পরবর্তী স্প্রিন্টে নির্ধারিত</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center text-xl">
              <i class="fas fa-clock"></i>
            </div>
          </div>
        </div>

        <!-- Overall Progress Percentage Bar Card -->
        <div class="bg-white dark:bg-slate-900 p-5 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs transition-colors">
          <div class="flex items-center justify-between text-xs font-bold mb-2">
            <span class="text-slate-800 dark:text-slate-200">সার্বিক স্কুল ম্যানেজমেন্ট সফটওয়্যার অগ্রগতি (Overall Project Completion)</span>
            <span id="statPercentageLabel" class="text-indigo-600 dark:text-indigo-400 text-base font-black">{{ $stats['percentage'] ?? 0 }}%</span>
          </div>
          <div class="w-full bg-slate-100 dark:bg-slate-800 h-3.5 rounded-full overflow-hidden p-0.5">
            <div id="statProgressBar" class="bg-gradient-to-r from-indigo-500 via-indigo-600 to-emerald-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['percentage'] ?? 0 }}%"></div>
          </div>
          <div class="flex items-center justify-between text-[11px] text-slate-400 dark:text-slate-500 mt-2 font-medium">
            <span>স্ট্যাটাস পরিবর্তন করলে অগ্রগতি এবং মেট্রিক্স স্বয়ংক্রিয়ভাবে আপডেট হবে।</span>
            <span>মোট অনুমিত সময়: <strong class="text-slate-700 dark:text-slate-300 font-mono">{{ $stats['total_days'] ?? 0 }} দিন</strong></span>
          </div>
        </div>

        <!-- Filter & Search Controls -->
        <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-3 transition-colors">
          <div class="flex flex-wrap items-center gap-1.5">
            <button onclick="filterPlanByStatus('all')" id="planFilter-all" class="plan-filter-btn px-3 py-1.5 rounded-xl font-bold text-xs bg-indigo-600 text-white shadow-xs cursor-pointer">
              সকল সাবমডিউল ({{ $stats['total'] ?? 0 }})
            </button>
            <button onclick="filterPlanByStatus('completed')" id="planFilter-completed" class="plan-filter-btn px-3 py-1.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
              সম্পন্ন ({{ $stats['completed'] ?? 0 }})
            </button>
            <button onclick="filterPlanByStatus('in_progress')" id="planFilter-in_progress" class="plan-filter-btn px-3 py-1.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
              চলমান ({{ $stats['in_progress'] ?? 0 }})
            </button>
            <button onclick="filterPlanByStatus('pending')" id="planFilter-pending" class="plan-filter-btn px-3 py-1.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
              অপেক্ষমাণ ({{ $stats['pending'] ?? 0 }})
            </button>
          </div>

          <div class="relative w-full md:w-80">
            <input
              type="text"
              id="planSearchInput"
              onkeyup="searchPlanItems(this.value)"
              placeholder="মডিউল বা সাবমডিউল নাম দিয়ে খুঁজুন..."
              class="w-full text-xs font-medium pl-9 pr-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600"
            />
            <i class="fas fa-search absolute left-3 top-2.5 text-slate-400 text-xs"></i>
          </div>
        </div>

        <!-- Modules List Accordion / Card Table -->
        <div id="planModulesContainer" class="space-y-4">
          @php
            $grouped = isset($details) ? $details->groupBy('module_name') : collect();
          @endphp

          @foreach ($grouped as $modName => $items)
            <div class="plan-module-card bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs overflow-hidden transition-colors" data-module="{{ strtolower($modName) }}">
              
              <!-- Module Header -->
              <div class="px-5 py-4 bg-slate-50/80 dark:bg-slate-800/40 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                  <span class="px-2.5 py-1 rounded-lg bg-indigo-600 text-white font-mono text-[11px] font-bold shadow-xs">
                    {{ $items->first()->module_code }}
                  </span>
                  <div>
                    <h3 class="font-black text-slate-900 dark:text-white text-sm">
                      {{ $modName }}
                      @if ($items->first()->module_name_bn)
                        <span class="text-slate-400 font-normal text-xs ml-1">({{ $items->first()->module_name_bn }})</span>
                      @endif
                    </h3>
                  </div>
                </div>

                <div class="flex items-center gap-3">
                  <span class="text-xs font-bold text-slate-500 dark:text-slate-400">
                    <span class="mod-completed-count">{{ $items->where('status', 'completed')->count() }}</span>/{{ $items->count() }} সম্পন্ন
                  </span>
                </div>
              </div>

              <!-- Submodules Table -->
              <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                  <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-800 text-slate-400 dark:text-slate-500 font-bold uppercase text-[10px] tracking-wider bg-white dark:bg-slate-900">
                      <th class="py-2.5 px-4 w-12 text-center">#</th>
                      <th class="py-2.5 px-4">সাবমডিউল ও স্কোপ বিবরণ</th>
                      <th class="py-2.5 px-3 w-20 text-center">অগ্রাধিকার</th>
                      <th class="py-2.5 px-3 w-32 text-center">অগ্রগতি %</th>
                      <th class="py-2.5 px-4 w-44 text-right">স্ট্যাটাস আপডেট করুন</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium">
                    @foreach ($items as $detail)
                      <tr id="planRow-{{ $detail->id }}" class="plan-submodule-row hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition" data-status="{{ $detail->status }}" data-text="{{ strtolower($detail->submodule_name.' '.$detail->submodule_name_bn.' '.$detail->description) }}">
                        <td class="py-3 px-4 font-mono font-bold text-slate-400 text-center text-xs">
                          {{ $loop->iteration }}
                        </td>
                        <td class="py-3 px-4">
                          <div class="flex items-start gap-2">
                            <span id="rowStatusIcon-{{ $detail->id }}" class="mt-0.5 text-xs">
                              @if ($detail->status === 'completed')
                                <i class="fas fa-circle-check text-emerald-500"></i>
                              @elseif ($detail->status === 'in_progress')
                                <i class="fas fa-arrows-rotate text-amber-500 animate-spin"></i>
                              @else
                                <i class="fas fa-clock text-slate-400"></i>
                              @endif
                            </span>
                            <div>
                              <span class="font-bold text-slate-900 dark:text-white block leading-snug">
                                {{ $detail->submodule_name }}
                              </span>
                              @if ($detail->submodule_name_bn)
                                <span class="text-xs text-indigo-600 dark:text-indigo-400 block font-normal">{{ $detail->submodule_name_bn }}</span>
                              @endif
                              @if ($detail->description)
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 leading-snug">{{ $detail->description }}</p>
                              @endif
                              @if ($detail->notes)
                                <span class="text-[10px] text-amber-600 dark:text-amber-400 mt-1 inline-block"><i class="fas fa-circle-info mr-1"></i>{{ $detail->notes }}</span>
                              @endif
                            </div>
                          </div>
                        </td>
                        <td class="py-3 px-3 text-center">
                          @if ($detail->priority === 'high')
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 dark:bg-rose-950/70 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-900/50">High</span>
                          @elseif ($detail->priority === 'medium')
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-100 dark:bg-sky-950/70 text-sky-800 dark:text-sky-300 border border-sky-200 dark:border-sky-900/50">Medium</span>
                          @else
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">Low</span>
                          @endif
                        </td>
                        <td class="py-3 px-3 text-center">
                          <div class="flex items-center gap-2 justify-center">
                            <div class="w-16 bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                              <div id="rowProgressFill-{{ $detail->id }}" class="h-2 rounded-full transition-all duration-300 {{ $detail->status === 'completed' ? 'bg-emerald-500' : ($detail->status === 'in_progress' ? 'bg-amber-500' : 'bg-slate-300 dark:bg-slate-700') }}" style="width: {{ $detail->progress_percentage }}%"></div>
                            </div>
                            <span id="rowProgressText-{{ $detail->id }}" class="font-mono text-xs font-bold text-slate-700 dark:text-slate-300 w-8 text-right">{{ $detail->progress_percentage }}%</span>
                          </div>
                        </td>
                        <td class="py-3 px-4 text-right">
                          <select
                            onchange="updatePlanStatus({{ $detail->id }}, this.value)"
                            class="text-xs font-bold px-2.5 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-100 outline-none focus:border-indigo-600 cursor-pointer shadow-xs"
                          >
                            <option value="completed" {{ $detail->status === 'completed' ? 'selected' : '' }}>✅ সম্পন্ন (Completed)</option>
                            <option value="in_progress" {{ $detail->status === 'in_progress' ? 'selected' : '' }}>⚡ চলমান (In Progress)</option>
                            <option value="pending" {{ $detail->status === 'pending' ? 'selected' : '' }}>⏳ অপেক্ষমাণ (Pending)</option>
                          </select>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          @endforeach
        </div>

      </div>
      <!-- End of Project Plan Tab Content -->

    </main>

  </div>

  <!-- Modal 1: New Student Admission Modal -->
  <div id="studentModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 overflow-hidden">
      <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
        <div>
          <h4 class="font-black text-sm flex items-center gap-2">
            <i class="fas fa-user-plus text-indigo-400"></i>
            <span data-i18n="modal_student_title">নতুন শিক্ষার্থী ভর্তি এন্ট্রি</span>
          </h4>
          <p data-i18n="modal_student_sub" class="text-[11px] text-slate-400">বিদ্যালয়ের নতুন শিক্ষার্থীর তথ্য ডাটাবেজে সংরক্ষণ করুন</p>
        </div>
        <button onclick="closeStudentModal()" class="w-7 h-7 rounded-full bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-300 cursor-pointer">
          <i class="fas fa-times text-xs"></i>
        </button>
      </div>

      <form onsubmit="handleStudentSubmit(event)" class="p-6 space-y-3.5">
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">শিক্ষার্থীর পূর্ণ নাম *</label>
            <input type="text" id="m_studentName" required placeholder="e.g. সাদিয়া ইসলাম" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">শ্রেণি (Class) *</label>
            <select id="m_studentClass" class="w-full text-xs font-bold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600">
              <option value="Class 10">দশম শ্রেণি (Class 10)</option>
              <option value="Class 9">নবম শ্রেণি (Class 9)</option>
              <option value="Class 8">অষ্টম শ্রেণি (Class 8)</option>
              <option value="Class 7">সপ্তম শ্রেণি (Class 7)</option>
              <option value="Class 6">ষষ্ঠ শ্রেণি (Class 6)</option>
              <option value="Class 5">পঞ্চম শ্রেণি (Class 5)</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">শাখা / সেকশন *</label>
            <select id="m_studentSection" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600">
              <option value="শাখা: ক">শাখা: ক (Section A)</option>
              <option value="শাখা: খ">শাখা: খ (Section B)</option>
              <option value="শাখা: গ">শাখা: গ (Section C)</option>
            </select>
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">রোল নম্বর *</label>
            <input type="number" id="m_studentRoll" required placeholder="e.g. 15" class="w-full text-xs font-bold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
          </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">অভিভাবকের নাম *</label>
            <input type="text" id="m_studentGuardian" required placeholder="পিতা / মাতার নাম" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">যোগাযোগ মোবাইল নম্বর *</label>
            <input type="tel" id="m_studentPhone" required placeholder="017xxxxxxxx" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
          </div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
          <button type="button" onclick="closeStudentModal()" class="px-4 py-2 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl cursor-pointer">
            <span data-i18n="btn_cancel">বাতিল</span>
          </button>
          <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-md shadow-indigo-200 dark:shadow-indigo-950 cursor-pointer">
            <i class="fas fa-check mr-1"></i> <span data-i18n="btn_save">সংরক্ষণ করুন</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal 2: Fee Receipt Collection Modal -->
  <div id="feeModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl max-w-md w-full border border-slate-200 dark:border-slate-800 overflow-hidden">
      <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
        <div>
          <h4 class="font-black text-sm flex items-center gap-2">
            <i class="fas fa-receipt text-amber-400"></i>
            <span data-i18n="modal_fee_title">ফি রিসিট সংগ্রহ ও এন্ট্রি</span>
          </h4>
          <p data-i18n="modal_fee_sub" class="text-[11px] text-slate-400">শিক্ষার্থীর মাসিক ফি বা ভর্তি ফি জমা গ্রহণ করুন</p>
        </div>
        <button onclick="closeFeeModal()" class="w-7 h-7 rounded-full bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-300 cursor-pointer">
          <i class="fas fa-times text-xs"></i>
        </button>
      </div>

      <form onsubmit="handleFeeSubmit(event)" class="p-6 space-y-3.5">
        <div>
          <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">শিক্ষার্থীর রোল বা আইডি *</label>
          <input type="text" id="f_studentId" required placeholder="e.g. 1001" class="w-full text-xs font-bold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">ফি-এর ধরন *</label>
            <select class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600">
              <option value="Monthly Tuition">মাসিক টিউশন ফি</option>
              <option value="Exam Fee">পরীক্ষার ফি</option>
              <option value="Admission Fee">ভর্তি ফি</option>
              <option value="Session Charge">সেশন চার্জ</option>
            </select>
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">টাকার পরিমাণ (BDT) *</label>
            <input type="number" required placeholder="e.g. 1500" class="w-full text-xs font-bold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600 text-indigo-700 dark:text-indigo-400" />
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">পেমেন্ট মেথড</label>
          <select class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600">
            <option value="Cash">নগদ গ্রহণ (Cash)</option>
            <option value="bKash">বিকাশ (bKash)</option>
            <option value="Nagad">নগদ এমএফএস (Nagad)</option>
            <option value="Bank">ব্যাংক ডিপোজিট</option>
          </select>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
          <button type="button" onclick="closeFeeModal()" class="px-4 py-2 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl cursor-pointer">
            <span data-i18n="btn_cancel">বাতিল</span>
          </button>
          <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-amber-600 hover:bg-amber-700 rounded-xl shadow-md shadow-amber-200 dark:shadow-amber-950 cursor-pointer">
            <i class="fas fa-check mr-1"></i> <span data-i18n="btn_save">সংরক্ষণ করুন</span>
          </button>
        </div>
      </form>
    </div>
  <!-- Modal 3: Add New Plan Submodule Task Modal -->
  <div id="addTaskModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl max-w-lg w-full border border-slate-200 dark:border-slate-800 overflow-hidden">
      <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
        <div>
          <h4 class="font-black text-sm flex items-center gap-2">
            <i class="fas fa-list-check text-indigo-400"></i>
            <span>নতুন প্রজেক্ট প্ল্যান টাস্ক / সাবমডিউল যুক্ত করুন</span>
          </h4>
          <p class="text-[11px] text-slate-400">স্কুল ম্যানেজমেন্ট প্ল্যাটফর্মে নতুন ফিচার বা ডেলিভারেবল যুক্ত করুন</p>
        </div>
        <button onclick="closeAddTaskModal()" class="w-7 h-7 rounded-full bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-300 cursor-pointer">
          <i class="fas fa-times text-xs"></i>
        </button>
      </div>

      <form onsubmit="handleAddTaskSubmit(event)" class="p-6 space-y-3.5">
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">মডিউল সিলেক্ট করুন *</label>
            <select id="m_planModule" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600">
              <option value="MOD-01|Authentication & Access Control (RBAC)|অথেনটিকেশন ও পারমিশন সিস্টেম">MOD-01: Authentication & Access Control (RBAC)</option>
              <option value="MOD-02|Student Information System (SIS)|শিক্ষার্থী তথ্য ও ভর্তি ব্যবস্থাপনা">MOD-02: Student Information System (SIS)</option>
              <option value="MOD-03|Academic & Classroom Architecture|শ্রেণি, সেকশন ও রুটিন ব্যবস্থাপনা">MOD-03: Academic & Classroom Architecture</option>
              <option value="MOD-04|Attendance Management & Biometrics|উপস্থিতি ও বায়োমেট্রিক ট্র্যাকিং">MOD-04: Attendance Management & Biometrics</option>
              <option value="MOD-05|Fee Management & Accounts Ledger|ফি কালেকশন ও হিসাবরক্ষণ শাখা">MOD-05: Fee Management & Accounts Ledger</option>
              <option value="MOD-06|Examinations, Grading & Report Cards|পরীক্ষা ও ফলাফল মূল্যায়ন">MOD-06: Examinations, Grading & Report Cards</option>
              <option value="MOD-07|Teachers & Human Resources (HR)|শিক্ষক ও কর্মচারী ব্যবস্থাপনা">MOD-07: Teachers & Human Resources (HR)</option>
              <option value="MOD-08|Notice Board & Multi-channel Alerts|ডিজিটাল নোটিশ ও এসএমএস অ্যালার্ট">MOD-08: Notice Board & Multi-channel Alerts</option>
              <option value="MOD-09|Parent & Student Self-service Portal|অভিভাবক ও শিক্ষার্থী পোর্টাল">MOD-09: Parent & Student Self-service Portal</option>
              <option value="MOD-10|Library Management System|লাইব্রেরি ও বই ট্র্যাকিং সিস্টেম">MOD-10: Library Management System</option>
              <option value="MOD-11|Hostel & Transport Fleet Management|হোস্টেল ও বাস পরিবহন সিস্টেম">MOD-11: Hostel & Transport Fleet Management</option>
              <option value="MOD-12|System Settings, Security & Audit Logs|সিস্টেম সেটিংস ও সিকিউরিটি অডিট">MOD-12: System Settings, Security & Audit Logs</option>
            </select>
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">অগ্রাধিকার (Priority) *</label>
            <select id="m_planPriority" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600">
              <option value="high">High (জরুরি)</option>
              <option value="medium">Medium (সাধারণ)</option>
              <option value="low">Low (কম গুরুত্বপূর্ণ)</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">সাবমডিউল নাম (English) *</label>
          <input type="text" id="m_planSubmoduleName" required placeholder="e.g. Automated Student ID Card with QR" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
        </div>

        <div>
          <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">সাবমডিউল নাম (বাংলা)</label>
          <input type="text" id="m_planSubmoduleNameBn" placeholder="e.g. কিউআর কোডসহ স্বয়ংক্রিয় স্টুডেন্ট আইডি কার্ড" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">বর্তমান স্ট্যাটাস *</label>
            <select id="m_planStatus" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600">
              <option value="pending">অপেক্ষমাণ (Pending)</option>
              <option value="in_progress">চলমান (In Progress)</option>
              <option value="completed">সম্পন্ন (Completed)</option>
            </select>
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">অনুমিত কর্মদিবস (Days)</label>
            <input type="number" id="m_planDays" min="1" placeholder="e.g. 3" class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600" />
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">স্কোপ বা কাজের বিবরণ (Description)</label>
          <textarea id="m_planDescription" rows="2" placeholder="এই সাবমডিউলে কী কী কাজ করতে হবে তার সারসংক্ষেপ..." class="w-full text-xs font-semibold px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600"></textarea>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
          <button type="button" onclick="closeAddTaskModal()" class="px-4 py-2 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl cursor-pointer">
            বাতিল
          </button>
          <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-md shadow-indigo-200 dark:shadow-indigo-950 cursor-pointer">
            <i class="fas fa-check mr-1"></i> টাস্ক যোগ করুন
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Floating Toast Notification -->
  <div id="planToast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none flex items-center gap-2.5 px-4 py-3 rounded-2xl bg-slate-900 text-white shadow-2xl border border-slate-700 text-xs font-bold">
    <i class="fas fa-circle-check text-emerald-400 text-sm"></i>
    <span id="planToastMsg">স্ট্যাটাস সফলভাবে আপডেট হয়েছে!</span>
  </div>

  <!-- Interactive Client Script: i18n & Dark Theme & UI Actions -->
  <script>
    // ----------------- i18n Dictionary -----------------
    const I18N = {
      bn: {
        brand_title: "SCHOOL MANAGEMENT HQ",
        brand_sub: "স্মার্ট ডিজিটাল স্কুল ও অ্যাকাডেমিক ম্যানেজমেন্ট পোর্টাল",
        badge_admin: "SUPER ADMIN HQ",
        btn_new_student: "নতুন শিক্ষার্থী ভর্তি",
        btn_logout: "লগআউট",
        modules_title: "অ্যাডমিন মডিউল সমূহ",
        tab_overview: "ড্যাশবোর্ড ওভারভিউ",
        tab_students: "শিক্ষার্থী ও অভিভাবক",
        tab_teachers: "শিক্ষক ও কর্মকর্তা",
        tab_attendance: "ক্লাস ও উপস্থিতি",
        tab_finance: "ফি ও অ্যাকাউন্টস",
        tab_exams: "পরীক্ষা ও ফলাফল",
        tab_project_plan: "প্রজেক্ট প্ল্যান ও রোডম্যাপ",
        class_filter_title: "শ্রেণি অনুযায়ী ফিল্টার:",
        class_all: "সকল শ্রেণি (All Classes)",
        class_10: "দশম শ্রেণি (Class 10)",
        class_9: "নবম শ্রেণি (Class 9)",
        class_8: "অষ্টম শ্রেণি (Class 8)",
        class_7: "সপ্তম শ্রেণি (Class 7)",
        class_6: "ষষ্ঠ শ্রেণি (Class 6)",
        class_primary: "প্রাথমিক শাখা (Class 1-5)",
        metric_students_title: "মোট শিক্ষার্থী",
        metric_students_val: "১,৪৫০ জন",
        metric_students_sub: "+২৫ জন চলতি মাসে",
        metric_teachers_title: "শিক্ষক ও স্টাফ",
        metric_teachers_val: "৪৮ জন",
        metric_teachers_sub: "সকল শিক্ষক উপস্থিত",
        metric_att_title: "আজকের উপস্থিতি",
        metric_att_val: "৯৬.৫%",
        metric_att_sub: "১,৩৯৯ জন উপস্থিত",
        metric_fee_title: "চলতি মাসের ফি আদায়",
        metric_fee_val: "৳ ৫,৮২,০০০",
        metric_fee_sub: "৮৫% ফি কালেকশন সম্পন্ন",
        search_placeholder: "শিক্ষার্থীর নাম, রোল বা আইডি দিয়ে খুঁজুন...",
        filter_label_prefix: "ফিল্টার: ",
        filter_all_label: "ফিল্টার: সকল শ্রেণি",
        btn_admission_entry: "নতুন ভর্তি এন্ট্রি",
        btn_fee_entry: "ফি রিসিট সংগ্রহ",
        table_title: "শিক্ষার্থী তালিকা ও ভর্তি তথ্য (Student Directory)",
        table_sub: "অ্যাকাডেমিক রেকর্ডের দ্রুত সারসংক্ষেপ",
        total_students_label: "মোট শিক্ষার্থী: ",
        th_roll: "রোল / আইডি",
        th_name: "শিক্ষার্থীর নাম",
        th_class: "শ্রেণি ও শাখা",
        th_guardian: "অভিভাবক ও মোবাইল",
        th_fee_status: "ফি স্ট্যাটাস",
        th_action: "অ্যাকশন",
        status_paid: "পেইড (Paid)",
        status_due: "বকেয়া (Due)",
        btn_details: "বিস্তারিত",
        att_progress_title: "আজকের শ্রেণিভিত্তিক উপস্থিতি",
        notice_board_title: "অ্যাকাডেমিক নোটিশ বোর্ড",
        all_notices: "সব নোটিশ",
        pagination_showing: "দেখানো হচ্ছে ১ থেকে ৫ (সর্বমোট ১,৪৫০ জন শিক্ষার্থী)",
        btn_prev: "পূর্ববর্তী",
        btn_next: "পরবর্তী",
        modal_student_title: "নতুন শিক্ষার্থী ভর্তি এন্ট্রি",
        modal_student_sub: "বিদ্যালয়ের নতুন শিক্ষার্থীর তথ্য ডাটাবেজে সংরক্ষণ করুন",
        modal_fee_title: "ফি রিসিট সংগ্রহ ও এন্ট্রি",
        modal_fee_sub: "শিক্ষার্থীর মাসিক ফি বা ভর্তি ফি জমা গ্রহণ করুন",
        btn_cancel: "বাতিল",
        btn_save: "সংরক্ষণ করুন",
        badge_new: "অডিট"
      },
      en: {
        brand_title: "SCHOOL MANAGEMENT HQ",
        brand_sub: "Smart Digital School & Academic Administration Portal",
        badge_admin: "SUPER ADMIN HQ",
        btn_new_student: "New Student Admission",
        btn_logout: "Sign Out",
        modules_title: "ADMIN MODULES",
        tab_overview: "Dashboard Overview",
        tab_students: "Students & Guardians",
        tab_teachers: "Teachers & Staff",
        tab_attendance: "Classes & Attendance",
        tab_finance: "Fees & Accounts",
        tab_exams: "Exams & Results",
        tab_project_plan: "Project Plan & Roadmap",
        class_filter_title: "FILTER BY CLASS:",
        class_all: "All Classes",
        class_10: "Class 10 (Tenth Grade)",
        class_9: "Class 9 (Ninth Grade)",
        class_8: "Class 8 (Eighth Grade)",
        class_7: "Class 7 (Seventh Grade)",
        class_6: "Class 6 (Sixth Grade)",
        class_primary: "Primary Section (Class 1-5)",
        metric_students_title: "Total Students",
        metric_students_val: "1,450",
        metric_students_sub: "+25 enrolled this month",
        metric_teachers_title: "Teachers & Staff",
        metric_teachers_val: "48",
        metric_teachers_sub: "All teachers present",
        metric_att_title: "Today's Attendance",
        metric_att_val: "96.5%",
        metric_att_sub: "1,399 students present",
        metric_fee_title: "Monthly Fee Collection",
        metric_fee_val: "৳ 582,000",
        metric_fee_sub: "85% fees collected",
        search_placeholder: "Search by student name, roll or ID...",
        filter_label_prefix: "Filter: ",
        filter_all_label: "Filter: All Classes",
        btn_admission_entry: "New Admission Entry",
        btn_fee_entry: "Collect Fee Receipt",
        table_title: "Student Directory & Admissions",
        table_sub: "Quick summary of academic records",
        total_students_label: "Total Students: ",
        th_roll: "Roll / ID",
        th_name: "Student Name",
        th_class: "Class & Section",
        th_guardian: "Guardian & Phone",
        th_fee_status: "Fee Status",
        th_action: "Action",
        status_paid: "Paid",
        status_due: "Due",
        btn_details: "Details",
        att_progress_title: "Today's Class Attendance Breakdown",
        notice_board_title: "Academic Notice Board",
        all_notices: "All Notices",
        pagination_showing: "Showing 1 to 5 of 1,450 students",
        btn_prev: "Previous",
        btn_next: "Next",
        modal_student_title: "New Student Admission Entry",
        modal_student_sub: "Save student information to the institutional database",
        modal_fee_title: "Collect Fee Receipt Entry",
        modal_fee_sub: "Record student tuition fee or admission payments",
        btn_cancel: "Cancel",
        btn_save: "Save Information",
        badge_new: "Audit"
      }
    };

    let currentLang = localStorage.getItem('app_lang') || 'bn';

    function applyLanguage(lang) {
      currentLang = lang;
      localStorage.setItem('app_lang', lang);
      const dict = I18N[lang];

      // Update text in elements with data-i18n
      document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (dict[key]) {
          el.textContent = dict[key];
        }
      });

      // Update search input placeholder
      const searchInput = document.getElementById('studentSearchInput');
      if (searchInput && dict.search_placeholder) {
        searchInput.placeholder = dict.search_placeholder;
      }

      // Update language toggle button label
      const langBtnText = document.getElementById('langBtnText');
      if (langBtnText) {
        langBtnText.textContent = (lang === 'bn') ? 'English' : 'বাংলা';
      }

      // Update filter badge if default
      const filterBadge = document.getElementById('activeFilterBadge');
      if (filterBadge && (filterBadge.textContent.includes('সকল') || filterBadge.textContent.includes('All'))) {
        filterBadge.textContent = dict.filter_all_label;
      }

      // Update theme toggle button label
      const isDark = document.documentElement.classList.contains('dark');
      const themeLabelText = document.getElementById('themeLabelText');
      if (themeLabelText) {
        if (isDark) {
          themeLabelText.textContent = (lang === 'bn') ? 'লাইট মোড' : 'Light';
        } else {
          themeLabelText.textContent = (lang === 'bn') ? 'ডার্ক মোড' : 'Dark';
        }
      }
    }

    function toggleLanguage() {
      const newLang = (currentLang === 'bn') ? 'en' : 'bn';
      applyLanguage(newLang);
    }

    // ----------------- Dark / Light Theme -----------------
    function applyTheme(theme) {
      const icon = document.getElementById('themeIcon');
      const text = document.getElementById('themeLabelText');
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        localStorage.setItem('app_theme', 'dark');
        if (icon) {
          icon.className = "fas fa-sun text-amber-400 text-sm";
        }
        if (text) {
          text.textContent = (currentLang === 'bn') ? 'লাইট মোড' : 'Light';
        }
      } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('app_theme', 'light');
        if (icon) {
          icon.className = "fas fa-moon text-indigo-600 text-sm";
        }
        if (text) {
          text.textContent = (currentLang === 'bn') ? 'ডার্ক মোড' : 'Dark';
        }
      }
    }

    function toggleTheme() {
      const isDark = document.documentElement.classList.contains('dark');
      applyTheme(isDark ? 'light' : 'dark');
    }

    // ----------------- Modals & Form Actions -----------------
    function openStudentModal() {
      document.getElementById('studentModal').classList.remove('hidden');
    }

    function closeStudentModal() {
      document.getElementById('studentModal').classList.add('hidden');
    }

    function openFeeModal() {
      document.getElementById('feeModal').classList.remove('hidden');
    }

    function closeFeeModal() {
      document.getElementById('feeModal').classList.add('hidden');
    }

    function handleStudentSubmit(e) {
      e.preventDefault();
      const name = document.getElementById('m_studentName').value;
      const sClass = document.getElementById('m_studentClass').value;
      const roll = document.getElementById('m_studentRoll').value;
      const guardian = document.getElementById('m_studentGuardian').value;
      const phone = document.getElementById('m_studentPhone').value;

      const tbody = document.getElementById('studentTableBody');
      const tr = document.createElement('tr');
      tr.className = "hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition bg-emerald-50/50 dark:bg-emerald-950/30";
      tr.innerHTML = `
        <td class="py-3 px-3 font-mono font-bold text-indigo-600 dark:text-indigo-400">#${roll}</td>
        <td class="py-3 px-3">
          <div class="flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 flex items-center justify-center font-bold text-[11px]">
              ${name.charAt(0)}
            </div>
            <div>
              <span class="font-bold text-slate-900 dark:text-white block">${name}</span>
              <span class="text-[10px] text-slate-400 dark:text-slate-500">new@student.edu</span>
            </div>
          </div>
        </td>
        <td class="py-3 px-3">
          <span class="font-bold text-slate-800 dark:text-slate-200">${sClass}</span>
          <span class="text-[10px] text-slate-400 dark:text-slate-500 block">Section A</span>
        </td>
        <td class="py-3 px-3">
          <span class="block font-medium">${guardian}</span>
          <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500">${phone}</span>
        </td>
        <td class="py-3 px-3 text-center">
          <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/50">
            ${currentLang === 'bn' ? 'পেইড (Paid)' : 'Paid'}
          </span>
        </td>
        <td class="py-3 px-3 text-right">
          <button class="px-2.5 py-1 text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 rounded-lg transition font-bold text-xs cursor-pointer">
            ${currentLang === 'bn' ? 'বিস্তারিত' : 'Details'}
          </button>
        </td>
      `;
      tbody.prepend(tr);
      closeStudentModal();
      alert(currentLang === 'bn' ? `শিক্ষার্থী "${name}" সফলভাবে যুক্ত হয়েছে!` : `Student "${name}" successfully registered!`);
    }

    function handleFeeSubmit(e) {
      e.preventDefault();
      closeFeeModal();
      alert(currentLang === 'bn' ? 'ফি রিসিট সফলভাবে সংরক্ষণ করা হয়েছে!' : 'Fee receipt saved successfully!');
    }

    function toggleMobileMenu() {
      const drawer = document.getElementById('mobileDrawer');
      if (drawer) {
        drawer.classList.toggle('hidden');
      }
    }

    function switchTab(tab) {
      const tabs = ['overview', 'students', 'teachers', 'attendance', 'finance', 'exams', 'project_plan'];
      tabs.forEach(t => {
        ['btn-tab-', 'm-btn-tab-'].forEach(prefix => {
          const btn = document.getElementById(`${prefix}${t}`);
          if (btn) {
            if (t === tab) {
              btn.className = "w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-xs bg-indigo-600 text-white shadow-md shadow-indigo-200 dark:shadow-indigo-950 transition cursor-pointer";
            } else {
              btn.className = "w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer";
            }
          }
        });
      });

      // Toggle tab content visibility
      const panes = document.querySelectorAll('.tab-pane');
      panes.forEach(p => p.classList.add('hidden'));

      const targetPane = document.getElementById(`tabContent-${tab}`);
      if (targetPane) {
        targetPane.classList.remove('hidden');
      } else {
        const overviewPane = document.getElementById('tabContent-overview');
        if (overviewPane) overviewPane.classList.remove('hidden');
      }
    }

    // ----------------- Project Plan Interactive Logic -----------------
    function openAddTaskModal() {
      document.getElementById('addTaskModal').classList.remove('hidden');
    }

    function closeAddTaskModal() {
      document.getElementById('addTaskModal').classList.add('hidden');
    }

    function showToast(msg) {
      const toast = document.getElementById('planToast');
      const msgEl = document.getElementById('planToastMsg');
      if (toast && msgEl) {
        msgEl.textContent = msg;
        toast.classList.remove('translate-y-20', 'opacity-0');
        setTimeout(() => {
          toast.classList.add('translate-y-20', 'opacity-0');
        }, 3000);
      }
    }

    function updatePlanStatus(detailId, newStatus) {
      const row = document.getElementById(`planRow-${detailId}`);
      const icon = document.getElementById(`rowStatusIcon-${detailId}`);
      const progressFill = document.getElementById(`rowProgressFill-${detailId}`);
      const progressText = document.getElementById(`rowProgressText-${detailId}`);

      // Optimistic update
      if (row) row.setAttribute('data-status', newStatus);
      if (icon) {
        if (newStatus === 'completed') {
          icon.innerHTML = '<i class="fas fa-circle-check text-emerald-500"></i>';
        } else if (newStatus === 'in_progress') {
          icon.innerHTML = '<i class="fas fa-arrows-rotate text-amber-500 animate-spin"></i>';
        } else {
          icon.innerHTML = '<i class="fas fa-clock text-slate-400"></i>';
        }
      }

      if (progressFill && progressText) {
        let p = (newStatus === 'completed') ? 100 : ((newStatus === 'in_progress') ? 50 : 0);
        progressFill.style.width = p + '%';
        progressText.textContent = p + '%';
        progressFill.className = 'h-2 rounded-full transition-all duration-300 ' + 
          (newStatus === 'completed' ? 'bg-emerald-500' : (newStatus === 'in_progress' ? 'bg-amber-500' : 'bg-slate-300 dark:bg-slate-700'));
      }

      // Backend sync via AJAX
      fetch(`/project-plan/details/${detailId}/status`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ status: newStatus })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success && data.stats) {
          const s = data.stats;
          const statTotal = document.getElementById('statTotal');
          const statCompleted = document.getElementById('statCompleted');
          const statInProgress = document.getElementById('statInProgress');
          const statPending = document.getElementById('statPending');
          const statPctLabel = document.getElementById('statPercentageLabel');
          const statBar = document.getElementById('statProgressBar');
          const badge1 = document.getElementById('planPercentageBadge');
          const badge2 = document.getElementById('m_planPercentageBadge');

          if (statTotal) statTotal.textContent = s.total + ' টি';
          if (statCompleted) statCompleted.textContent = s.completed + ' টি';
          if (statInProgress) statInProgress.textContent = s.in_progress + ' টি';
          if (statPending) statPending.textContent = s.pending + ' টি';
          if (statPctLabel) statPctLabel.textContent = s.percentage + '%';
          if (statBar) statBar.style.width = s.percentage + '%';
          if (badge1) badge1.textContent = s.percentage + '%';
          if (badge2) badge2.textContent = s.percentage + '%';

          showToast(currentLang === 'bn' ? 'স্ট্যাটাস সফলভাবে আপডেট করা হয়েছে!' : 'Status updated successfully!');
        }
      })
      .catch(err => {
        console.error('Failed to sync plan status:', err);
      });
    }

    function handleAddTaskSubmit(e) {
      e.preventDefault();
      const moduleVal = document.getElementById('m_planModule').value.split('|');
      const moduleCode = moduleVal[0];
      const moduleName = moduleVal[1];
      const moduleNameBn = moduleVal[2];

      const payload = {
        module_code: moduleCode,
        module_name: moduleName,
        module_name_bn: moduleNameBn,
        priority: document.getElementById('m_planPriority').value,
        submodule_name: document.getElementById('m_planSubmoduleName').value,
        submodule_name_bn: document.getElementById('m_planSubmoduleNameBn').value,
        status: document.getElementById('m_planStatus').value,
        estimated_days: document.getElementById('m_planDays').value || null,
        description: document.getElementById('m_planDescription').value,
      };

      fetch('{{ route("project-plan.details.store") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      })
      .then(res => res.json())
      .then(data => {
        closeAddTaskModal();
        showToast(currentLang === 'bn' ? 'নতুন টাস্ক সফলভাবে তৈরি হয়েছে!' : 'New task added successfully!');
        setTimeout(() => {
          window.location.reload();
        }, 800);
      })
      .catch(err => {
        console.error('Error creating task:', err);
      });
    }

    function filterPlanByStatus(status) {
      document.querySelectorAll('.plan-filter-btn').forEach(btn => {
        btn.className = "plan-filter-btn px-3 py-1.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer";
      });
      const activeBtn = document.getElementById(`planFilter-${status}`);
      if (activeBtn) {
        activeBtn.className = "plan-filter-btn px-3 py-1.5 rounded-xl font-bold text-xs bg-indigo-600 text-white shadow-xs cursor-pointer";
      }

      const rows = document.querySelectorAll('.plan-submodule-row');
      rows.forEach(r => {
        if (status === 'all' || r.getAttribute('data-status') === status) {
          r.style.display = "";
        } else {
          r.style.display = "none";
        }
      });
    }

    function searchPlanItems(query) {
      const q = query.toLowerCase().trim();
      const rows = document.querySelectorAll('.plan-submodule-row');
      rows.forEach(r => {
        const text = r.getAttribute('data-text') || '';
        if (text.includes(q)) {
          r.style.display = "";
        } else {
          r.style.display = "none";
        }
      });
    }

    function filterClass(className) {
      const dict = I18N[currentLang];
      const badge = document.getElementById('activeFilterBadge');
      if (badge) {
        if (className === 'all') {
          badge.textContent = dict.filter_all_label;
        } else {
          badge.textContent = `${dict.filter_label_prefix}${className}`;
        }
      }
    }

    function searchStudents(query) {
      const rows = document.querySelectorAll('#studentTableBody tr');
      const q = query.toLowerCase();
      rows.forEach(r => {
        const text = r.textContent.toLowerCase();
        if (text.includes(q)) {
          r.style.display = "";
        } else {
          r.style.display = "none";
        }
      });
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
