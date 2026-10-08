<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Management System - Master Project Plan & Architecture Roadmap</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Plus Jakarta Sans', 'Hind Siliguri', sans-serif;
      -webkit-font-smoothing: antialiased;
    }
    .font-mono {
      font-family: 'JetBrains Mono', monospace;
    }
    @media print {
      .no-print {
        display: none !important;
      }
      body {
        background: #ffffff !important;
        color: #0f172a !important;
        padding: 0 !important;
        margin: 0 !important;
        font-size: 10.5px !important;
      }
      .page-card {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        max-width: 100% !important;
      }
      .break-inside-avoid {
        break-inside: avoid !important;
        page-break-inside: avoid !important;
      }
      .page-break {
        break-before: page !important;
        page-break-before: always !important;
      }
      @page {
        margin: 10mm 12mm;
        size: A4 portrait;
      }
      a {
        text-decoration: none !important;
        color: inherit !important;
      }
    }
  </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen py-6 px-3 sm:px-6">

  <!-- Floating Action Bar (Hidden in Print) -->
  <div class="no-print max-w-5xl mx-auto mb-6 sticky top-4 z-50 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <div class="flex items-center gap-3">
      <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> ড্যাশবোর্ডে ফিরে যান
      </a>
      <div>
        <h2 class="text-xs sm:text-sm font-black text-slate-900 flex items-center gap-2">
          <span>School Management System Master Plan</span>
          <span class="text-[10px] px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 font-bold font-mono">v{{ $plan->version ?? '1.0.0' }}</span>
        </h2>
        <p class="text-[11px] text-slate-400">অফিসিয়াল সিস্টেম ব্লুপ্রিন্ট ও প্রিন্ট-রেডি ডকুমেন্ট</p>
      </div>
    </div>
    <div class="flex items-center gap-2 shrink-0">
      <!-- Direct Download PDF Button -->
      <a
        href="{{ route('project-plan.download-pdf') }}"
        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold shadow-md shadow-emerald-200 transition flex items-center gap-1.5 cursor-pointer"
        title="Download compiled PDF document file directly"
      >
        <i class="fas fa-file-arrow-down"></i>
        <span>PDF ডাউনলোড (.pdf)</span>
      </a>

      <!-- Browser Print Button -->
      <button
        onclick="window.print()"
        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-200 transition flex items-center gap-1.5 cursor-pointer"
        title="Print document or save via browser print dialog"
      >
        <i class="fas fa-print"></i>
        <span>প্রিন্ট / ব্রাউজার সেভ</span>
      </button>
    </div>
  </div>

  <!-- Document Paper Container -->
  <main class="page-card max-w-5xl mx-auto bg-white p-6 sm:p-10 rounded-3xl shadow-xl border border-slate-200">

    <!-- Document Header & Crest -->
    <header class="border-b-2 border-indigo-600 pb-6 mb-8">
      <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
        <div class="flex items-start gap-4">
          <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-700 to-indigo-500 text-white flex items-center justify-center text-3xl shadow-lg shadow-indigo-200 shrink-0">
            <i class="fas fa-school"></i>
          </div>
          <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 mb-1.5">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              <span class="text-[10px] font-extrabold uppercase tracking-wider text-indigo-700">Official Software Blueprint & Development Roadmap</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-tight">
              School Management System (SMS) — Complete Project Plan
            </h1>
            <p class="text-xs sm:text-sm text-indigo-950 font-bold mt-0.5">
              স্মার্ট ডিজিটাল স্কুল ম্যানেজমেন্ট সফটওয়্যার — পূর্ণাঙ্গ প্রকল্প পরিকল্পনা ও আর্কিটেকচারাল ব্লুপ্রিন্ট
            </p>
            <p class="text-[11px] text-slate-500 mt-1 max-w-2xl leading-relaxed">
              বিদ্যালয়ের অ্যাকাডেমিক কার্যক্রম, স্বয়ংক্রিয় ভর্তি, ফি আদায়, বায়োমেট্রিক উপস্থিতি, ফলাফল মূল্যায়ন ও অভিভাবক সংযোগের সমন্বিত ক্লাউড সল্যুশন।
            </p>
          </div>
        </div>

        <div class="text-left sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-100 text-xs shrink-0 font-medium">
          <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100 inline-block text-left">
            <div class="flex justify-between gap-4 mb-1">
              <span class="text-slate-400 font-bold text-[10px]">DOCUMENT ID:</span>
              <span class="font-mono font-bold text-slate-800 text-[10px]">SMS-PLAN-2026</span>
            </div>
            <div class="flex justify-between gap-4 mb-1">
              <span class="text-slate-400 font-bold text-[10px]">VERSION:</span>
              <span class="font-mono font-bold text-indigo-600 text-[10px]">v{{ $plan->version ?? '1.0.0' }}</span>
            </div>
            <div class="flex justify-between gap-4 mb-1">
              <span class="text-slate-400 font-bold text-[10px]">CREATED:</span>
              <span class="text-slate-700 text-[10px]">{{ now()->format('d M, Y') }}</span>
            </div>
            <div class="flex justify-between gap-4">
              <span class="text-slate-400 font-bold text-[10px]">STATUS:</span>
              <span class="text-emerald-700 font-extrabold text-[10px]">Active Development</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Section 1: Executive Summary & Project Objectives -->
    <section class="mb-8 break-inside-avoid">
      <div class="flex items-center gap-2 mb-3">
        <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-xs font-bold font-mono">1</span>
        <h2 class="text-sm font-black uppercase tracking-wider text-slate-900">Executive Summary & Strategic Objectives (প্রকল্প পরিচিতি ও মূল লক্ষ্য)</h2>
      </div>

      <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/80 text-xs leading-relaxed text-slate-700 mb-4">
        <p class="mb-2">
          <strong>প্রকল্পের লক্ষ্য:</strong> বর্তমান ম্যানুয়াল ও খাতা-কলমভিত্তিক স্কুল প্রশাসনকে একটি আধুনিক, ডিজিটাল ও ক্লাউড-সংযুক্ত স্কুল ম্যানেজমেন্ট প্ল্যাটফর্মে রূপান্তর করা। এই প্ল্যাটফর্মের মাধ্যমে ভর্তি থেকে শুরু করে শ্রেণি ব্যবস্থাপনা, আরএফআইডি ও ফিঙ্গারপ্রিন্ট ভিত্তিক বায়োমেট্রিক উপস্থিতি, স্বয়ংক্রিয় অভিভাবক এসএমএস অ্যালার্ট, বিকাশ/নগদ পেমেন্ট গেটওয়ের মাধ্যমে ফি আদায়, জাতীয় শিক্ষাক্রম অনুসারে জিপিএ মার্কশিট প্রণয়ন এবং শিক্ষক-কর্মচারীদের পে-রোল সম্পূর্ণরূপে ডিজিটাল হবে।
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2.5 mt-3 pt-3 border-t border-slate-200">
          <div class="p-2.5 bg-white rounded-xl border border-slate-200/70">
            <span class="text-indigo-600 font-bold text-[11px] block"><i class="fas fa-bolt mr-1"></i>১০০% পেপারলেস অপারেশন</span>
            <span class="text-[10px] text-slate-500">ভর্তি, নোটিশ ও রিসিট ডিজিটাল তৈরি</span>
          </div>
          <div class="p-2.5 bg-white rounded-xl border border-slate-200/70">
            <span class="text-emerald-600 font-bold text-[11px] block"><i class="fas fa-shield-halved mr-1"></i>আর্থিক স্বচ্ছতা ও অডিট</span>
            <span class="text-[10px] text-slate-500">স্বয়ংক্রিয় ক্যাশ বুক ও অনলাইন ফি</span>
          </div>
          <div class="p-2.5 bg-white rounded-xl border border-slate-200/70">
            <span class="text-sky-600 font-bold text-[11px] block"><i class="fas fa-comments mr-1"></i>অভিভাবক রিয়েল-টাইম তথ্য</span>
            <span class="text-[10px] text-slate-500">অনুপস্থিতি এসএমএস ও রেজাল্ট কার্ড</span>
          </div>
          <div class="p-2.5 bg-white rounded-xl border border-slate-200/70">
            <span class="text-amber-600 font-bold text-[11px] block"><i class="fas fa-database mr-1"></i>নিরাপদ ডাটা সংরক্ষণ</span>
            <span class="text-[10px] text-slate-500">রোল বেসড অ্যাক্সেস ও অটো ব্যাকআপ</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 2: Executive Progress KPI Dashboard -->
    <section class="mb-8 break-inside-avoid">
      <div class="flex items-center gap-2 mb-3">
        <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-xs font-bold font-mono">2</span>
        <h2 class="text-sm font-black uppercase tracking-wider text-slate-900">Milestone Health & Implementation KPIs (অগ্রগতি সারসংক্ষেপ)</h2>
      </div>

      <!-- 4 Stat Metric Cards -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
          <span class="text-[10px] font-bold text-slate-400 uppercase block">মোট সাবমডিউল টাস্ক</span>
          <span class="text-2xl font-black text-slate-900 font-mono">{{ $stats['total'] }}</span>
          <span class="text-[10px] text-slate-500 block mt-0.5 font-medium">১২টি কোর আর্কিটেকচার মডিউল</span>
        </div>

        <div class="bg-emerald-50/90 p-4 rounded-2xl border border-emerald-200/70">
          <span class="text-[10px] font-bold text-emerald-700 uppercase block">কাজ সম্পন্ন (Completed)</span>
          <span class="text-2xl font-black text-emerald-800 font-mono">{{ $stats['completed'] }}</span>
          <span class="text-[10px] text-emerald-600 font-bold block mt-0.5">লাইভ ও টেস্টেড ফিচার</span>
        </div>

        <div class="bg-amber-50/90 p-4 rounded-2xl border border-amber-200/70">
          <span class="text-[10px] font-bold text-amber-700 uppercase block">চলমান কাজ (In Progress)</span>
          <span class="text-2xl font-black text-amber-800 font-mono">{{ $stats['in_progress'] }}</span>
          <span class="text-[10px] text-amber-600 font-bold block mt-0.5">অ্যাক্টিভ স্প্রিন্ট ফেজ</span>
        </div>

        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
          <span class="text-[10px] font-bold text-slate-500 uppercase block">অপেক্ষমাণ (Pending)</span>
          <span class="text-2xl font-black text-slate-700 font-mono">{{ $stats['pending'] }}</span>
          <span class="text-[10px] text-slate-400 block mt-0.5 font-medium">পরবর্তী স্প্রিন্টে নির্ধারিত</span>
        </div>
      </div>

      <!-- Overall Progress Bar Card -->
      <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
        <div class="flex justify-between items-center text-xs font-bold mb-1.5">
          <span class="text-slate-800">সার্বিক স্কুল ম্যানেজমেন্ট সফটওয়্যার অগ্রগতি (Overall Project Completion)</span>
          <span class="text-indigo-600 font-black text-base font-mono">{{ $stats['percentage'] }}%</span>
        </div>
        <div class="w-full bg-slate-200 h-3 rounded-full overflow-hidden p-0.5">
          <div class="bg-gradient-to-r from-indigo-500 via-indigo-600 to-emerald-500 h-2 rounded-full transition-all duration-500" style="width: {{ $stats['percentage'] }}%"></div>
        </div>
        <div class="flex justify-between items-center text-[10px] text-slate-500 mt-1.5 font-medium">
          <span>{{ $stats['completed'] }} টি টাস্ক সম্পন্ন (মোট {{ $stats['total'] }} টির মধ্যে)</span>
          <span>মোট অনুমিত ডেভেলপমেন্ট সময়কাল: <strong class="text-slate-800 font-mono">{{ $stats['total_days'] }} দিন (~৩ মাস)</strong></span>
        </div>
      </div>
    </section>

    <!-- Section 3: Technical Architecture & System Specifications -->
    <section class="mb-8 break-inside-avoid">
      <div class="flex items-center gap-2 mb-3">
        <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-xs font-bold font-mono">3</span>
        <h2 class="text-sm font-black uppercase tracking-wider text-slate-900">Technical Architecture & Infrastructure (প্রযুক্তি ও আর্কিটেকচার)</h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
        <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
          <div class="w-8 h-8 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm mb-2">
            <i class="fab fa-laravel"></i>
          </div>
          <h3 class="font-black text-slate-900 text-xs">ব্যাকএন্ড ইঞ্জিন</h3>
          <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
            PHP 8.2+ এবং Laravel 12.x ফ্রেমওয়ার্ক। শক্তিশালী Eloquent ORM ও স্ট্রাকচারড কন্ট্রোলার প্যাটার্ন।
          </p>
        </div>

        <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
          <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-sm mb-2">
            <i class="fas fa-database"></i>
          </div>
          <h3 class="font-black text-slate-900 text-xs">ডাটাবেজ আর্কিটেকচার</h3>
          <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
            MySQL 8.0 / MariaDB InnoDB ইঞ্জিন। রিলেশনাল ফরেন কী ইন্টিগ্রিটি ও ট্রানজাকশন সেফটি।
          </p>
        </div>

        <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
          <div class="w-8 h-8 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center text-sm mb-2">
            <i class="fas fa-palette"></i>
          </div>
          <h3 class="font-black text-slate-900 text-xs">ইউজার ইন্টারফেস (UI)</h3>
          <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
            Tailwind CSS 3.4+, ডার্ক ও লাইট মোড টগল, দ্বিভাষিক (বাংলা/ইংরেজি) সাপোর্ট ও ফুল মোবাইল রেসপনসিভনেস।
          </p>
        </div>

        <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
          <div class="w-8 h-8 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-sm mb-2">
            <i class="fas fa-vial-circle-check"></i>
          </div>
          <h3 class="font-black text-slate-900 text-xs">কোয়ালিটি ও টেস্ট কভারেজ</h3>
          <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
            Pest PHP স্বয়ংক্রিয় টেস্ট স্যুট (৩১টি টেস্ট ১০০% পাসিং), Pint কোড স্টাইলিং ও CSRF প্রটেকশন।
          </p>
        </div>
      </div>
    </section>

    <!-- Section 4: Multi-Role Access Matrix -->
    <section class="mb-8 break-inside-avoid">
      <div class="flex items-center gap-2 mb-3">
        <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-xs font-bold font-mono">4</span>
        <h2 class="text-sm font-black uppercase tracking-wider text-slate-900">User Roles & Access Control Matrix (ব্যবহারকারী পারমিশন)</h2>
      </div>

      <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-xs text-xs">
        <table class="w-full text-left">
          <thead class="bg-slate-100/80 text-slate-600 font-bold uppercase text-[10px] tracking-wider border-b border-slate-200">
            <tr>
              <th class="py-2.5 px-3">ব্যবহারকারী রোল</th>
              <th class="py-2.5 px-3">অ্যাক্সেস স্কোপ</th>
              <th class="py-2.5 px-3">মূল ফিচার ও অধিকার</th>
              <th class="py-2.5 px-3 text-center">নিরাপত্তা লেভেল</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-slate-700">
            <tr>
              <td class="py-2.5 px-3 font-bold text-slate-900">
                <i class="fas fa-user-shield text-indigo-600 mr-1.5"></i> সুপার অ্যাডমিন / প্রধান শিক্ষক
              </td>
              <td class="py-2.5 px-3">সার্বিক প্রতিষ্ঠান নিয়ন্ত্রণ</td>
              <td class="py-2.5 px-3">সকল সেটিংস, রিপোর্ট, শিক্ষক নিয়োগ, ফি পলিসি ও ডাটাবেজ ব্যাকআপ</td>
              <td class="py-2.5 px-3 text-center"><span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-rose-100 text-rose-800">SUPER ADMIN</span></td>
            </tr>
            <tr>
              <td class="py-2.5 px-3 font-bold text-slate-900">
                <i class="fas fa-chalkboard-user text-emerald-600 mr-1.5"></i> শিক্ষক ও কর্মকর্তা
              </td>
              <td class="py-2.5 px-3">ক্লাসরুম ও অ্যাকাডেমিক</td>
              <td class="py-2.5 px-3">রোল-কল উপস্থিতি, পরীক্ষার নম্বর এন্ট্রি, সিলেবাস আপলোড ও ছুটির আবেদন</td>
              <td class="py-2.5 px-3 text-center"><span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-100 text-emerald-800">FACULTY</span></td>
            </tr>
            <tr>
              <td class="py-2.5 px-3 font-bold text-slate-900">
                <i class="fas fa-coins text-amber-600 mr-1.5"></i> হিসাবরক্ষক / ক্যাশিয়ার
              </td>
              <td class="py-2.5 px-3">ফি কালেকশন ও হিসাব শাখা</td>
              <td class="py-2.5 px-3">মানি রিসিট প্রদান, মাসিক টিউশন ফি আদায়, খরচ ভাউচার ও দৈনিক ক্যাশ বুক</td>
              <td class="py-2.5 px-3 text-center"><span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-amber-100 text-amber-800">ACCOUNTANT</span></td>
            </tr>
            <tr>
              <td class="py-2.5 px-3 font-bold text-slate-900">
                <i class="fas fa-users-line text-sky-600 mr-1.5"></i> অভিভাবক (Parents)
              </td>
              <td class="py-2.5 px-3">সন্তানের প্রোফাইল ও অগ্রগতি</td>
              <td class="py-2.5 px-3">অনুপস্থিতি এসএমএস, অনলাইন ফি পরিশোধ, ডিজিটাল মার্কশিট ও নোটিশ দেখা</td>
              <td class="py-2.5 px-3 text-center"><span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-sky-100 text-sky-800">PARENT</span></td>
            </tr>
            <tr>
              <td class="py-2.5 px-3 font-bold text-slate-900">
                <i class="fas fa-user-graduate text-purple-600 mr-1.5"></i> শিক্ষার্থী (Students)
              </td>
              <td class="py-2.5 px-3">ব্যক্তিগত পোর্টাল</td>
              <td class="py-2.5 px-3">ক্লাস রুটিন, প্রবেশপত্র ডাউনলোড, পরীক্ষার ফলাফল ও লাইব্রেরি বই ট্র্যাকিং</td>
              <td class="py-2.5 px-3 text-center"><span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-purple-100 text-purple-800">STUDENT</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Section 5: Phased Implementation Roadmap -->
    <section class="mb-8 break-inside-avoid">
      <div class="flex items-center gap-2 mb-3">
        <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-xs font-bold font-mono">5</span>
        <h2 class="text-sm font-black uppercase tracking-wider text-slate-900">Phased Implementation Milestones (পর্যায়ক্রমিক রোডম্যাপ)</h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
        <div class="p-3 bg-indigo-50/60 rounded-2xl border border-indigo-100">
          <div class="flex justify-between items-center mb-1">
            <span class="font-mono text-[10px] font-black text-indigo-700">PHASE 1</span>
            <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">COMPLETED</span>
          </div>
          <h4 class="font-black text-slate-900 text-xs">ফাউন্ডেশন ও সিকিউরিটি</h4>
          <p class="text-[11px] text-slate-600 mt-1 leading-snug">
            অথেনটিকেশন, ডার্ক/লাইট মোড, দ্বিভাষিক (বাংলা/ইংরেজি) সুইচিং ও মোবাইল রেসপনসিভ ড্রয়ার।
          </p>
        </div>

        <div class="p-3 bg-amber-50/60 rounded-2xl border border-amber-100">
          <div class="flex justify-between items-center mb-1">
            <span class="font-mono text-[10px] font-black text-amber-700">PHASE 2 & 3</span>
            <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">IN PROGRESS</span>
          </div>
          <h4 class="font-black text-slate-900 text-xs">অ্যাকাডেমিক ও উপস্থিতি</h4>
          <p class="text-[11px] text-slate-600 mt-1 leading-snug">
            শিক্ষার্থী ভর্তি (SIS), শ্রেণি ও শাখা কনফিগারেশন, ক্লাসরুম উপস্থিতি ও স্বয়ংক্রিয় এসএমএস।
          </p>
        </div>

        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200">
          <div class="flex justify-between items-center mb-1">
            <span class="font-mono text-[10px] font-black text-slate-600">PHASE 4 - 7</span>
            <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-slate-200 text-slate-700">SCHEDULED</span>
          </div>
          <h4 class="font-black text-slate-900 text-xs">ফি, পরীক্ষা ও অ্যাড-অন</h4>
          <p class="text-[11px] text-slate-600 mt-1 leading-snug">
            বিকাশ ফি কালেকশন, জিপিএ মার্কশিট, শিক্ষক পে-রোল, লাইব্রেরি ও ক্লাউড অটোমেটিক ব্যাকআপ।
          </p>
        </div>
      </div>
    </section>

    <!-- Section 6: Detailed Modular Breakdown (All 12 Modules & Submodules) -->
    <section class="mb-10">
      <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200">
        <div class="flex items-center gap-2">
          <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-xs font-bold font-mono">6</span>
          <h2 class="text-sm font-black uppercase tracking-wider text-slate-900">Complete Modular Breakdown (১২টি মডিউল ও সাবমডিউলের পূর্ণাঙ্গ তালিকা)</h2>
        </div>
        <span class="text-xs font-bold text-slate-500 font-mono">{{ $stats['total'] }} টি টাস্ক স্পেসিফিকেশন</span>
      </div>

      <div class="space-y-6">
        @foreach ($groupedDetails as $moduleCode => $items)
          @php
            $firstItem = $items->first();
            $modTotal = $items->count();
            $modCompleted = $items->where('status', 'completed')->count();
            $modPct = $modTotal > 0 ? (int) round(($modCompleted / $modTotal) * 100) : 0;
          @endphp

          <div class="break-inside-avoid border border-slate-200 rounded-2xl overflow-hidden shadow-xs">
            <!-- Module Header Banner -->
            <div class="bg-slate-100/90 px-4 py-3 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
              <div class="flex items-center gap-2.5">
                <span class="px-2.5 py-1 rounded-lg bg-indigo-600 text-white font-mono text-xs font-bold shadow-xs">
                  {{ $moduleCode }}
                </span>
                <div>
                  <h3 class="font-black text-slate-900 text-xs sm:text-sm">
                    {{ $firstItem->module_name }}
                    @if ($firstItem->module_name_bn)
                      <span class="text-slate-500 font-semibold text-xs">({{ $firstItem->module_name_bn }})</span>
                    @endif
                  </h3>
                </div>
              </div>

              <div class="flex items-center gap-3">
                <span class="text-[11px] font-bold text-slate-500 font-mono">
                  {{ $modCompleted }}/{{ $modTotal }} সম্পন্ন
                </span>
                <div class="w-20 bg-slate-200 h-2 rounded-full overflow-hidden">
                  <div class="h-2 rounded-full {{ $modPct === 100 ? 'bg-emerald-500' : ($modPct > 0 ? 'bg-amber-500' : 'bg-slate-300') }}" style="width: {{ $modPct }}%"></div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-black font-mono {{ $modPct === 100 ? 'bg-emerald-100 text-emerald-800' : 'bg-indigo-100 text-indigo-800' }}">
                  {{ $modPct }}%
                </span>
              </div>
            </div>

            <!-- Submodules Table -->
            <div class="overflow-x-auto">
              <table class="w-full text-left text-xs">
                <thead>
                  <tr class="bg-slate-50 text-slate-500 font-bold uppercase text-[9px] tracking-wider border-b border-slate-200">
                    <th class="py-2 px-3 w-8 text-center">#</th>
                    <th class="py-2 px-2.5 w-16 text-center">অগ্রাধিকার</th>
                    <th class="py-2 px-3">সাবমডিউল নাম ও কারিগরি কাজের পরিধি (Scope)</th>
                    <th class="py-2 px-3 w-28 text-center">স্ট্যাটাস</th>
                    <th class="py-2 px-3 w-24 text-center">প্রগ্রেস %</th>
                    <th class="py-2 px-3 w-16 text-right">সময়কাল</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                  @foreach ($items as $item)
                    <tr class="hover:bg-slate-50/50 transition">
                      <td class="py-2.5 px-3 font-mono font-bold text-slate-400 text-[10px] text-center">
                        {{ $loop->iteration }}
                      </td>
                      <td class="py-2.5 px-2.5 text-center">
                        @if ($item->priority === 'high')
                          <span class="px-1.5 py-0.5 rounded-md text-[9px] font-black bg-rose-100 text-rose-800 border border-rose-200">HIGH</span>
                        @elseif ($item->priority === 'medium')
                          <span class="px-1.5 py-0.5 rounded-md text-[9px] font-black bg-amber-100 text-amber-800 border border-amber-200">MED</span>
                        @else
                          <span class="px-1.5 py-0.5 rounded-md text-[9px] font-black bg-slate-100 text-slate-600 border border-slate-200">LOW</span>
                        @endif
                      </td>
                      <td class="py-2.5 px-3">
                        <div class="font-black text-slate-900 leading-snug">
                          {{ $item->submodule_name }}
                          @if ($item->submodule_name_bn)
                            <span class="text-slate-500 font-medium text-[11px] block sm:inline"> • {{ $item->submodule_name_bn }}</span>
                          @endif
                        </div>
                        @if ($item->description)
                          <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ $item->description }}</p>
                        @endif
                        @if ($item->notes)
                          <span class="text-[10px] text-indigo-700 font-semibold italic block mt-0.5">
                            <i class="fas fa-info-circle mr-1"></i>নোট: {{ $item->notes }}
                          </span>
                        @endif
                      </td>
                      <td class="py-2.5 px-3 text-center">
                        @if ($item->status === 'completed')
                          <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            <i class="fas fa-check-circle text-[9px]"></i> Completed
                          </span>
                        @elseif ($item->status === 'in_progress')
                          <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                            <i class="fas fa-arrows-rotate text-[9px]"></i> In Progress
                          </span>
                        @else
                          <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                            <i class="fas fa-clock text-[9px]"></i> Pending
                          </span>
                        @endif
                      </td>
                      <td class="py-2.5 px-3 text-center">
                        <div class="flex items-center gap-1.5 justify-center">
                          <div class="w-12 bg-slate-200 h-1.5 rounded-full overflow-hidden">
                            <div class="h-1.5 rounded-full {{ $item->status === 'completed' ? 'bg-emerald-500' : ($item->status === 'in_progress' ? 'bg-amber-500' : 'bg-slate-300') }}" style="width: {{ $item->progress_percentage }}%"></div>
                          </div>
                          <span class="font-mono text-[10px] font-bold text-slate-700">{{ $item->progress_percentage }}%</span>
                        </div>
                      </td>
                      <td class="py-2.5 px-3 text-right font-mono font-bold text-slate-700 text-xs">
                        {{ $item->estimated_days ? $item->estimated_days.' d' : '-' }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <!-- Section 7: Key Database Schema Mapping -->
    <section class="mb-8 break-inside-avoid">
      <div class="flex items-center gap-2 mb-3">
        <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-xs font-bold font-mono">7</span>
        <h2 class="text-sm font-black uppercase tracking-wider text-slate-900">Database Schema Architecture (ডাটাবেজ টেবিল স্ট্রাকচার)</h2>
      </div>

      <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-xs">
        <p class="text-slate-600 mb-3 leading-relaxed">
          সিস্টেমের সকল টেবিল InnoDB ইঞ্জিনে এবং ফরেন কী কনস্ট্রেইন্ট সহ ডিজাইন করা হয়েছে। নিচে প্রধান টেবিল ও তাদের উদ্দেশ্যের সারসংক্ষেপ:
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 font-mono text-[10px]">
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">project_plan</span>
            <span class="text-slate-400">মাস্টার প্রজেক্ট রোডম্যাপ</span>
          </div>
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">project_plan_details</span>
            <span class="text-slate-400">মডিউল ও সাবমডিউল টাস্ক</span>
          </div>
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">users & roles</span>
            <span class="text-slate-400">অথেনটিকেশন ও RBAC</span>
          </div>
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">students & guardians</span>
            <span class="text-slate-400">শিক্ষার্থী ও অভিভাবক প্রোফাইল</span>
          </div>
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">classes & sections</span>
            <span class="text-slate-400">শ্রেণি, শাখা ও গ্রুপ</span>
          </div>
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">attendances</span>
            <span class="text-slate-400">দৈনিক ও ডিভাইস উপস্থিতি</span>
          </div>
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">fees & receipts</span>
            <span class="text-slate-400">ফি কাঠামো ও ক্যাশ ভাউচার</span>
          </div>
          <div class="bg-white p-2 rounded-xl border border-slate-200">
            <span class="font-bold text-indigo-600 block">exams & marks</span>
            <span class="text-slate-400">গ্রেডিং ও জিপিএ মার্কশিট</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 8: Signatures & Verification Block -->
    <footer class="pt-8 border-t-2 border-slate-200 mt-10 break-inside-avoid">
      <div class="text-center mb-6">
        <h3 class="text-xs font-black uppercase tracking-wider text-slate-500">Official Sign-off & Verification (প্রকল্প অনুমোদন ও স্বাক্ষর)</h3>
        <p class="text-[11px] text-slate-400 mt-0.5">এই ডকুমেন্টটি সফটওয়্যার আর্কিটেকচার টিম ও প্রতিষ্ঠান প্রধানের যৌথ পর্যালোচনায় অনুমোদিত</p>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center text-xs">
        <div>
          <div class="h-12 border-b border-slate-300 flex items-end justify-center pb-1 mb-1 font-mono text-[11px] text-slate-400 italic">
            [Approved Signature]
          </div>
          <div class="font-bold text-slate-800">Lead Systems Architect</div>
          <span class="text-[10px] text-slate-400 block">কারিগরি আর্কিটেকচার ও কোড অডিট</span>
        </div>

        <div>
          <div class="h-12 border-b border-slate-300 flex items-end justify-center pb-1 mb-1 font-mono text-[11px] text-slate-400 italic">
            [Approved Signature]
          </div>
          <div class="font-bold text-slate-800">Project Manager / Scrum Master</div>
          <span class="text-[10px] text-slate-400 block">স্প্রিন্ট ডেলিভারি ও শিডিউলিং</span>
        </div>

        <div>
          <div class="h-12 border-b border-slate-300 flex items-end justify-center pb-1 mb-1 font-mono text-[11px] text-slate-400 italic">
            [Approved Signature]
          </div>
          <div class="font-bold text-slate-800">QA & Security Lead</div>
          <span class="text-[10px] text-slate-400 block">কোয়ালিটি অ্যাসুরেন্স ও সাইবার সিকিউরিটি</span>
        </div>

        <div>
          <div class="h-12 border-b border-slate-300 flex items-end justify-center pb-1 mb-1 font-mono text-[11px] text-slate-400 italic">
            [Approved Signature]
          </div>
          <div class="font-bold text-slate-800">Principal / Institutional Head</div>
          <span class="text-[10px] text-slate-400 block">প্রাতিষ্ঠানিক অনুমোদন ও ভেরিফিকেশন</span>
        </div>
      </div>

      <!-- Document Print Footer -->
      <div class="text-center text-[10px] text-slate-400 mt-8 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-2">
        <span>School Management System Enterprise Edition • Generated Automatically from Database</span>
        <span class="font-mono">Confidential • Version {{ $plan->version ?? '1.0.0' }} • All Rights Reserved</span>
      </div>
    </footer>

  </main>

</body>
</html>
