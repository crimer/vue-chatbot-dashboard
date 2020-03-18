<template>
  <v-app-bar app color="primary" dark dense>
    <v-app-bar-nav-icon @click="$emit('sidebar-toggle')" />
    <v-toolbar-title>
      <span >{{ routeName }}</span>
    </v-toolbar-title>
    <v-spacer />
    <span class="mr-5 hidden-sm-and-down" v-html='$d(date,"long")'></span>
#    <LanguageSwitcher /> _______________язык
    <v-tooltip bottom>
      <template v-slot:activator="{ on }">
        <v-btn icon v-on="on" @click="LogOut()">
          <v-icon>$vuetify.icons.power</v-icon>
        </v-btn>
      </template>
      <span v-text="$t('Header.exitButton')"></span>
    </v-tooltip>
  </v-app-bar>
</template>

<script>
//import LanguageSwitcher from "@/components/header/LanguageSwitcher.vue"; _______________язык
import { mapActions } from "vuex";

export default {
  name: "Header",
//  components: { LanguageSwitcher }, _______________язык 
  data: () => ({
    date: new Date(),
    interval: null
  }),
  computed: {
    routeName() {
      // TODO: доделать переключение на англ даты и названия страницы в header
      const meta = this.$route.meta;
      console.log(meta.name);
      
      return meta.name;
    }
  },
  methods: {
    ...mapActions("SnackbarStore", ["OPEN_SNACKBAR"]),
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },

    LogOut() {
      this.$router.push("/login");
      this.OPEN_SNACKBAR({ color: "info", text: this.$t("Snackbar.logOut") });
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
