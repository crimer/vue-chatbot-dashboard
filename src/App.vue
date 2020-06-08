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
import { mapActions } from "vuex";

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
  methods:{
    ...mapActions("questions", ["LOAD_ALL_QUESTIONS", "LOAD_ALL_ANSWERS"]),
  },
  mounted() {
    // первая загрузка данный
    this.LOAD_ALL_QUESTIONS();
    this.LOAD_ALL_ANSWERS();
  }
};
</script>
<style lang="scss"></style>
