import { createApp } from 'vue';
import 'core-js/stable'; 
import 'regenerator-runtime/runtime';
import moment from 'moment';

import App from 'Components/App.vue';
import primeVueComponentProvider from 'Providers/primeVueComponentProvider.js';
import httpProvider from 'Providers/httpProvider.js';
import router from './router.js';
import store from 'Store/index.js';

// styles import
import 'bootstrap/dist/css/bootstrap.min.css';
import '../sass/main.scss';

const app = createApp(App);

app.use(router);
app.use(store);
app.config.globalProperties.$moment = moment;

primeVueComponentProvider({ app })
httpProvider({ app, store })

app.mount('#app');
