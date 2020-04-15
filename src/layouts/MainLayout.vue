<template>
  <v-app>
    <Snackbar />
    <Header @sidebar-toggle="sidebarToggle = !sidebarToggle" :pages="pages"/>
    <Sidebar v-model="sidebarToggle" :pages="pages"/>
    <v-content>
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </v-content>
  </v-app>
</template>

<script>
import Header from "@/components/app/Header";
import Sidebar from "@/components/app/Sidebar";
import Snackbar from "@/components/Snackbar.vue";

export default {
  name: "MainLayout",
  components: {
    Sidebar,
    Header,
    Snackbar
  },
  data: () => ({
    sidebarToggle: true
  }),
  computed: {
    routeName() {
      return this.$route.meta.name;
    },
    pages() {
      return [
        {
          title: 'Таблица вопросов',
          icon: "$vuetify.icons.table",
          route: "/",
          exact: true
        },
        {
          title: 'Дерево вопросов',
          icon: "$vuetify.icons.tree",
          route: "/tree"
        },
        {
          title: 'О нас',
          icon: "$vuetify.icons.history",
          route: "/about"
        },
        {
          title: 'Настройки',
          icon: "$vuetify.icons.settings",
          route: "/settings"
        }
      ];
    }
  }
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.1s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
