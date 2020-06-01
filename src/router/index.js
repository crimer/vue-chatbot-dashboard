import Vue from "vue";
import VueRouter from "vue-router";
import HomePage from "../views/HomePage.vue";
import store from "@/store/index.js";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: HomePage,
    meta: {
      layout: "Main",
      name: "Таблица ответов на вопросы"
    }
  },
  {
    path: "/keystable",
    name: "kaysTable",
    meta: {
      layout: "Main",
      name: "Таблица ключей"
    },
    component: () => import("../views/KeysPage.vue")
  },
  {
    path: "*",
    name: "404",
    meta: {
      layout: "Empty",
      name: "404"
    },
    component: () => import("../views/Error404Page.vue")
  },
  {
    path: "/login",
    name: "login",
    meta: {
      layout: "Empty",
      name: "Вход"
    },
    component: () => import("../views/LoginPage.vue")
  },
  {
    path: "/addQuestion",
    name: "addQuestion",
    meta: {
      layout: "Main",
      name: "Добавить вопрос"
    },
    component: () => import("../views/AddQuestionPage.vue")
  },
  {
    path: "/addAnswers",
    name: "addAnswers",
    meta: {
      layout: "Main",
      name: "Добавить ответы на вопрос"
    },
    component: () => import("../views/AddAnswersPage.vue")
  },
  {
    path: "/tree",
    name: "tree",
    meta: {
      layout: "Main",
      name: "Дерево вопросов"
    },
    component: () => import("../views/TreePage.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

// middleware для проверки
router.beforeEach((to, from, next) => {
  if (to.name !== "login" && !store.state.keys.currentUserKey)
    next({ name: "login" });
  else next();
});

export default router;
