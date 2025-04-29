  <script setup>
  import { ref } from 'vue';
  import { useAuthStore } from '@/stores/authStore';
  
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const c_password = ref('');
  
  const authStore = useAuthStore();
  
  const register = async () => {
    await authStore.register(name.value, email.value, password.value, c_password.value);
  };
  </script>
  
  <template>
    <div class="container mx-auto py-8">
      <h1 class="text-2xl font-bold mb-6 text-center">Registration Form</h1>
      <form @submit.prevent="register" class="w-full max-w-sm mx-auto bg-white p-8 rounded-md shadow-md">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
          <input 
            v-model="name"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
            type="text" id="name" name="name" placeholder="John Doe">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
          <input 
            v-model="email"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
            type="email" id="email" name="email" placeholder="john@example.com">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
          <input 
            v-model="password"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
            type="password" id="password" name="password" placeholder="********">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="c_password">Confirm Password</label>
          <input
            v-model="c_password"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
            type="password" id="c_password" name="c_password" placeholder="********">
        </div>
        <button
          class="w-full bg-indigo-500 text-white text-sm font-bold py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300"
          type="submit">
          Register
        </button>
      </form>

      <div class="mt-6 text-center text-sm text-gray-600">
        Already have an account?
        <RouterLink :to="`/`" class="text-indigo-600 hover:text-indigo-500 font-medium">Sign in</RouterLink>
      </div>
    </div>
  </template>