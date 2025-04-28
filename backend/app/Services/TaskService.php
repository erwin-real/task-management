<?php

namespace App\Services;

use App\Interfaces\TaskInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskService
{
    protected $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepositoryInterface = $taskRepositoryInterface;
    }

    public function getAllTasks()
    {
        return cache()->remember('tasks', 60, function () {
            $users = $this->taskRepositoryInterface->getAllUsersWithTheirTasks();

            return response()->json([
                'data' => $users->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'total_tasks' => $user->tasks->count(),
                        'completed_tasks' => $user->tasks->where('status', 'completed')->count(),
                        'pending_tasks' => $user->tasks->where('status', 'pending')->count(),
                    ];
                }),
                'pagination' => [
                    'total' => $users->total(),
                    'per_page' => $users->perPage(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                ],
            ]);


        });
    }

    public function getUserTasks()
    {
        return cache()->remember('tasks', 60, function () {
            return $this->taskRepositoryInterface->getUserTasks();
        });
    }

    public function getTask($id)
    {
        return $this->taskRepositoryInterface->getTask($id);
    }

    public function createTask($data)
    {
        return $this->taskRepositoryInterface->createTask($data);
    }

    public function updateTask($data, $id)
    {
        return $this->taskRepositoryInterface->updateTask($id, $data);
    }

    public function deleteTask($id)
    {
        return $this->taskRepositoryInterface->deleteTask($id);
    }

    public function reorderTasks($taskOrder)
    {
        $caseStatements = [];
        $ids = [];

        foreach ($taskOrder as $order => $taskId) {
            $ids[] = $taskId;
            $caseStatements[] = "WHEN id = $taskId THEN $order";
        }

        $idsString = implode(',', $ids);
        $caseString = implode(' ', $caseStatements);

        $this->taskRepositoryInterface->reorderTasks($idsString, $caseString);

        return response()->json(['message' => 'Tasks reordered successfully']);
    }

}