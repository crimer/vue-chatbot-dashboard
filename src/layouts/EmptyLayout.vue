<template>
  <v-app class="grey lighten-1">
    <Snackbar />
    <v-content>
      <router-view />
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: "EmptyLayout",
};
</script>

<style></style>
