<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllUsersWithTheirTasks();
    public function getAllTasks();
    public function getUserTasks();
    public function getTask(int $id);
    public function createTask(array $data);
    public function updateTask(int $id, array $data);
    public function deleteTask(int $id);
    public function reorderTasks(string $idsString, string $caseString);
}