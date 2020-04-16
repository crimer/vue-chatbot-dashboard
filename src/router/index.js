import Vue from "vue";
import VueRouter from "vue-router";
import HomePage from "../views/HomePage.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: HomePage,
    // beforeEnter: isAuthenticated,
    meta: {
      layout: "Main",
      name: 'Таблица вопросов'
    }
  },
  {
    path: "/keystable",
    name: "kaysTable",
    meta: {
      layout: "Main",
      name: 'Таблица ключей'
    },
    component: () => import("../views/KeysPage.vue")
  },
  {
    path: "*",
    name: "404",
    meta: {
      layout: "Empty",
      name: '404'
    },
    component: () => import("../views/Error404Page.vue")
  },
  {
    path: "/about",
    name: "about",
    meta: {
      layout: "Main",
      name: 'О нас'
    },
    component: () => import("../views/AboutPage.vue")
  },
  {
    path: "/login",
    name: "login",
    meta: {
      layout: "Empty",
      name: 'Вход'
    },
    // beforeEnter: isNotAuthenticated,
    component: () => import("../views/LoginPage.vue")
  },
  {
    path: "/register",
    name: "register",
    meta: {
      layout: "Empty",
      name: 'Регистрация'
    },
    component: () => import("../views/RegisterPage.vue")
  },
  {
    path: "/tree",
    name: "tree",
    meta: {
      layout: "Main",
      name: 'Дерево вопросов'
    },
    component: () => import("../views/TreePage.vue")
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
