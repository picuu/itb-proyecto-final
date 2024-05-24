import '@/assets/style/main.css'
import '@fontsource-variable/onest'

import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import App from './App.vue'
import router from './router'
import VCalendar from 'v-calendar'
import 'v-calendar/style.css'
import { setupCalendar, Calendar, DatePicker } from 'v-calendar'
import 'v-calendar/style.css'

const vuetify = createVuetify({
  components,
  directives,
})

const app = createApp(App)

app.use(vuetify)
app.use(router)
app.use(VCalendar, {})
app.component('VCalendar', Calendar)
app.component('VDatePicker', DatePicker)
app.mount('#app')
