import { defineStore } from 'pinia';
import axios from 'axios';
import router from '@/router';

export const useAuthStore = defineStore('authStore', {
  state: () => ({
    user: null,
    token: null,
  }),
  actions: {
    async login(email, password) {
      const response = await axios.post('http://localhost:8000/api/auth/login', { email, password });
      this.token = response.data.accessToken;
      this.user = response.data.user;
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      localStorage.setItem('user', JSON.stringify(this.user));
      localStorage.setItem('authToken', JSON.stringify(this.token));
      router.push(this.returnUrl || '/tasks');
    },
    logout() {
      this.user = null;
      localStorage.removeItem('user');
      localStorage.removeItem('authToken');
      router.push('/');
    },
    
    async register(name, email, password, c_password) {
      if (password === c_password) {
        const response = await axios.post('http://localhost:8000/api/auth/register', { name, email, password, c_password });
        this.token = response.data.accessToken;
        this.user = response.data.user;
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        localStorage.setItem('user', JSON.stringify(this.user));
        localStorage.setItem('authToken', JSON.stringify(this.token));
        router.push('/tasks');
      }
    }
  },
});