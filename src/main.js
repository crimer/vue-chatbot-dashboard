import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from "@/plugins/vuetify";
import dateFilter from "@/filters/date.filter.js";
import Vuelidate from "vuelidate";
import i18n from "@/plugins/i18n.js";
import VueTreeList from 'vue-tree-list'

Vue.use(VueTreeList)
Vue.use(Vuelidate);

Vue.filter("dateFilter", dateFilter);

Vue.config.productionTip = false;

const token = localStorage.getItem("user-token");
if (token) {
  axios.defaults.headers.common["Authorization"] = token;
}

new Vue({
  store,
  router,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount("#app");
