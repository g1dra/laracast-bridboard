<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function task_belongs_to_project()
    {
        $this->withoutExceptionHandling();
        $task = Task::factory()->create();
        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test */
    public function task_has_a_path()
    {
        $task = Task::factory()->create();

        $this->assertEquals('/project/' . $task->project->id . '/tasks/' . $task->id, $task->path());
    }
}
