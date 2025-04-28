<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class DeleteOldTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete tasks older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('created_at', '<', now()->subDays(30))->get();

        foreach ($tasks as $task) {
            $task->delete();
            \Log::info('Deleted task ID: ' . $task->id);
        }

    }
}
