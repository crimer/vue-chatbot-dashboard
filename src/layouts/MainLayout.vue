<template>
  <v-app>
    <Snackbar />
    <Header @sidebar-toggle="sidebarToggle = !sidebarToggle"/>
    <Sidebar v-model="sidebarToggle"/>
    <v-content>
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </v-content>
  </v-app>
</template>

<script>

import Header from "@/components/App/Header.vue";
import Sidebar from "@/components/App/Sidebar.vue";

export default {
  name: "MainLayout",
  components: {
    Sidebar,
    Header,
  },
  data: () => ({
    sidebarToggle: true
  }),

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
