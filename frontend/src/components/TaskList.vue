<template>
    <div class="task-list">
      <div
        v-for="task in tasks"
        :key="task.id"
        class="task-item flex justify-between items-center p-4"
        :class="{
          'bg-green-100': task.status === 'completed',
          'bg-yellow-100': task.priority === 'high',
        }"
      >
        <div>
          <p>{{ task.name }}</p>
          <span class="text-gray-500 text-sm">{{ task.priority }}</span>
        </div>
        <div>
          <button
            @click="markComplete(task.id)"
            v-if="task.status !== 'completed'"
            class="btn"
          >
            Complete
          </button>
          <button @click="deleteTask(task.id)" v-if="isAdmin" class="btn-danger">
            Delete
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const tasks = ref([
    { id: 1, name: 'Task 1', status: 'pending', priority: 'high' },
    { id: 2, name: 'Task 2', status: 'completed', priority: 'medium' },
  ]);
  
  const isAdmin = true;
  
  const markComplete = (id) => {
    const task = tasks.value.find((task) => task.id === id);
    if (task) task.status = 'completed';
  };
  
  const deleteTask = (id) => {
    tasks.value = tasks.value.filter((task) => task.id !== id);
  };
  </script>
  
  <style>
  /* Additional styling if needed */
  </style>