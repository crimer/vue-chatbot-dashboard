import Vue from "vue";
import store from "@/store/index";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import i18n from "@/plugins/i18n.js";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
    // beforeEnter: isAuthenticated,
    meta: {
      layout: "Main",
      name: i18n.t("Routes.table"),
    }
  },
  {
    path: "*",
    name: "404",
    meta: {
      layout: "Empty",
      name: i18n.t("Routes.error404"),
    },
    component: () => import("../views/Error404.vue")
  },
  {
    path: "/about",
    name: "about",
    meta: {
      layout: "Main",
      name: i18n.t("Routes.about"),
      // name: 'о нас',
    },
    component: () => import("../views/About.vue")
  },
  {
    path: "/login",
    name: "login",
    meta: {
      layout: "Empty",
      name: i18n.t("Routes.login"),
    },
    // beforeEnter: isNotAuthenticated,
    component: () => import("../views/Login.vue")
  },
  {
    path: "/register",
    name: "register",
    meta: {
      layout: "Empty",
      name: i18n.t("Routes.register"),
    },
    component: () => import("../views/Register.vue")
  },
  {
    path: "/tree",
    name: "tree",
    meta: {
      layout: "Main",
      name: i18n.t("Routes.tree"),
    },
    component: () => import("../views/Tree.vue")
  },
  
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});
// const ifNotAuthenticated = (to, from, next) => {
//     if (!store.getters.isAuthenticated) {
//         next();
//         return;
//     }
//     next("/");
// };

// const ifAuthenticated = (to, from, next) => {
//     if (store.getters.isAuthenticated) {
//         next();
//         return;
//     }
//     next("/login");
// };

export default router;
