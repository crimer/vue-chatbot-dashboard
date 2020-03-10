<template>
  <v-menu offset-y>
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <v-icon>$vuetify.icons.translate</v-icon>
      </v-btn>
    </template>
    <v-list>
      <v-list-item
        selectable
        v-for="(item, index) in languages"
        :key="index"
        @click="changeLocale(item)" >
        <v-list-item-title>
          {{ item }}
        </v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import { mapMutations, mapActions } from "vuex";

export default {
  name: "LanguageSwitcher",
  data() {
    return {
      languages: ["ru", "eng"]
    };
  },
  methods: {
    ...mapMutations("MainStore", ["SET_LOCALE"]),
    ...mapActions("SnackbarStore", ["OPEN_SNACKBAR"]),
    changeLocale(locale) {
      this.SET_LOCALE(locale);
      this.$root.$i18n.locale = locale;
      this.OPEN_SNACKBAR({
        color: "success",
        text: this.$t("Snackbar.langToggle", { lang: locale })
      });
    }
  }
};
</script>

<style></style>
