<template>
  <v-app class="grey lighten-1">
    <Snackbar />
    <v-content>
      <router-view />
    </v-content>
  </v-app>
</template>

<script>
import Snackbar from "@/components/Snackbar.vue";
export default {
  name: "EmptyLayout",
  components: { Snackbar }
};
</script>

<style></style>
