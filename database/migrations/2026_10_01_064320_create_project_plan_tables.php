<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_plan', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('version')->default('1.0.0');
            $table->text('description')->nullable();
            $table->string('status')->default('in_progress'); // planned, in_progress, completed
            $table->timestamps();
        });

        Schema::create('project_plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_plan_id')->constrained('project_plan')->onDelete('cascade');
            $table->string('module_code')->default('MOD-01');
            $table->string('module_name');
            $table->string('module_name_bn')->nullable();
            $table->string('submodule_name');
            $table->string('submodule_name_bn')->nullable();
            $table->text('description')->nullable();
            $table->string('priority')->default('high'); // high, medium, low
            $table->string('status')->default('pending'); // pending, in_progress, completed
            $table->unsignedTinyInteger('progress_percentage')->default(0);
            $table->unsignedSmallInteger('estimated_days')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_plan_details');
        Schema::dropIfExists('project_plan');
    }
};
