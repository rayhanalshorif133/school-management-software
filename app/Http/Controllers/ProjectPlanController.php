<?php

namespace App\Http\Controllers;

use App\Models\ProjectPlan;
use App\Models\ProjectPlanDetail;
use Database\Seeders\ProjectPlanSeeder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProjectPlanController extends Controller
{
    /**
     * Display the admin dashboard with project plan data.
     */
    public function dashboard(): View
    {
        $plan = $this->getOrCreatePlan();
        $details = $plan->details()->get();
        $stats = $this->calculateStats($plan);

        return view('dashboard', compact('plan', 'details', 'stats'));
    }

    /**
     * Display the standalone project plan view or JSON data.
     */
    public function index(Request $request): View|JsonResponse
    {
        $plan = $this->getOrCreatePlan();
        $details = $plan->details()->get();
        $stats = $this->calculateStats($plan);

        if ($request->wantsJson()) {
            return response()->json([
                'plan' => $plan,
                'details' => $details,
                'stats' => $stats,
            ]);
        }

        return view('project-plan.index', compact('plan', 'details', 'stats'));
    }

    /**
     * Render the printable / downloadable PDF document view.
     */
    public function downloadPdf(): View
    {
        $plan = $this->getOrCreatePlan();
        $details = $plan->details()->orderBy('sort_order')->get();
        $stats = $this->calculateStats($plan);
        $groupedDetails = $details->groupBy('module_code');

        return view('project-plan.pdf', compact('plan', 'details', 'stats', 'groupedDetails'));
    }

    /**
     * Download the official compiled PDF document file.
     */
    public function downloadPdfFile(): BinaryFileResponse|RedirectResponse
    {
        $pdfPath = public_path('School-Management-System-Project-Plan.pdf');

        if (! file_exists($pdfPath)) {
            Artisan::call('project-plan:export-pdf');
        }

        if (file_exists($pdfPath)) {
            return response()->download($pdfPath, 'School-Management-System-Project-Plan.pdf', [
                'Content-Type' => 'application/pdf',
            ]);
        }

        return redirect()->route('project-plan.pdf');
    }

    /**
     * Update the status and progress percentage of a plan detail.
     */
    public function updateStatus(Request $request, ProjectPlanDetail $detail): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,in_progress,completed'],
            'progress_percentage' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        $status = $validated['status'];
        $progress = $validated['progress_percentage'] ?? null;

        if ($status === 'completed') {
            $progress = 100;
            $detail->completed_at = now();
        } elseif ($status === 'pending') {
            $progress = 0;
            $detail->completed_at = null;
        } else {
            // in_progress
            if ($progress === null || $progress === 0) {
                $progress = 50;
            }
            $detail->completed_at = null;
        }

        $detail->status = $status;
        $detail->progress_percentage = $progress;
        $detail->save();

        $plan = $detail->plan;
        $stats = $this->calculateStats($plan);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'detail' => $detail,
            'stats' => $stats,
        ]);
    }

    /**
     * Store a new submodule/task detail under the active plan.
     */
    public function storeDetail(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'module_code' => ['required', 'string', 'max:50'],
            'module_name' => ['required', 'string', 'max:255'],
            'module_name_bn' => ['nullable', 'string', 'max:255'],
            'submodule_name' => ['required', 'string', 'max:255'],
            'submodule_name_bn' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'string', 'in:high,medium,low'],
            'status' => ['required', 'string', 'in:pending,in_progress,completed'],
            'progress_percentage' => ['nullable', 'integer', 'min:0', 'max:100'],
            'estimated_days' => ['nullable', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $plan = $this->getOrCreatePlan();

        $maxOrder = (int) $plan->details()->max('sort_order');

        $status = $validated['status'];
        $progress = $validated['progress_percentage'] ?? ($status === 'completed' ? 100 : ($status === 'in_progress' ? 50 : 0));

        $detail = ProjectPlanDetail::create([
            'project_plan_id' => $plan->id,
            'module_code' => $validated['module_code'],
            'module_name' => $validated['module_name'],
            'module_name_bn' => $validated['module_name_bn'] ?? null,
            'submodule_name' => $validated['submodule_name'],
            'submodule_name_bn' => $validated['submodule_name_bn'] ?? null,
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'],
            'status' => $status,
            'progress_percentage' => $progress,
            'estimated_days' => $validated['estimated_days'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'sort_order' => $maxOrder + 1,
            'completed_at' => $status === 'completed' ? now() : null,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'New plan item added successfully!',
                'detail' => $detail,
                'stats' => $this->calculateStats($plan),
            ]);
        }

        return redirect()->back()->with('status', 'New plan item added successfully!');
    }

    /**
     * Retrieve or seed the master project plan.
     */
    private function getOrCreatePlan(): ProjectPlan
    {
        $plan = ProjectPlan::first();

        if (! $plan) {
            $seeder = new ProjectPlanSeeder;
            $seeder->run();
            $plan = ProjectPlan::first();
        }

        return $plan;
    }

    /**
     * Compute statistics for the given project plan.
     *
     * @return array{
     *     total: int,
     *     completed: int,
     *     in_progress: int,
     *     pending: int,
     *     percentage: int,
     *     total_days: int
     * }
     */
    private function calculateStats(ProjectPlan $plan): array
    {
        $total = $plan->details()->count();
        $completed = $plan->details()->where('status', 'completed')->count();
        $inProgress = $plan->details()->where('status', 'in_progress')->count();
        $pending = $plan->details()->where('status', 'pending')->count();
        $totalDays = (int) $plan->details()->sum('estimated_days');

        $percentage = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

        return [
            'total' => $total,
            'completed' => $completed,
            'in_progress' => $inProgress,
            'pending' => $pending,
            'percentage' => $percentage,
            'total_days' => $totalDays,
        ];
    }
}
