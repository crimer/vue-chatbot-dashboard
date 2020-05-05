<template>
  <v-app-bar app color="primary" dark dense>
    <!-- <v-app-bar-nav-icon @click="$emit('sidebar-toggle')" /> -->
    <v-toolbar-title>
      <span >{{ routeName }}</span>
    </v-toolbar-title>
    <v-spacer />
    <span class="mr-5 hidden-sm-and-down">{{ date | dateFilter('datetime')}}</span>
    <v-tooltip bottom>
      <template v-slot:activator="{ on }">
        <v-btn icon v-on="on" @click="logOut()">
          <v-icon>$vuetify.icons.power</v-icon>
        </v-btn>
      </template>
      <span>Выход</span>
    </v-tooltip>
  </v-app-bar>
</template>

<script>
import { mapActions, mapMutations } from "vuex";

export default {
  name: "Header",
  data: () => ({
    date: new Date(),
    interval: null
  }),
  computed: {
    routeName() {
      return this.$route.meta.name;
    }
  },
  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapMutations('keys',['CLEAR_COOKIE']),
    logOut() {
      this.$router.push("/login");
      this.CLEAR_COOKIE()
      this.OPEN_SNACKBAR({ color: "info", text: 'Вы вышли из системы' });
    }
  },
  mounted() {
    this.interval = setInterval(() => {
      this.date = new Date();
    }, 1000);
  }
};
</script>

<style></style>
