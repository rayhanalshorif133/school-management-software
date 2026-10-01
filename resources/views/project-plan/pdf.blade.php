<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Plan Document - School Management System</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', 'Hind Siliguri', sans-serif;
    }
    @media print {
      .no-print {
        display: none !important;
      }
      body {
        background: #ffffff !important;
        color: #000000 !important;
        font-size: 11px;
      }
      .page-break {
        page-break-before: always;
      }
      @page {
        margin: 12mm 15mm;
        size: A4 portrait;
      }
    }
  </style>
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen py-8 px-4 sm:px-8">

  <!-- Floating Action Bar (Hidden in Print) -->
  <div class="no-print max-w-5xl mx-auto mb-6 flex items-center justify-between bg-white p-4 rounded-2xl shadow-md border border-slate-200">
    <div class="flex items-center gap-3">
      <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
      </a>
      <div>
        <h2 class="text-sm font-black text-slate-800">Project Plan Export & Printable Document</h2>
        <p class="text-xs text-slate-400">Save as PDF directly using your browser's Print dialog</p>
      </div>
    </div>
    <div class="flex items-center gap-2">
      <button onclick="window.print()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-200 transition flex items-center gap-2 cursor-pointer">
        <i class="fas fa-file-pdf"></i> Download PDF / Print Document
      </button>
    </div>
  </div>

  <!-- Document Paper Container -->
  <main class="max-w-5xl mx-auto bg-white p-8 sm:p-12 rounded-3xl shadow-xl border border-slate-200 print:shadow-none print:border-none print:p-0">

    <!-- Document Header -->
    <header class="border-b-2 border-indigo-600 pb-6 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl shadow-md">
          <i class="fas fa-school"></i>
        </div>
        <div>
          <span class="text-[10px] font-extrabold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-full border border-indigo-100">
            Official System Roadmap & Specification
          </span>
          <h1 class="text-2xl font-black text-slate-900 tracking-tight mt-1">
            {{ $plan->title }}
          </h1>
          <p class="text-xs text-slate-500 font-medium">
            Smart Digital School & Academic Administration Enterprise Platform
          </p>
        </div>
      </div>

      <div class="text-left sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-100 text-xs">
        <div class="font-bold text-slate-800">Document Version: <span class="text-indigo-600 font-mono">{{ $plan->version }}</span></div>
        <div class="text-slate-500 mt-0.5">Generated: {{ now()->format('d F, Y - h:i A') }}</div>
        <div class="mt-1.5 inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-indigo-100 text-indigo-800 border border-indigo-200">
          <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
          Status: {{ ucfirst(str_replace('_', ' ', $plan->status)) }}
        </div>
      </div>
    </header>

    <!-- Executive Progress Overview -->
    <section class="mb-8">
      <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-3">Executive Summary & Milestone Health</h3>

      <!-- 4 Stat Metric Cards -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
          <span class="text-[10px] font-bold text-slate-400 uppercase block">Total Plan Items</span>
          <span class="text-2xl font-black text-slate-900">{{ $stats['total'] }}</span>
          <span class="text-[10px] text-slate-500 block mt-0.5">Across 12 core modules</span>
        </div>

        <div class="bg-emerald-50/80 p-4 rounded-2xl border border-emerald-200/70">
          <span class="text-[10px] font-bold text-emerald-700 uppercase block">Completed Tasks</span>
          <span class="text-2xl font-black text-emerald-800">{{ $stats['completed'] }}</span>
          <span class="text-[10px] text-emerald-600 font-bold block mt-0.5">Verified & Live</span>
        </div>

        <div class="bg-amber-50/80 p-4 rounded-2xl border border-amber-200/70">
          <span class="text-[10px] font-bold text-amber-700 uppercase block">In Progress</span>
          <span class="text-2xl font-black text-amber-800">{{ $stats['in_progress'] }}</span>
          <span class="text-[10px] text-amber-600 font-bold block mt-0.5">Active development</span>
        </div>

        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
          <span class="text-[10px] font-bold text-slate-500 uppercase block">Pending Backlog</span>
          <span class="text-2xl font-black text-slate-700">{{ $stats['pending'] }}</span>
          <span class="text-[10px] text-slate-400 block mt-0.5">Scheduled sprints</span>
        </div>
      </div>

      <!-- Overall Progress Bar -->
      <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
        <div class="flex justify-between items-center text-xs font-bold mb-1.5">
          <span class="text-slate-700">Overall School Management Software Completion</span>
          <span class="text-indigo-600 font-extrabold text-sm">{{ $stats['percentage'] }}%</span>
        </div>
        <div class="w-full bg-slate-200 h-3 rounded-full overflow-hidden">
          <div class="bg-indigo-600 h-3 rounded-full transition-all duration-500" style="width: {{ $stats['percentage'] }}%"></div>
        </div>
        <div class="flex justify-between items-center text-[10px] text-slate-400 mt-1.5">
          <span>{{ $stats['completed'] }} of {{ $stats['total'] }} deliverables completed</span>
          <span>Estimated Total Workload: {{ $stats['total_days'] }} Days</span>
        </div>
      </div>
    </section>

    <!-- Detailed Modules Table -->
    <section class="mb-10">
      <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-3">Detailed Modular Implementation Breakdown</h3>

      @foreach ($groupedDetails as $moduleName => $items)
        <div class="mb-6 border border-slate-200 rounded-2xl overflow-hidden shadow-xs">
          <!-- Module Header -->
          <div class="bg-slate-100/90 px-4 py-2.5 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-2">
              <span class="px-2 py-0.5 rounded-md bg-indigo-600 text-white font-mono text-[10px] font-bold">
                {{ $items->first()->module_code }}
              </span>
              <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm">
                {{ $moduleName }}
                @if ($items->first()->module_name_bn)
                  <span class="text-slate-500 font-normal">({{ $items->first()->module_name_bn }})</span>
                @endif
              </h4>
            </div>
            <span class="text-[10px] font-bold text-slate-500">
              {{ $items->where('status', 'completed')->count() }}/{{ $items->count() }} Done
            </span>
          </div>

          <!-- Items Table -->
          <table class="w-full text-left text-xs">
            <thead>
              <tr class="bg-slate-50 text-slate-400 font-bold uppercase text-[9px] tracking-wider border-b border-slate-200">
                <th class="py-2 px-3 w-10">#</th>
                <th class="py-2 px-3">Submodule & Technical Scope</th>
                <th class="py-2 px-3 w-20 text-center">Priority</th>
                <th class="py-2 px-3 w-28 text-center">Status</th>
                <th class="py-2 px-3 w-28 text-center">Progress</th>
                <th class="py-2 px-3 w-20 text-right">Est. Days</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
              @foreach ($items as $item)
                <tr class="hover:bg-slate-50/50">
                  <td class="py-2.5 px-3 font-mono font-bold text-slate-400 text-[10px]">{{ $loop->iteration }}</td>
                  <td class="py-2.5 px-3">
                    <div class="font-bold text-slate-900 leading-tight">
                      {{ $item->submodule_name }}
                      @if ($item->submodule_name_bn)
                        <span class="text-slate-500 font-normal text-[11px] block sm:inline"> • {{ $item->submodule_name_bn }}</span>
                      @endif
                    </div>
                    @if ($item->description)
                      <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $item->description }}</p>
                    @endif
                    @if ($item->notes)
                      <span class="text-[10px] text-indigo-600 font-medium italic block mt-0.5"><i class="fas fa-info-circle mr-1"></i>Note: {{ $item->notes }}</span>
                    @endif
                  </td>
                  <td class="py-2.5 px-3 text-center">
                    @if ($item->priority === 'high')
                      <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-rose-100 text-rose-800 border border-rose-200">HIGH</span>
                    @elseif ($item->priority === 'medium')
                      <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-sky-100 text-sky-800 border border-sky-200">MEDIUM</span>
                    @else
                      <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-slate-100 text-slate-700 border border-slate-200">LOW</span>
                    @endif
                  </td>
                  <td class="py-2.5 px-3 text-center">
                    @if ($item->status === 'completed')
                      <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                        <i class="fas fa-check-circle text-[9px]"></i> Completed
                      </span>
                    @elseif ($item->status === 'in_progress')
                      <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                        <i class="fas fa-spinner fa-spin text-[9px]"></i> In Progress
                      </span>
                    @else
                      <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                        <i class="fas fa-clock text-[9px]"></i> Pending
                      </span>
                    @endif
                  </td>
                  <td class="py-2.5 px-3 text-center">
                    <div class="flex items-center gap-2 justify-center">
                      <div class="w-16 bg-slate-200 h-1.5 rounded-full overflow-hidden">
                        <div class="h-1.5 rounded-full {{ $item->status === 'completed' ? 'bg-emerald-500' : ($item->status === 'in_progress' ? 'bg-amber-500' : 'bg-slate-300') }}" style="width: {{ $item->progress_percentage }}%"></div>
                      </div>
                      <span class="font-mono text-[10px] font-bold text-slate-600">{{ $item->progress_percentage }}%</span>
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
      @endforeach
    </section>

    <!-- Signatures & Approval Footer -->
    <footer class="pt-8 border-t border-slate-200 mt-12 grid grid-cols-3 gap-8 text-center text-xs">
      <div>
        <div class="border-b border-slate-300 pb-1 mb-1 font-bold text-slate-800">Lead Software Architect</div>
        <span class="text-[10px] text-slate-400">Technical Approval & Review</span>
      </div>
      <div>
        <div class="border-b border-slate-300 pb-1 mb-1 font-bold text-slate-800">Project Manager / Scrum Master</div>
        <span class="text-[10px] text-slate-400">Sprint Tracking & Delivery</span>
      </div>
      <div>
        <div class="border-b border-slate-300 pb-1 mb-1 font-bold text-slate-800">Principal / Institutional Head</div>
        <span class="text-[10px] text-slate-400">Client Sign-off & Verification</span>
      </div>
    </footer>

    <!-- Document Print Footer -->
    <div class="text-center text-[10px] text-slate-400 mt-8 pt-4 border-t border-slate-100">
      School Management System Enterprise Edition • Generated automatically from Database • Confidential
    </div>

  </main>

</body>
</html>
