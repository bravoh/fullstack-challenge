import { createApp } from "vue";
import { createPinia } from "pinia";
//import { createVuetify } from 'vuetify';

import App from "./App.vue";
import router from "./router";

import 'vuetify/dist/vuetify.min.css'
import "./assets/main.css";

//const vuetify = createVuetify()
const app = createApp(App);

app.use(createPinia());
app.use(router);
//app.use(vuetify);

app.mount("#app");
