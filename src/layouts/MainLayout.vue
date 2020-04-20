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
import Header from "@/components/App/Header";
import Sidebar from "@/components/App/Sidebar";
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
