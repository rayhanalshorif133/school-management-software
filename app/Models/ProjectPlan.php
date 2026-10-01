<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectPlan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_plan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'version',
        'description',
        'status',
    ];

    /**
     * Get the details for the project plan.
     *
     * @return HasMany<ProjectPlanDetail, $this>
     */
    public function details(): HasMany
    {
        return $this->hasMany(ProjectPlanDetail::class, 'project_plan_id')->orderBy('sort_order');
    }

    /**
     * Get the completion percentage of the project plan.
     */
    public function getCompletionPercentageAttribute(): int
    {
        $total = $this->details()->count();
        if ($total === 0) {
            return 0;
        }

        $completed = $this->details()->where('status', 'completed')->count();

        return (int) round(($completed / $total) * 100);
    }
}
