<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_task_can_be_added()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $task = [
            'description' => 'asodijasoidajsd',
            'user_id' => $user->id,
        ];

        $this->actingAs($user)
            ->post(route('tasks.store', $task))
            ->assertSessionHas('message', 'Tarefa cadastrada com sucesso!');
    }
}
