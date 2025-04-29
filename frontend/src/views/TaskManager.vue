<template>
    <div class="task-manager p-4">
      <!-- Header Section -->
      <header class="text-center mb-4">
        <h1 class="text-3xl font-bold">Task Manager</h1>
        <p class="text-gray-600">Organize your tasks efficiently</p>
        <div>
          <form class="space-y-4" @submit.prevent="logout">
            <button class="mt-2 w-25 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
              Logout
            </button>
          </form>
        </div>
      </header>
  
      <!-- Task Filtering -->
      <TaskFilter @updateFilter="updateFilterCriteria" />
  
      <!-- Task List -->
      <TaskList
        :tasks="filteredTasks"
        :is-admin="isAdmin"
        @markComplete="markComplete"
        @deleteTask="deleteTask"
      />
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue';
  import TaskFilter from '../components/TaskFilter.vue';
  import TaskList from '../components/TaskList.vue';
  import { useAuthStore } from '@/stores/authStore';
  import axios from 'axios';
  
  const authStore = useAuthStore();
  
  const logout = async () => {
    await authStore.logout();
  };
  
  // const tasks = ref([
  //   { id: 1, name: 'Complete project report', status: 'pending', priority: 'high' },
  //   { id: 2, name: 'Review pull requests', status: 'completed', priority: 'medium' },
  //   { id: 3, name: 'Prepare for meeting', status: 'pending', priority: 'low' },
  // ]);
  
  const tasks = ref([]);
  const isLoading = ref(true)
  const token = ref(localStorage.getItem('authToken'))
  
  const filterCriteria = ref({ status: 'all', search: '', priority: 'all' });
  const isAdmin = true; // Replace this with your authentication logic
  
  const updateFilterCriteria = (newCriteria) => {
    filterCriteria.value = newCriteria;
  };
  
  const filteredTasks = computed(() => {
    return tasks.value.filter((task) => {
      const matchesStatus =
        filterCriteria.value.status === 'all' ||
        task.status === filterCriteria.value.status;
      const matchesPriority =
        filterCriteria.value.priority === 'all' ||
        task.priority === filterCriteria.value.priority;
      const matchesSearch = task.name
        .toLowerCase()
        .includes(filterCriteria.value.search.toLowerCase());
      return matchesStatus && matchesPriority && matchesSearch;
    });
  });
  
  const markComplete = (taskId) => {
    const task = tasks.value.find((t) => t.id === taskId);
    if (task) task.status = 'completed';
  };
  
  const deleteTask = (taskId) => {
    tasks.value = tasks.value.filter((t) => t.id !== taskId);
  };

  onMounted(async () => {
      try {
        console.log("token.value", token.value)
          const response = await axios.get("http://localhost:8000/api/tasks",
            {
              headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token.value}`
            }
          })
          tasks = response.data
      } catch (error) {
          console.log('Error fetching jobs', error)
      } finally {
          isLoading.value = false
      }
  })
  </script>
  
  <style scoped>
  .task-manager {
    max-width: 800px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  </style>