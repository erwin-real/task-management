import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import TaskManager from '@/views/TaskManager.vue';
import TaskList from '@/components/TaskList.vue';
import TaskFilter from '@/components/TaskFilter.vue';

const routes = [
    {
        path: '/',
        name: 'Login',
        component: Login,
        meta: { requiresAuth: false },
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: { requiresAuth: false },
    },
  {
    path: '/tasks',
    name: 'TaskManager',
    component: TaskManager,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        name: 'TaskList',
        component: TaskList,
      },
      {
        path: 'filter',
        name: 'TaskFilter',
        component: TaskFilter,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

// Navigation Guard
router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('authToken'); // Check auth token
  if (to.meta.requiresAuth && !isAuthenticated) {
    next({ path: '/' }); // Redirect to Login if not authenticated
  } else {
    next();
  }
});

export default router;