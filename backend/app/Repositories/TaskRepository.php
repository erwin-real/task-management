<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use App\Models\User;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllUsersWithTheirTasks()
    {
        return User::with(['tasks'])->paginate(10);
    }

    public function getAllTasks()
    {
        return Task::all();
    }

    public function getUserTasks()
    {
        return Auth::user()->tasks;
    }

    public function getTask(int $id)
    {
        return Task::findOrFail($id);
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTask(int $id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }

    public function reorderTasks(string $idsString, string $caseString)
    {
        $query = "UPDATE tasks SET `order` = CASE $caseString END WHERE id IN ($idsString)";

        \DB::statement($query);
    }

}
