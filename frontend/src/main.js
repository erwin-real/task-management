import '@/assets/main.css'
import router from './router'

import { createPinia } from 'pinia'
import { createApp } from 'vue'
import App from './App.vue'

const pinia = createPinia()
const app = createApp(App)
app.use(router)
// app.use(Toast)
app.mount('#app')
app.use(pinia)

// ✅ works because the pinia instance is now active