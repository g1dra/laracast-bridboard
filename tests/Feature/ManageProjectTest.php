<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here'
        ];

        $response = $this->post('/projects', $attributes);
        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_view_project_page()
    {
        $this->signIn();
        $project = Project::factory()->create(['user_id' => auth()->id()]);
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_auth_user_cant_view_project_of_others()
    {
        $this->signIn();
        $project = Project::factory()->create();
        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_auth_user_cant_update_project_of_Others()
    {
        $this->signIn();
        $project = Project::factory()->create();
        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
       $this->signIn();
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();
        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_project_requires_owner()
    {
        $attributes = Project::factory()->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $project = Project::factory()->create(['user_id'=> auth()->id()]);

        $this->patch($project->path(), [
            'notes' => 'Changed'
        ])->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', ['notes' => 'Changed']);
    }
}
