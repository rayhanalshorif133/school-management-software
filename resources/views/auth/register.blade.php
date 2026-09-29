<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - {{ config('app.name', 'School Management') }}</title>

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
      width: 5px;
      height: 5px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 9999px;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 min-h-screen flex items-center justify-center p-3 sm:p-6 antialiased text-slate-800">

  <!-- Glowing background elements -->
  <div class="fixed top-10 left-10 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
  <div class="fixed bottom-10 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Main Card -->
  <div class="relative w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 border border-slate-100">

    <!-- Left Column: School Management Branding & Information -->
    <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 p-6 sm:p-8 text-white flex flex-col justify-between relative overflow-hidden">

      <!-- Ambient Graphic -->
      <div class="absolute -right-8 -bottom-8 opacity-10 pointer-events-none">
        <i class="fas fa-graduation-cap text-[220px]"></i>
      </div>

      <div class="relative z-10">
        <!-- Brand Header -->
        <div class="flex items-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl shadow-lg shadow-indigo-500/30">
            <i class="fas fa-school"></i>
          </div>
          <div>
            <h1 class="text-lg font-black tracking-tight leading-tight uppercase">{{ config('app.name', 'School Management') }}</h1>
            <p class="text-[11px] text-indigo-300 font-medium">Smart Academic Administration System</p>
          </div>
        </div>

        <h2 class="text-xl sm:text-2xl font-black text-white leading-snug">
          নতুন অ্যাকাউন্ট তৈরি করুন
        </h2>
        <p class="text-xs text-indigo-200/90 mt-2 leading-relaxed">
          স্কুল ম্যানেজমেন্ট প্ল্যাটফর্মে সহজে যুক্ত হয়ে অ্যাকাডেমিক ও প্রশাসনিক সকল সুবিধা উপভোগ করুন।
        </p>

        <!-- Feature List -->
        <div class="mt-6 pt-5 border-t border-indigo-800/60 space-y-2.5">
          <div class="p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-xs">
              <i class="fas fa-user-shield"></i>
            </div>
            <div>
              <span class="font-bold text-white text-xs block">নিরাপদ তথ্য সংরক্ষণ</span>
              <span class="text-[10px] text-indigo-300">এনক্রিপ্টেড ডাটাবেজ ও ক্লাউড সিকিউরিটি</span>
            </div>
          </div>

          <div class="p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-300 flex items-center justify-center text-xs">
              <i class="fas fa-chart-pie"></i>
            </div>
            <div>
              <span class="font-bold text-white text-xs block">রিয়েল-টাইম ড্যাশবোর্ড</span>
              <span class="text-[10px] text-indigo-300">শিক্ষার্থী ও প্রতিষ্ঠানের সার্বিক অগ্রগতির সার্বক্ষণিক আপডেট</span>
            </div>
          </div>

          <div class="p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-300 flex items-center justify-center text-xs">
              <i class="fas fa-headset"></i>
            </div>
            <div>
              <span class="font-bold text-white text-xs block">২৪/৭ অনলাইন সহায়তা</span>
              <span class="text-[10px] text-indigo-300">যেকোনো কারিগরি সহায়তায় সার্বক্ষণিক কাস্টমার সাপোর্ট</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Left Bottom Support Note -->
      <div class="relative z-10 pt-4 mt-6 border-t border-indigo-800/60 flex items-center justify-between text-[11px] text-indigo-200">
        <span class="flex items-center gap-1.5 font-semibold text-indigo-300">
          <i class="fas fa-lock text-emerald-400"></i> নিরাপদ ও সুরক্ষিত প্ল্যাটফর্ম
        </span>
        <a href="{{ route('login') }}" class="text-[11px] text-indigo-300 hover:text-white underline">লগইন করুন</a>
      </div>

    </div>

    <!-- Right Column: Registration Form -->
    <div class="lg:col-span-7 p-6 sm:p-10 flex flex-col justify-center bg-white">

      <!-- Top Title -->
      <div class="mb-5">
        <h3 class="text-2xl font-black text-slate-900 tracking-tight">রেজিস্ট্রেশন পোর্টাল (Sign Up)</h3>
        <p class="text-xs text-slate-500 mt-1">
          একটি নতুন অ্যাকাউন্ট খুলতে নিচের ফর্মটি পূরণ করুন।
        </p>
      </div>

      <!-- Tab Switcher: Login & Registration -->
      <div class="grid grid-cols-2 gap-2 p-1.5 bg-slate-100 rounded-2xl mb-6 border border-slate-200">
        <!-- Login Tab -->
        <a
          href="{{ route('login') }}"
          class="py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-2 text-slate-600 hover:text-slate-900"
        >
          <i class="fas fa-right-to-bracket text-slate-400"></i>
          <span>লগইন (Sign In)</span>
        </a>

        <!-- Registration Tab (Active) -->
        <a
          href="{{ route('register') }}"
          class="py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-2 bg-white text-indigo-700 shadow-sm"
        >
          <i class="fas fa-user-plus text-indigo-600"></i>
          <span>রেজিস্ট্রেশন (Register)</span>
        </a>
      </div>

      <!-- Error Alert Message -->
      @if ($errors->any())
        <div class="p-3.5 mb-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2">
          <i class="fas fa-circle-exclamation text-rose-600 text-sm"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <!-- Main Registration Form -->
      <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
        @csrf

        <!-- Full Name Input -->
        <div>
          <label for="name" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">
            পূর্ণ নাম (Full Name)
          </label>
          <div class="relative">
            <input
              type="text"
              name="name"
              id="name"
              required
              autofocus
              autocomplete="name"
              value="{{ old('name') }}"
              placeholder="e.g. Md. Rayhan"
              class="w-full text-xs font-semibold pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl outline-none focus:border-indigo-600 focus:bg-white transition text-slate-800"
            />
            <i class="fas fa-user absolute left-3.5 top-3 text-slate-400 text-xs"></i>
          </div>
          @if ($errors->has('name'))
            <p class="text-rose-600 text-[11px] mt-1 font-semibold">{{ $errors->first('name') }}</p>
          @endif
        </div>

        <!-- Email Input -->
        <div>
          <label for="email" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">
            ইমেইল অ্যাড্রেস (Email Address)
          </label>
          <div class="relative">
            <input
              type="email"
              name="email"
              id="email"
              required
              autocomplete="username"
              value="{{ old('email') }}"
              placeholder="e.g. rayhan@gmail.com"
              class="w-full text-xs font-semibold pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl outline-none focus:border-indigo-600 focus:bg-white transition text-slate-800"
            />
            <i class="fas fa-envelope absolute left-3.5 top-3 text-slate-400 text-xs"></i>
          </div>
          @if ($errors->has('email'))
            <p class="text-rose-600 text-[11px] mt-1 font-semibold">{{ $errors->first('email') }}</p>
          @endif
        </div>

        <!-- Password Input -->
        <div>
          <label for="password" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">
            পাসওয়ার্ড (Password)
          </label>
          <div class="relative">
            <input
              type="password"
              name="password"
              id="password"
              required
              autocomplete="new-password"
              placeholder="কমপক্ষে ৮ অক্ষরের পাসওয়ার্ড"
              class="w-full text-xs font-semibold pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-300 rounded-xl outline-none focus:border-indigo-600 focus:bg-white transition text-slate-800"
            />
            <i class="fas fa-lock absolute left-3.5 top-3 text-slate-400 text-xs"></i>
          </div>
          @if ($errors->has('password'))
            <p class="text-rose-600 text-[11px] mt-1 font-semibold">{{ $errors->first('password') }}</p>
          @endif
        </div>

        <!-- Confirm Password Input -->
        <div>
          <label for="password_confirmation" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">
            কনফার্ম পাসওয়ার্ড (Confirm Password)
          </label>
          <div class="relative">
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              required
              autocomplete="new-password"
              placeholder="পাসওয়ার্ডটি পুনরায় লিখুন"
              class="w-full text-xs font-semibold pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-300 rounded-xl outline-none focus:border-indigo-600 focus:bg-white transition text-slate-800"
            />
            <i class="fas fa-lock-open absolute left-3.5 top-3 text-slate-400 text-xs"></i>
          </div>
          @if ($errors->has('password_confirmation'))
            <p class="text-rose-600 text-[11px] mt-1 font-semibold">{{ $errors->first('password_confirmation') }}</p>
          @endif
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="w-full py-3 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-lg shadow-indigo-200 transition flex items-center justify-center gap-2 cursor-pointer mt-2"
        >
          <span>অ্যাকাউন্ট তৈরি করুন (Register Account)</span>
          <i class="fas fa-arrow-right text-xs"></i>
        </button>

      </form>

      <!-- Bottom Login Notice -->
      <div class="mt-5 pt-4 border-t border-slate-100 text-center">
        <p class="text-xs text-slate-500">
          ইতিমধ্যে একটি অ্যাকাউন্ট আছে?
          <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-800 hover:underline ml-1">
            লগইন করুন (Sign In Here)
          </a>
        </p>
      </div>

    </div>

  </div>
</body>
</html>
