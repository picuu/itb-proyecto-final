import '@/assets/style/main.css'
import '@fontsource-variable/onest'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import VCalendar from 'v-calendar'
import 'v-calendar/style.css'
import { setupCalendar, Calendar, DatePicker } from 'v-calendar'
import 'v-calendar/style.css'

const app = createApp(App)

app.use(router)
app.use(VCalendar, {})
app.component('VCalendar', Calendar)
app.component('VDatePicker', DatePicker)
app.mount('#app')
