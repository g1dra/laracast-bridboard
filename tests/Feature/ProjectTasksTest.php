<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = Project::factory()->create();
        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create(); // project is generated with new user
        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = Project::factory()->create(['user_id' => auth()->id()]);

        $this->post($project->path() . '/tasks',
            ['body' => 'Test task']);

        // todo not working
        $this->get($project->path())->assertStatus(200);
        $this->get($project->path())
            ->assertSee('Test task');

    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $project = app(ProjectFactory::class)
            ->ownedBy($this->signIn())
            ->withTasks(1)
            ->create();

        $task = $project->addTask('test task');
        $this->patch($task->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    function only_the_owner_of_a_project_may_update_tasks()
    {
        $this->signIn();
        /*$project = Project::factory()->create(); // project is generated with new user

        $task = $project->addTask('test task');*/

        $project = app(ProjectFactory::class)->withTasks(1)->create();

        $this->patch($project->path() . '/tasks/' . $project->tasks[0], ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }
}
