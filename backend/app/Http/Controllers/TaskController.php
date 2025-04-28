<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function indexAdmin()
    {
        return response()->json($this->taskService->getAllTasks());
    }

    public function index()
    {
        return response()->json(['data' => $this->taskService->getUserTasks()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'priority' => 'required|in:low,medium,high',
            'order' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
        ]);

        return response()->json($this->taskService->createTask($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->taskService->getTask($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:pending,completed',
            'priority' => 'nullable|in:low,medium,high',
            'order' => 'nullable|integer',
        ]);

        return response()->json($this->taskService->updateTask($data, $id));
    }

    public function destroy($id)
    {
        $this->taskService->deleteTask($id);
        return response()->json(['message' => 'Task deleted successfully!']);
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'order' => 'required|array',
        ]);

        $this->taskService->reorderTasks($data['order']);

        return response()->json(['message' => 'Tasks reordered successfully']);
    }

}
