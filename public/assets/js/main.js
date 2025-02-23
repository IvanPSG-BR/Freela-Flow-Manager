// Arquivo Principal JavaScript
import { injectSpeedInsights } from '@vercel/speed-insights';
import { createApp } from 'vue';
import App from '/public/assets/js/App.vue';

injectSpeedInsights();
createApp(App).mount('#app');
