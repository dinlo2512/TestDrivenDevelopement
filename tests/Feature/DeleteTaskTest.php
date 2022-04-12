<?php

namespace Tests\Feature;


use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;


class DeleteTaskTest extends TestCase
{
   /** @test */
    public function autheticated_user_can_not_delete_if_id_not_valid()
    {
        $this->actingAs(User::factory()->create());
        $tasksId = -10000;

        $response = $this->get(route('tasks.delete', $tasksId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function autheticated_user_can_delete_if_id_valid()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->create();
        $countBefore = Task::count();

        $response = $this->get(route('tasks.delete', $tasks->id));
        $countAfter = Task::count();
        $this->assertEquals($countBefore - 1, $countAfter);
        $response->assertStatus(302);
        $response->assertRedirect(route('task.index'));
    }

    /** @test */
    public function unautheticated_user_can_not_delete_if_id_not_valid()
    {
        $tasks = Task::factory()->create();

        $response = $this->get(route('tasks.delete', $tasks->id));
        $response->assertRedirect('/login');
    }
}
