<template>
  <v-container class="fill-height" fluid>
    <v-layout align-center justify-center>
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-alert
            color="error"
            v-if="errors.length"
            icon="$vuetify.icons.close"
            max-width="500px"
            title="Opss..."
          >
            <p v-for="(item, index) in errors" :key="index" class="mb-3">
              {{ item }}
            </p>
          </v-alert>
          <v-card
            class="elevation-9"
            style="margin: auto;"
            width="100%"
            max-width="550px"
          >
            <v-overlay absolute :value="overlay">
              <LoginLoader />
            </v-overlay>
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>
                {{ $t("LoginPage.title") }}
              </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
              <v-form v-model="valid">
                <v-text-field
                  :label="$t('LoginPage.login')"
                  name="login"
                  clearable
                  v-model.trim="userLogin"
                  prepend-icon="$vuetify.icons.account"
                  type="text"
                  :rules="loginRules"
                  required
                />

                <v-text-field
                  id="password"
                  :label="$t('LoginPage.password')"
                  name="password"
                  v-model.trim="userPassword"
                  prepend-icon="$vuetify.icons.lock"
                  clearable
                  required
                  :rules="passwordRules"
                  :append-icon="
                    showPassword
                      ? '$vuetify.icons.eye'
                      : '$vuetify.icons.eyeOff'
                  "
                  :type="showPassword ? 'text' : 'password'"
                  @click:append="showPassword = !showPassword"
                />
              </v-form>
            </v-card-text>
            <v-card-actions class="d-flex justify-space-between">
              <router-link :to="{ path: 'register' }">{{
                $t("LoginPage.registerLink")
              }}</router-link>
              <v-btn
                @click.prevent="logIn()"
                :disabled="!valid"
                color="primary"
                >{{ $t("LoginPage.loginBtn") }}</v-btn
              >
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-layout>
  </v-container>
</template>

<script>
import LoginLoader from "@/components/LoginLoader.vue";
import { mapActions, mapGetters } from "vuex";
import Axios from "axios";

export default {
  name: "LoginPage",
  components: { LoginLoader },
  data: () => ({
    user: {},
    valid: true,
    overlay: false,
    userLogin: null,
    userPassword: null,
    showPassword: false,
    errors: []
  }),
  computed: {
    loginRules() {
      return [
        v => !!v || this.$t("LoginPage.loginRequired"),
        v => /.+@.+\..+/.test(v) || this.$t("LoginPage.loginValid")
      ];
    },
    passwordRules() {
      return [
        v => !!v || this.$t("LoginPage.passwordRequired"),
        v => (v && v.length >= 3) || this.$t("LoginPage.passwordMore")
      ];
    }
  },
  methods: {
    ...mapActions("SnackbarStore", ["OPEN_SNACKBAR"]),
    requestToken(user) {},
    logIn() {
      this.overlay = true;
      const { userLogin, userPassword } = this;
      setTimeout(() => {
        this.overlay = false;
        this.$router.push("/");
        this.OPEN_SNACKBAR({
          color: "info",
          text: this.$t("Snackbar.logIn")
        });
      }, 3000);
    }
  }
};
</script>

<style scoped></style>
