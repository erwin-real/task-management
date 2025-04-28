<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $adminUser;
    protected $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin and regular users
        $this->adminUser = User::factory()->create(['is_admin' => true]);
        $this->regularUser = User::factory()->create();
    }

    /** @test */
    public function it_can_create_a_task()
    {
        $this->actingAs($this->regularUser, 'sanctum');

        $response = $this->postJson('/api/tasks', [
            'title' => 'Sample Task',
            'description' => 'This is a sample task description.',
            'status' => 'pending',
            'priority' => 'medium',
            'order' => 1,
            'user_id' => 1,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', ['title' => 'Sample Task']);
    }

    /** @test */
    public function it_can_read_a_single_task()
    {
        $task = Task::factory()->create();

        $this->actingAs($this->regularUser, 'sanctum');

        $response = $this->getJson("/api/tasks/{$task->id}");
        $response->assertStatus(200)->assertJson(['id' => $task->id]);
    }

    /** @test */
    public function it_can_get_all_tasks()
    {
        Task::factory()->count(5)->create();

        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)->assertJsonCount(5, 'data');
    }

    /** @test */
    public function admin_can_get_all_tasks()
    {
        Task::factory()->count(5)->create();

        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->getJson('/api/tasks/admin');
        $response->assertStatus(200)->assertJsonCount(2, 'original.data');
    }

    /** @test */
    public function admin_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $this->actingAs($this->adminUser, 'sanctum');

        $response = $this->deleteJson("/api/tasks/{$task->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create(['title' => 'Old Task Title']);

        $this->actingAs($this->regularUser, 'sanctum');

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Task Title',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['title' => 'Updated Task Title']);
    }

    /** @test */
    public function it_can_reorder_tasks()
    {
        $tasks = Task::factory()->count(5)->create();

        $newOrder = $tasks->pluck('id')->shuffle()->toArray(); // Shuffle task IDs

        $this->actingAs($this->regularUser, 'sanctum');

        $response = $this->postJson('/api/tasks/reorder', [
            'order' => $newOrder,
        ]);

        $response->assertStatus(200)->assertJson(['message' => 'Tasks reordered successfully']);

        foreach ($newOrder as $order => $taskId) {
            $this->assertDatabaseHas('tasks', [
                'id' => $taskId,
                'order' => $order,
            ]);
        }
    }


}
