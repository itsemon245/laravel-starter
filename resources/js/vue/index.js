import { createApp } from "vue";
import App from './App.vue';

const app = createApp({});
app.component('vue-app', App);
app.mount('#vue-root');