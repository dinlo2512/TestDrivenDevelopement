<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetTaskTest extends TestCase
{
   /** @test */
    public function authenticated_user_can_get_task_if_id_valid()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->create();

        $response = $this->get(route('tasks.show', $tasks->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.show');
        $response->assertSee($tasks->name);
    }

    /** @test */
    public function authenticated_user_can_not_get_task_if_id_invalid()
    {
        $this->actingAs(User::factory()->create());
        $tasksId = -1000;

        $response = $this->get(route('tasks.show', $tasksId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }


}
