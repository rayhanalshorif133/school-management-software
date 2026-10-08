<?php

namespace App\Console\Commands;

use App\Models\ProjectPlan;
use Database\Seeders\ProjectPlanSeeder;
use Illuminate\Console\Command;

class ExportProjectPlanPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project-plan:export-pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Render and export the master project plan document as an ultra-high quality PDF file';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        //
        $this->info('Starting Project Plan PDF generation...');

        // 1. Get or seed plan
        $plan = ProjectPlan::first();
        if (! $plan) {
            $this->warn('Project plan not found. Seeding initial plan...');
            $seeder = new ProjectPlanSeeder;
            $seeder->run();
            $plan = ProjectPlan::first();
        }

        // 2. Fetch details & stats
        $details = $plan->details()->orderBy('sort_order')->get();
        $total = $details->count();
        $completed = $details->where('status', 'completed')->count();
        $inProgress = $details->where('status', 'in_progress')->count();
        $pending = $details->where('status', 'pending')->count();
        $totalDays = (int) $details->sum('estimated_days');
        $percentage = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

        $stats = [
            'total' => $total,
            'completed' => $completed,
            'in_progress' => $inProgress,
            'pending' => $pending,
            'percentage' => $percentage,
            'total_days' => $totalDays,
        ];

        $groupedDetails = $details->groupBy('module_code');

        // 3. Render HTML document
        $html = view('project-plan.pdf', [
            'plan' => $plan,
            'details' => $details,
            'stats' => $stats,
            'groupedDetails' => $groupedDetails,
            'isPdfMode' => true,
        ])->render();

        // 4. Save HTML to public and public/HTML
        $tempHtmlPath = public_path('project-plan-document.html');
        file_put_contents($tempHtmlPath, $html);

        $htmlPublicFolder = public_path('HTML');
        if (! is_dir($htmlPublicFolder)) {
            mkdir($htmlPublicFolder, 0755, true);
        }
        file_put_contents(public_path('HTML/project-plan-document.html'), $html);

        $this->info('HTML documents generated at:');
        $this->line(' - '.$tempHtmlPath);
        $this->line(' - '.public_path('HTML/project-plan-document.html'));

        // 5. Output PDF destination
        $pdfPath = public_path('School-Management-System-Project-Plan.pdf');

        // Check Chrome or Edge
        $chromePaths = [
            'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
            'C:\\Program Files\\Microsoft\\Edge\\Application\\msedge.exe',
        ];

        $browserBinary = null;
        foreach ($chromePaths as $path) {
            if (file_exists($path)) {
                $browserBinary = $path;
                break;
            }
        }

        if ($browserBinary) {
            $this->info("Found browser binary: {$browserBinary}");
            $this->info("Rendering PDF to: {$pdfPath}...");

            $safeHtmlPath = str_replace('/', '\\', $tempHtmlPath);
            $safePdfPath = str_replace('/', '\\', $pdfPath);

            $powershellCmd = sprintf(
                "Start-Process -FilePath '%s' -ArgumentList '--headless', '--disable-gpu', '--no-sandbox', '--run-all-compositor-stages-before-draw', '--print-to-pdf=%s', '%s' -Wait",
                $browserBinary,
                $safePdfPath,
                $safeHtmlPath
            );

            exec('powershell -NoProfile -Command "'.addslashes($powershellCmd).'"', $output, $returnVar);

            if (file_exists($pdfPath) && filesize($pdfPath) > 0) {
                $fileSizeKb = round(filesize($pdfPath) / 1024, 1);
                $this->info("SUCCESS! Project Plan PDF generated successfully ({$fileSizeKb} KB)");
                $this->line("Location: {$pdfPath}");

                return Command::SUCCESS;
            } else {
                $this->warn('Headless browser command finished, but PDF file was not detected.');
            }
        } else {
            $this->warn('Chrome or Edge was not detected on system PATH or default directories.');
        }

        $this->info('The printable HTML document is ready and can be exported at any time.');

        return Command::SUCCESS;
    }
}
