<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectPlanDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_plan_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'project_plan_id',
        'module_code',
        'module_name',
        'module_name_bn',
        'submodule_name',
        'submodule_name_bn',
        'description',
        'priority',
        'status',
        'progress_percentage',
        'estimated_days',
        'notes',
        'sort_order',
        'completed_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'progress_percentage' => 'integer',
            'estimated_days' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the parent project plan.
     *
     * @return BelongsTo<ProjectPlan, $this>
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(ProjectPlan::class, 'project_plan_id');
    }
}
