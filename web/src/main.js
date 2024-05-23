import '@/assets/style/main.css'
import '@fontsource-variable/onest'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(router)

app.mount('#app')
