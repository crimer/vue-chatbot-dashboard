import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from "@/plugins/vuetify";
import dateFilter from "@/filters/date.filter.js";
import Vuelidate from "vuelidate";
import VueTreeList from 'vue-tree-list'
import Snackbar from '@/components/Snackbar.vue';

Vue.use(VueTreeList)
Vue.use(Vuelidate);

Vue.filter("dateFilter", dateFilter);

Vue.config.productionTip = false;

Vue.component('Snackbar',Snackbar)

new Vue({
  store,
  router,
  vuetify,
  render: h => h(App)
}).$mount("#app");
