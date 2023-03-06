import { createApp } from "vue";
import { createPinia } from "pinia";
import { BootstrapVue3 } from "bootstrap-vue-3";
import { BootstrapIconsPlugin } from "bootstrap-icons-vue";
import App from "./App.vue";
import router from "./router";
import "./assets/main.css";
// Import Bootstrap and BootstrapVue
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

const app = createApp(App);
app.use(createPinia());
app.use(BootstrapVue3);
app.component("BootstrapIconsPlugin", BootstrapIconsPlugin);
app.use(router);
app.mount("#app");
