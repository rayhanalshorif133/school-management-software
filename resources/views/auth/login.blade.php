<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - {{ config('app.name', 'School Management') }}</title>

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
          ডিজিটাল স্কুল ম্যানেজমেন্ট প্ল্যাটফর্ম
        </h2>
        <p class="text-xs text-indigo-200/90 mt-2 leading-relaxed">
          শিক্ষার্থী, শিক্ষক, অভিভাবক ও কর্মকর্তা কর্মচারীদের জন্য একটি সমন্বিত ও আধুনিক একাডেমিক পোর্টাল।
        </p>

        <!-- Feature List -->
        <div class="mt-6 pt-5 border-t border-indigo-800/60 space-y-2.5">
          <div class="p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-xs">
              <i class="fas fa-user-graduate"></i>
            </div>
            <div>
              <span class="font-bold text-white text-xs block">স্টুডেন্ট ও টিচার ম্যানেজমেন্ট</span>
              <span class="text-[10px] text-indigo-300">শিক্ষার্থী ও শিক্ষকদের পূর্ণাঙ্গ ডিজিটাল প্রোফাইল</span>
            </div>
          </div>

          <div class="p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-300 flex items-center justify-center text-xs">
              <i class="fas fa-calendar-check"></i>
            </div>
            <div>
              <span class="font-bold text-white text-xs block">ডিজিটাল হাজিরা ও নোটিফিকেশন</span>
              <span class="text-[10px] text-indigo-300">দৈনিক হাজিরা ট্র্যাকিং ও দ্রুত নোটিশ বোর্ড</span>
            </div>
          </div>

          <div class="p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-300 flex items-center justify-center text-xs">
              <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div>
              <span class="font-bold text-white text-xs block">ফি কালেকশন ও অ্যাকাউন্টস</span>
              <span class="text-[10px] text-indigo-300">অনলাইন ফি গ্রহণ ও স্বয়ংক্রিয় মানি রিসিট</span>
            </div>
          </div>

          <div class="p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-sky-500/20 text-sky-300 flex items-center justify-center text-xs">
              <i class="fas fa-award"></i>
            </div>
            <div>
              <span class="font-bold text-white text-xs block">পরীক্ষা, গ্রেডিং ও মার্কশিট</span>
              <span class="text-[10px] text-indigo-300">ফলাফল তৈরি ও অটোমেটিক প্রোগ্রেস রিপোর্ট</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Admin Demo Note -->
      <div class="relative z-10 pt-4 mt-6 border-t border-indigo-800/60 flex items-center justify-between text-[11px] text-indigo-200">
        <span onclick="fillDemoAdmin()" class="cursor-pointer hover:underline flex items-center gap-1.5 font-semibold text-emerald-300">
          <i class="fas fa-shield-halved"></i> ডেমো অ্যাডমিন অটো-ফিল
        </span>
        <span class="text-[10px] text-indigo-400">Click to fill</span>
      </div>

    </div>

    <!-- Right Column: Interactive Login Form -->
    <div class="lg:col-span-7 p-6 sm:p-10 flex flex-col justify-center bg-white">

      <!-- Top Title -->
      <div class="mb-5">
        <h3 class="text-2xl font-black text-slate-900 tracking-tight">লগইন পোর্টাল (Sign In)</h3>
        <p class="text-xs text-slate-500 mt-1">
          আপনার অ্যাকাউন্টে প্রবেশ করতে সঠিক ইমেইল ও পাসওয়ার্ড প্রদান করুন।
        </p>
      </div>

      <!-- Tab Switcher: Login & Registration -->
      <div class="grid grid-cols-2 gap-2 p-1.5 bg-slate-100 rounded-2xl mb-6 border border-slate-200">
        <!-- Login Tab (Active) -->
        <a
          href="{{ route('login') }}"
          class="py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-2 bg-white text-indigo-700 shadow-sm"
        >
          <i class="fas fa-right-to-bracket text-indigo-600"></i>
          <span>লগইন (Sign In)</span>
        </a>

        <!-- Registration Tab -->
        @if (Route::has('register'))
          <a
            href="{{ route('register') }}"
            class="py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-2 text-slate-600 hover:text-slate-900"
          >
            <i class="fas fa-user-plus text-slate-400"></i>
            <span>রেজিস্ট্রেশন (Register)</span>
          </a>
        @endif
      </div>

      <!-- Session Status Alert -->
      @if (session('status'))
        <div class="p-3.5 mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
          <i class="fas fa-circle-check text-emerald-600 text-sm"></i>
          <span>{{ session('status') }}</span>
        </div>
      @endif

      <!-- Error Alert Message -->
      @if ($errors->any())
        <div class="p-3.5 mb-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2">
          <i class="fas fa-circle-exclamation text-rose-600 text-sm"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <!-- Main Login Form -->
      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Input -->
        <div>
          <label for="inputEmail" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">
            ইমেইল অ্যাড্রেস (Email Address)
          </label>
          <div class="relative">
            <input
              type="email"
              name="email"
              id="inputEmail"
              required
              autofocus
              autocomplete="username"
              value="{{ old('email') }}"
              placeholder="e.g. admin@gmail.com"
              class="w-full text-xs font-semibold pl-10 pr-4 py-3 bg-slate-50 border border-slate-300 rounded-xl outline-none focus:border-indigo-600 focus:bg-white transition text-slate-800"
            />
            <i class="fas fa-envelope absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
          </div>
          @if ($errors->has('email'))
            <p class="text-rose-600 text-[11px] mt-1 font-semibold">{{ $errors->first('email') }}</p>
          @endif
        </div>

        <!-- Password Input -->
        <div>
          <div class="flex items-center justify-between mb-1">
            <label for="inputPassword" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">
              পাসওয়ার্ড (Password)
            </label>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-[11px] text-indigo-600 hover:underline">
                পাসওয়ার্ড ভুলে গেছেন?
              </a>
            @endif
          </div>
          <div class="relative">
            <input
              type="password"
              name="password"
              id="inputPassword"
              required
              autocomplete="current-password"
              placeholder="••••••••"
              class="w-full text-xs font-semibold pl-10 pr-10 py-3 bg-slate-50 border border-slate-300 rounded-xl outline-none focus:border-indigo-600 focus:bg-white transition text-slate-800"
            />
            <i class="fas fa-lock absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
            <button
              type="button"
              onclick="togglePassword()"
              class="absolute right-3.5 top-3 text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer"
            >
              <i id="eyeIcon" class="far fa-eye text-xs"></i>
            </button>
          </div>
          @if ($errors->has('password'))
            <p class="text-rose-600 text-[11px] mt-1 font-semibold">{{ $errors->first('password') }}</p>
          @endif
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between text-xs">
          <label class="inline-flex items-center gap-2 cursor-pointer text-slate-600 hover:text-slate-800 select-none">
            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            <span>মনে রাখুন (Remember me)</span>
          </label>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          id="loginSubmitBtn"
          class="w-full py-3.5 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-lg shadow-indigo-200 transition flex items-center justify-center gap-2 cursor-pointer"
        >
          <span>লগইন করুন (Sign In)</span>
          <i class="fas fa-arrow-right text-xs"></i>
        </button>

      </form>

      <!-- Bottom Registration Notice -->
      @if (Route::has('register'))
        <div class="mt-6 pt-5 border-t border-slate-100 text-center">
          <p class="text-xs text-slate-500">
            আপনার কোনো অ্যাকাউন্ট নেই?
            <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-800 hover:underline ml-1">
              নতুন অ্যাকাউন্ট খুলুন (Register Here)
            </a>
          </p>
        </div>
      @endif

    </div>

  </div>

  <!-- Client Script for Password Toggle and Auto Fill -->
  <script>
    function togglePassword() {
      const pass = document.getElementById('inputPassword');
      const eye = document.getElementById('eyeIcon');
      if (pass.type === 'password') {
        pass.type = 'text';
        eye.className = 'far fa-eye-slash text-xs';
      } else {
        pass.type = 'password';
        eye.className = 'far fa-eye text-xs';
      }
    }

    function fillDemoAdmin() {
      document.getElementById('inputEmail').value = 'admin@gmail.com';
      document.getElementById('inputPassword').value = 'admin123';
    }
  </script>
</body>
</html>
