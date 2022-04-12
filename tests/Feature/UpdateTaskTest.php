<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
  /** @test */
    public function authenticated_user_can_see_update_form()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->create();

        $respone = $this->get(route('tasks.edit' , $tasks->id));
        $respone->assertViewIs('tasks.edit');
    }

    /** @test */
    public function authenticated_user_can_not_update_if_name_null()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->create();
        $dataUpdate = Task::factory()->make(['name' => null ])->toArray();

        $respone = $this->post(route('tasks.update', $tasks->id),$dataUpdate);
        $respone->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function authenticated_user_can_not_view_form_update_if_id_not_valid()
    {
        $this->actingAs(User::factory()->create());
        $taskId = -1000;

        $respone = $this->get(route('tasks.edit' , $taskId));
        $respone->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function  authenticated_user_can_view_required_text_if_value_error()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->make(['name' => null])->toArray();

        $respone = $this->from(route('tasks.edit'))->post(route('tasks.update'),$tasks);
        $respone->assertRedirect(route('tasks.edit'));
    }

    /** @test */
    public function authenticated_user_can_update_if_data_valid()
    {
        $this->actingAs(User::factory()->create());
        $tasks = Task::factory()->create();
        $dataUpdate = Task::factory()->make()->toArray();

        $respone = $this->post(route('tasks.update', $tasks->id), $dataUpdate);
        $respone->assertStatus(302);
        $this->assertDatabaseHas('tasks', $dataUpdate);
        $respone->assertRedirect(route('task.index'));
    }

    /** @test  */
    public function unauthenticated_user_can_not_update()
    {
        $tasks = Task::factory()->create();
        $dataUpdate = Task::factory()->make()->toArray();

        $respone = $this->post(route('tasks.update', $tasks->id), $dataUpdate);
        $respone->assertRedirect('/login');
    }

    /** @test  */
    public function unauthenticated_user_can_not_see_update_from()
    {
        $tasks = Task::factory()->create();
        $dataUpdate = Task::factory()->make()->toArray();

        $respone = $this->get(route('tasks.edit',$tasks->id));
        $respone->assertRedirect('/login');
    }


}
