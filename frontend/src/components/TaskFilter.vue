<template>
    <div class="filter-bar">
      <select v-model="filter" class="select">
        <option value="all">All</option>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
      </select>
      <input
        v-model="search"
        type="text"
        placeholder="Search tasks..."
        class="input"
      />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const filter = ref('all');
  const search = ref('');
  
  const applyFilters = (tasks) => {
    return tasks.filter((task) => {
      return (
        (filter.value === 'all' || task.status === filter.value) &&
        task.name.toLowerCase().includes(search.value.toLowerCase())
      );
    });
  };
  </script>