<template>
  <div id="app">
    <component :is="layout">
      <router-view />
    </component>
  </div>
</template>

<script>
import EmptyLayout from "@/layouts/EmptyLayout.vue";
import MainLayout from "@/layouts/MainLayout.vue";
import { mapState, mapGetters } from "vuex";
import axios from "axios";

export default {
  name: "App",
  components: {
    EmptyLayout,
    MainLayout
  },
  computed: {
    layout() {
      return `${this.$route.meta.layout || "Empty"}Layout`;
    }
  },
};
</script>
<style lang="scss"></style>
