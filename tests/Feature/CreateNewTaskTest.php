<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateNewTaskTest extends TestCase
{
    public function getCreateRoute()
    {
        return route('tasks.store');
    }
   /** @test */
    public function authenticated_user_can_new_task()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->make()->toArray();

        $respone = $this->post($this->getCreateRoute(), $tasks);
        $respone->assertStatus(302);
        $this->assertDatabaseHas('tasks', $tasks);
        $respone->assertRedirect(route('task.index'));
    }

    /** @test */
    public function unauthenticated_user_can_not_create_new_task()
    {
        $tasks = Task::factory()->make()->toArray();

        $respone = $this->post($this->getCreateRoute(), $tasks);
        $respone->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_not_create_if_name_null()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->make(['name' => null])->toArray();

        $respone = $this->post($this->getCreateRoute(), $tasks);
        $respone->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_can_view_form_create_new_task()
    {
        $this->actingAs(User::factory()->create());

        $respone = $this->get(route('tasks.create'));
        $respone->assertViewIs('tasks.create');
    }

    /** @test */
    public function  authenticated_user_can_view_required_text_if_value_error()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->make(['name' => null])->toArray();

        $respone = $this->from(route('tasks.create'))->post($this->getCreateRoute(),$tasks);
        $respone->assertRedirect(route('tasks.create'));
    }

    /** @test */
    public function unauthenticated_can_not_see_create_form_view()
    {
        $tasks = Task::factory()->make()->toArray();

        $respone = $this->get(route('tasks.create'));
        $respone->assertRedirect('/login');
    }
}
