import './bootstrap';
import { createApp } from 'vue'
import App from '../js/App.vue'
import '../css/app.css'
import router from './router'
import 'v-calendar/dist/style.css'



createApp(App).use(router).mount('#app')
