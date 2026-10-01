<?php

use App\Models\ProjectPlan;
use App\Models\ProjectPlanDetail;
use App\Models\User;

test('guests are redirected to login when visiting project plan or dashboard', function () {
    $this->get('/dashboard')->assertRedirect('/login');
    $this->get('/project-plan')->assertRedirect('/login');
    $this->get('/project-plan/pdf')->assertRedirect('/login');
});

test('authenticated user can view dashboard with project plan loaded', function () {
    $user = User::factory()->create();

    $plan = ProjectPlan::create([
        'title' => 'School Management Plan',
        'version' => '1.0.0',
        'status' => 'in_progress',
    ]);

    ProjectPlanDetail::create([
        'project_plan_id' => $plan->id,
        'module_code' => 'MOD-01',
        'module_name' => 'Authentication',
        'module_name_bn' => 'অথেনটিকেশন',
        'submodule_name' => 'Multi-role Auth',
        'submodule_name_bn' => 'মাল্টি-রোল অথেনটিকেশন',
        'priority' => 'high',
        'status' => 'completed',
        'estimated_days' => 2,
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
    $response->assertSee('School Management Plan');
    $response->assertSee('MOD-01');
    $response->assertSee('Multi-role Auth');
});

test('authenticated user can view printable pdf project plan document', function () {
    $user = User::factory()->create();

    $plan = ProjectPlan::create([
        'title' => 'School Management Plan',
        'version' => '1.0.0',
        'status' => 'in_progress',
    ]);

    ProjectPlanDetail::create([
        'project_plan_id' => $plan->id,
        'module_code' => 'MOD-01',
        'module_name' => 'Authentication',
        'module_name_bn' => 'অথেনটিকেশন',
        'submodule_name' => 'Multi-role Auth',
        'submodule_name_bn' => 'মাল্টি-রোল অথেনটিকেশন',
        'priority' => 'high',
        'status' => 'completed',
        'estimated_days' => 2,
    ]);

    $response = $this->actingAs($user)->get('/project-plan/pdf');

    $response->assertStatus(200);
    $response->assertSee('School Management Plan');
    $response->assertSee('MOD-01');
});

test('authenticated user can update submodule status via patch request', function () {
    $user = User::factory()->create();

    $plan = ProjectPlan::create([
        'title' => 'School Management Plan',
        'version' => '1.0.0',
        'status' => 'in_progress',
    ]);

    $detail = ProjectPlanDetail::create([
        'project_plan_id' => $plan->id,
        'module_code' => 'MOD-02',
        'module_name' => 'Student SIS',
        'module_name_bn' => 'শিক্ষার্থী তথ্য',
        'submodule_name' => 'Student Admission',
        'submodule_name_bn' => 'শিক্ষার্থী ভর্তি',
        'priority' => 'high',
        'status' => 'in_progress',
        'estimated_days' => 4,
    ]);

    $response = $this->actingAs($user)->patchJson("/project-plan/details/{$detail->id}/status", [
        'status' => 'completed',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
    ]);

    $this->assertDatabaseHas('project_plan_details', [
        'id' => $detail->id,
        'status' => 'completed',
        'progress_percentage' => 100,
    ]);
});

test('submodule status update validates allowed status values', function () {
    $user = User::factory()->create();

    $plan = ProjectPlan::create([
        'title' => 'School Management Plan',
        'version' => '1.0.0',
        'status' => 'in_progress',
    ]);

    $detail = ProjectPlanDetail::create([
        'project_plan_id' => $plan->id,
        'module_code' => 'MOD-02',
        'module_name' => 'Student SIS',
        'module_name_bn' => 'শিক্ষার্থী তথ্য',
        'submodule_name' => 'Student Admission',
        'submodule_name_bn' => 'শিক্ষার্থী ভর্তি',
        'priority' => 'high',
        'status' => 'in_progress',
    ]);

    $response = $this->actingAs($user)->patchJson("/project-plan/details/{$detail->id}/status", [
        'status' => 'invalid_status_value',
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['status']);
});

test('authenticated user can store a new project plan submodule task', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/project-plan/details', [
        'module_code' => 'MOD-13',
        'module_name' => 'Alumni Network',
        'module_name_bn' => 'প্রাক্তন শিক্ষার্থী নেটওয়ার্ক',
        'submodule_name' => 'Alumni Directory & Reunions',
        'submodule_name_bn' => 'প্রাক্তন শিক্ষার্থী ডিরেক্টরি',
        'priority' => 'medium',
        'status' => 'pending',
        'estimated_days' => 3,
        'description' => 'Directory of graduated alumni with communication tools.',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
    ]);

    $this->assertDatabaseHas('project_plan_details', [
        'module_code' => 'MOD-13',
        'submodule_name' => 'Alumni Directory & Reunions',
        'status' => 'pending',
    ]);
});
