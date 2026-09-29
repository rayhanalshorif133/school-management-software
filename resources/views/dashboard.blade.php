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
<body class="bg-slate-100/90 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased min-h-screen flex flex-col transition-colors duration-200">

  <!-- Top Navigation Bar -->
  <header class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 sticky top-0 z-30 shadow-xs transition-colors duration-200">
    <div class="px-4 sm:px-6 py-3 flex items-center justify-between gap-4">

      <!-- Brand Logo -->
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-200 dark:shadow-indigo-950 text-lg">
          <i class="fas fa-school"></i>
        </div>
        <div>
          <h1 class="font-black text-slate-900 dark:text-white text-base leading-tight tracking-tight flex items-center gap-2">
            <span data-i18n="brand_title">SCHOOL MANAGEMENT HQ</span>
            <span class="text-[10px] bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-bold px-2 py-0.5 rounded-full border border-indigo-200 dark:border-indigo-800">Super Admin</span>
          </h1>
          <p data-i18n="brand_sub" class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">স্মার্ট ডিজিটাল স্কুল ও অ্যাকাডেমিক ম্যানেজমেন্ট পোর্টাল</p>
        </div>
      </div>

      <!-- Controls, User Profile & Actions -->
      <div class="flex items-center gap-2.5 sm:gap-3">

        <!-- Language Switcher Toggle Button (Bangla <-> English) -->
        <button
          id="langToggleBtn"
          onclick="toggleLanguage()"
          class="px-2.5 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs"
          title="Switch Language (English / বাংলা)"
        >
          <i class="fas fa-globe text-indigo-500"></i>
          <span id="langBtnText">English</span>
        </button>

        <!-- Dark / Light Mode Toggle Button -->
        <button
          id="themeToggleBtn"
          onclick="toggleTheme()"
          class="w-8.5 h-8.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-amber-400 text-xs font-bold transition flex items-center justify-center cursor-pointer shadow-xs"
          title="Toggle Dark / Light Mode"
        >
          <i id="themeIcon" class="fas fa-moon text-indigo-600 dark:text-amber-400 text-sm"></i>
        </button>

        <!-- Quick Action Badge -->
        <button
          onclick="openStudentModal()"
          class="hidden md:flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 dark:bg-indigo-950/60 hover:bg-indigo-100 dark:hover:bg-indigo-900/60 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 rounded-xl text-xs font-bold transition cursor-pointer"
        >
          <i class="fas fa-plus-circle text-indigo-600 dark:text-indigo-400"></i>
          <span data-i18n="btn_new_student">নতুন শিক্ষার্থী ভর্তি</span>
        </button>

        <!-- Admin Live Status Badge -->
        <div class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
          <span data-i18n="badge_admin">SUPER ADMIN HQ</span>
        </div>

        <!-- User Info -->
        <div class="flex items-center gap-2 pl-2 border-l border-slate-200 dark:border-slate-700">
          <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs shadow-xs">
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
            class="px-2.5 sm:px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-rose-300 dark:hover:border-rose-800 text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition flex items-center gap-1.5 text-xs font-bold cursor-pointer"
          >
            <i class="fas fa-right-from-bracket"></i>
            <span data-i18n="btn_logout">লগআউট</span>
          </button>
        </form>

      </div>
    </div>
  </header>

  <!-- Main Container -->
  <div class="flex-1 flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="hidden lg:flex flex-col w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-4 shrink-0 transition-colors duration-200">

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
    <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

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

      <!-- Action & Filter Bar -->
      <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs mb-6 flex flex-col md:flex-row md:items-center justify-between gap-3 transition-colors">
        <div class="flex items-center gap-3 flex-1 max-w-md">
          <div class="relative w-full">
            <input
              type="text"
              id="studentSearchInput"
              onkeyup="searchStudents(this.value)"
              placeholder="শিক্ষার্থীর নাম, রোল বা আইডি দিয়ে খুঁজুন..."
              class="w-full text-xs font-medium pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 rounded-xl outline-none focus:border-indigo-600 dark:focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-900 transition"
            />
            <i class="fas fa-search absolute left-3.5 top-3 text-slate-400 dark:text-slate-500 text-xs"></i>
          </div>
          <span id="activeFilterBadge" class="text-xs font-bold text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-950/60 px-3 py-2 rounded-xl whitespace-nowrap border border-indigo-200 dark:border-indigo-800">
            ফিল্টার: সকল শ্রেণি
          </span>
        </div>

        <div class="flex items-center gap-2">
          <button
            onclick="openStudentModal()"
            class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-200 dark:shadow-indigo-950 transition flex items-center gap-2 cursor-pointer"
          >
            <i class="fas fa-plus"></i>
            <span data-i18n="btn_admission_entry">নতুন ভর্তি এন্ট্রি</span>
          </button>

          <button
            onclick="openFeeModal()"
            class="px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold shadow-md shadow-amber-200 dark:shadow-amber-950 transition flex items-center gap-2 cursor-pointer"
          >
            <i class="fas fa-receipt"></i>
            <span data-i18n="btn_fee_entry">ফি রিসিট সংগ্রহ</span>
          </button>
        </div>
      </div>

      <!-- Main Grid Section -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left: Student List Table (8 Cols) -->
        <div class="lg:col-span-8 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs p-5 sm:p-6 transition-colors">
          <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
            <div>
              <h3 class="font-black text-slate-900 dark:text-white text-base flex items-center gap-2">
                <i class="fas fa-user-graduate text-indigo-600 dark:text-indigo-400"></i>
                <span data-i18n="table_title">শিক্ষার্থী তালিকা ও ভর্তি তথ্য (Student Directory)</span>
              </h3>
              <p data-i18n="table_sub" class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">অ্যাকাডেমিক রেকর্ডের দ্রুত সারসংক্ষেপ</p>
            </div>
            <span class="text-xs font-bold text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full border border-slate-200 dark:border-slate-700">
              <span data-i18n="total_students_label">মোট শিক্ষার্থী: </span><strong class="text-indigo-600 dark:text-indigo-400">১,৪৫০</strong>
            </span>
          </div>

          <!-- Table Container -->
          <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
              <thead>
                <tr class="border-b border-slate-200 dark:border-slate-800 text-slate-400 dark:text-slate-500 font-bold uppercase text-[10px] tracking-wider">
                  <th data-i18n="th_roll" class="pb-3 px-3">রোল / আইডি</th>
                  <th data-i18n="th_name" class="pb-3 px-3">শিক্ষার্থীর নাম</th>
                  <th data-i18n="th_class" class="pb-3 px-3">শ্রেণি ও শাখা</th>
                  <th data-i18n="th_guardian" class="pb-3 px-3">অভিভাবক ও মোবাইল</th>
                  <th data-i18n="th_fee_status" class="pb-3 px-3 text-center">ফি স্ট্যাটাস</th>
                  <th data-i18n="th_action" class="pb-3 px-3 text-right">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody id="studentTableBody" class="divide-y divide-slate-100 dark:divide-slate-800 font-medium text-slate-700 dark:text-slate-200">
                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition">
                  <td class="py-3 px-3 font-mono font-bold text-indigo-600 dark:text-indigo-400">#1001</td>
                  <td class="py-3 px-3">
                    <div class="flex items-center gap-2.5">
                      <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 flex items-center justify-center font-bold text-[11px]">
                        তা
                      </div>
                      <div>
                        <span class="font-bold text-slate-900 dark:text-white block">তানভীর হাসান</span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500">tanvir@student.edu</span>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 px-3">
                    <span class="font-bold text-slate-800 dark:text-slate-200">দশম শ্রেণি</span>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500 block">শাখা: ক (বিজ্ঞান)</span>
                  </td>
                  <td class="py-3 px-3">
                    <span class="block font-medium">রফিকুল হাসান</span>
                    <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500">01712-345678</span>
                  </td>
                  <td class="py-3 px-3 text-center">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/50">
                      পেইড (Paid)
                    </span>
                  </td>
                  <td class="py-3 px-3 text-right">
                    <button class="px-2.5 py-1 text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 rounded-lg transition font-bold text-xs cursor-pointer">
                      <span data-i18n="btn_details">বিস্তারিত</span>
                    </button>
                  </td>
                </tr>

                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition">
                  <td class="py-3 px-3 font-mono font-bold text-indigo-600 dark:text-indigo-400">#1002</td>
                  <td class="py-3 px-3">
                    <div class="flex items-center gap-2.5">
                      <div class="w-7 h-7 rounded-full bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300 flex items-center justify-center font-bold text-[11px]">
                        সা
                      </div>
                      <div>
                        <span class="font-bold text-slate-900 dark:text-white block">সাদিয়া রহমান</span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500">sadia@student.edu</span>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 px-3">
                    <span class="font-bold text-slate-800 dark:text-slate-200">নবম শ্রেণি</span>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500 block">শাখা: খ (ব্যবসায়)</span>
                  </td>
                  <td class="py-3 px-3">
                    <span class="block font-medium">আব্দুর রহমান</span>
                    <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500">01823-456789</span>
                  </td>
                  <td class="py-3 px-3 text-center">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800/50">
                      বকেয়া (Due)
                    </span>
                  </td>
                  <td class="py-3 px-3 text-right">
                    <button class="px-2.5 py-1 text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 rounded-lg transition font-bold text-xs cursor-pointer">
                      <span data-i18n="btn_details">বিস্তারিত</span>
                    </button>
                  </td>
                </tr>

                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition">
                  <td class="py-3 px-3 font-mono font-bold text-indigo-600 dark:text-indigo-400">#1003</td>
                  <td class="py-3 px-3">
                    <div class="flex items-center gap-2.5">
                      <div class="w-7 h-7 rounded-full bg-sky-100 dark:bg-sky-950 text-sky-700 dark:text-sky-300 flex items-center justify-center font-bold text-[11px]">
                        না
                      </div>
                      <div>
                        <span class="font-bold text-slate-900 dark:text-white block">নাঈমুল ইসলাম</span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500">naimul@student.edu</span>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 px-3">
                    <span class="font-bold text-slate-800 dark:text-slate-200">অষ্টম শ্রেণি</span>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500 block">শাখা: ক (সাধারণ)</span>
                  </td>
                  <td class="py-3 px-3">
                    <span class="block font-medium">নুরুল ইসলাম</span>
                    <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500">01934-567890</span>
                  </td>
                  <td class="py-3 px-3 text-center">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/50">
                      পেইড (Paid)
                    </span>
                  </td>
                  <td class="py-3 px-3 text-right">
                    <button class="px-2.5 py-1 text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 rounded-lg transition font-bold text-xs cursor-pointer">
                      <span data-i18n="btn_details">বিস্তারিত</span>
                    </button>
                  </td>
                </tr>

                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition">
                  <td class="py-3 px-3 font-mono font-bold text-indigo-600 dark:text-indigo-400">#1004</td>
                  <td class="py-3 px-3">
                    <div class="flex items-center gap-2.5">
                      <div class="w-7 h-7 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 flex items-center justify-center font-bold text-[11px]">
                        ফা
                      </div>
                      <div>
                        <span class="font-bold text-slate-900 dark:text-white block">ফারহানা আক্তার</span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500">farhana@student.edu</span>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 px-3">
                    <span class="font-bold text-slate-800 dark:text-slate-200">সপ্তম শ্রেণি</span>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500 block">শাখা: খ (সাধারণ)</span>
                  </td>
                  <td class="py-3 px-3">
                    <span class="block font-medium">মো. ফারুক</span>
                    <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500">01645-678901</span>
                  </td>
                  <td class="py-3 px-3 text-center">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/50">
                      পেইড (Paid)
                    </span>
                  </td>
                  <td class="py-3 px-3 text-right">
                    <button class="px-2.5 py-1 text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 rounded-lg transition font-bold text-xs cursor-pointer">
                      <span data-i18n="btn_details">বিস্তারিত</span>
                    </button>
                  </td>
                </tr>

                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition">
                  <td class="py-3 px-3 font-mono font-bold text-indigo-600 dark:text-indigo-400">#1005</td>
                  <td class="py-3 px-3">
                    <div class="flex items-center gap-2.5">
                      <div class="w-7 h-7 rounded-full bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300 flex items-center justify-center font-bold text-[11px]">
                        আ
                      </div>
                      <div>
                        <span class="font-bold text-slate-900 dark:text-white block">আরিফুল হক</span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500">ariful@student.edu</span>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 px-3">
                    <span class="font-bold text-slate-800 dark:text-slate-200">ষষ্ঠ শ্রেণি</span>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500 block">শাখা: ক (সাধারণ)</span>
                  </td>
                  <td class="py-3 px-3">
                    <span class="block font-medium">আনোয়ারুল হক</span>
                    <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500">01556-789012</span>
                  </td>
                  <td class="py-3 px-3 text-center">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800/50">
                      বকেয়া (Due)
                    </span>
                  </td>
                  <td class="py-3 px-3 text-right">
                    <button class="px-2.5 py-1 text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 rounded-lg transition font-bold text-xs cursor-pointer">
                      <span data-i18n="btn_details">বিস্তারিত</span>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="pt-4 mt-2 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
            <span data-i18n="pagination_showing">দেখানো হচ্ছে ১ থেকে ৫ (সর্বমোট ১,৪৫০ জন শিক্ষার্থী)</span>
            <div class="flex gap-1.5">
              <button data-i18n="btn_prev" class="px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer">পূর্ববর্তী</button>
              <button class="px-3 py-1 rounded-lg bg-indigo-600 text-white font-bold cursor-pointer">১</button>
              <button class="px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer">২</button>
              <button data-i18n="btn_next" class="px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer">পরবর্তী</button>
            </div>
          </div>
        </div>

        <!-- Right: Attendance Summary & Notices (4 Cols) -->
        <div class="lg:col-span-4 space-y-6">

          <!-- Attendance Progress by Class -->
          <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs p-5 transition-colors">
            <h4 class="font-black text-slate-900 dark:text-white text-sm flex items-center gap-2 mb-3 pb-2 border-b border-slate-100 dark:border-slate-800">
              <i class="fas fa-chart-simple text-indigo-600 dark:text-indigo-400"></i>
              <span data-i18n="att_progress_title">আজকের শ্রেণিভিত্তিক উপস্থিতি</span>
            </h4>

            <div class="space-y-3 text-xs">
              <div>
                <div class="flex justify-between font-bold mb-1">
                  <span data-i18n="class_10">দশম শ্রেণি (Class 10)</span>
                  <span class="text-indigo-600 dark:text-indigo-400">৯৮% (১৪২/১৪৫)</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                  <div class="bg-indigo-600 dark:bg-indigo-500 h-2 rounded-full" style="width: 98%"></div>
                </div>
              </div>

              <div>
                <div class="flex justify-between font-bold mb-1">
                  <span data-i18n="class_9">নবম শ্রেণি (Class 9)</span>
                  <span class="text-emerald-600 dark:text-emerald-400">৯৫% (১৪২/১৫০)</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                  <div class="bg-emerald-500 h-2 rounded-full" style="width: 95%"></div>
                </div>
              </div>

              <div>
                <div class="flex justify-between font-bold mb-1">
                  <span data-i18n="class_8">অষ্টম শ্রেণি (Class 8)</span>
                  <span class="text-sky-600 dark:text-sky-400">৯৪% (১৫০/১৬০)</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                  <div class="bg-sky-500 h-2 rounded-full" style="width: 94%"></div>
                </div>
              </div>

              <div>
                <div class="flex justify-between font-bold mb-1">
                  <span data-i18n="class_7">সপ্তম শ্রেণি (Class 7)</span>
                  <span class="text-amber-600 dark:text-amber-400">৯৭% (১৩৬/১৪০)</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                  <div class="bg-amber-500 h-2 rounded-full" style="width: 97%"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Academic Notice Board -->
          <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs p-5 transition-colors">
            <h4 class="font-black text-slate-900 dark:text-white text-sm flex items-center justify-between mb-3 pb-2 border-b border-slate-100 dark:border-slate-800">
              <span class="flex items-center gap-2">
                <i class="fas fa-bullhorn text-amber-500"></i>
                <span data-i18n="notice_board_title">অ্যাকাডেমিক নোটিশ বোর্ড</span>
              </span>
              <span data-i18n="all_notices" class="text-[10px] text-indigo-600 dark:text-indigo-400 font-bold hover:underline cursor-pointer">সব নোটিশ</span>
            </h4>

            <div class="space-y-3 text-xs">
              <div class="p-3 rounded-2xl bg-amber-50/70 dark:bg-amber-950/30 border border-amber-200/60 dark:border-amber-800/40">
                <span class="text-[10px] font-bold text-amber-800 dark:text-amber-300 uppercase block mb-1">২৯ সেপ্টেম্বর, ২০২৬ • জরুরি নোটিশ</span>
                <p class="font-bold text-slate-800 dark:text-slate-200 leading-snug">আসন্ন প্রথম সাময়িক পরীক্ষার রুটিন প্রকাশ করা হয়েছে।</p>
                <span class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 block">পরীক্ষা নিয়ন্ত্রক দপ্তর</span>
              </div>

              <div class="p-3 rounded-2xl bg-indigo-50/70 dark:bg-indigo-950/30 border border-indigo-200/60 dark:border-indigo-800/40">
                <span class="text-[10px] font-bold text-indigo-800 dark:text-indigo-300 uppercase block mb-1">২৬ সেপ্টেম্বর, ২০২৬ • ফি আপডেট</span>
                <p class="font-bold text-slate-800 dark:text-slate-200 leading-snug">অক্টোবর মাসের বেতন ও টিউশন ফি প্রদানের শেষ তারিখ ১০ অক্টোবর।</p>
                <span class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 block">হিসাব শাখা</span>
              </div>
            </div>
          </div>

        </div>

      </div>

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

    function switchTab(tab) {
      const tabs = ['overview', 'students', 'teachers', 'attendance', 'finance', 'exams'];
      tabs.forEach(t => {
        const btn = document.getElementById(`btn-tab-${t}`);
        if (btn) {
          if (t === tab) {
            btn.className = "w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-xs bg-indigo-600 text-white shadow-md shadow-indigo-200 dark:shadow-indigo-950 transition cursor-pointer";
          } else {
            btn.className = "w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition cursor-pointer";
          }
        }
      });
    }

    function filterClass(className) {
      const dict = I18N[currentLang];
      const badge = document.getElementById('activeFilterBadge');
      if (className === 'all') {
        badge.textContent = dict.filter_all_label;
      } else {
        badge.textContent = `${dict.filter_label_prefix}${className}`;
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
