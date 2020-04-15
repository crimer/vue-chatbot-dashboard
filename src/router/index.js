import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
    // beforeEnter: isAuthenticated,
    meta: {
      layout: "Main",
      name: 'Таблица'
    }
  },
  {
    path: "*",
    name: "404",
    meta: {
      layout: "Empty",
      name: '404'
    },
    component: () => import("../views/Error404.vue")
  },
  {
    path: "/about",
    name: "about",
    meta: {
      layout: "Main",
      name: 'О нас'
    },
    component: () => import("../views/About.vue")
  },
  {
    path: "/login",
    name: "login",
    meta: {
      layout: "Empty",
      name: 'Вход'
    },
    // beforeEnter: isNotAuthenticated,
    component: () => import("../views/Login.vue")
  },
  {
    path: "/register",
    name: "register",
    meta: {
      layout: "Empty",
      name: 'Регистрация'
    },
    component: () => import("../views/Register.vue")
  },
  {
    path: "/tree",
    name: "tree",
    meta: {
      layout: "Main",
      name: 'Дерево вопросов'
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
