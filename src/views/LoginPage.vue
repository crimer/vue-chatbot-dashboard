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
            title="Opss...">
            <p v-for="(item, index) in errors" :key="index" class="mb-3">
              {{ item }}
            </p>
          </v-alert>
          <v-card
            class="elevation-9"
            style="margin: auto;"
            width="100%"
            max-width="550px">
            <v-overlay absolute :value="overlay">
              <LoginLoader />
            </v-overlay>
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>
                Вход
              </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
              <v-form v-model="valid" @keydown.prevent.enter>
                <v-text-field
                  id="password"
                  label="Пароль"
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
              <router-link :to="{ path: 'register' }">Создать аккаунт</router-link>
              <v-btn
                @click.prevent="logIn()"
                :disabled="!valid"
                color="primary">Войти</v-btn>
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
    userPassword: null,
    showPassword: false,
    errors: []
  }),
  computed: {
    passwordRules() {
      return [
        v => !!v || 'Пароль обязателен',
        v => (v && v.length >= 6) || 'Пароль должен быть больше чем 6 символов'
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
          text: 'Вы вошли в свой аккаунт'
        });
      }, 3000);
    }
  }
};
</script>

<style scoped></style>
