<template>
  <div>
    <v-snackbar
      v-for="(snackbar, index) in snackbars.filter(s => s.show)"
      v-model="snackbar.show"
      absolute
      top
      center
      :key="snackbar.text + Math.random()"
      :color="snackbar.color"
      :timeout="snackbar.timeout"
      :style="`top: ${index * 60 + 8}px;`">
      {{ snackbar.text }}
      <v-btn icon @click="snackbar.show = false">
        <v-icon color="white">$vuetify.icons.close</v-icon>
      </v-btn>
    </v-snackbar>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "Snackbar",
  computed: {
    ...mapState("snackbar", ["snackbars"])
  }
};
</script>

<style></style>
