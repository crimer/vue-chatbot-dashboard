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
                Вход
              </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
              <v-form v-model="valid" @submit.prevent="logIn" ref="form">
                <v-text-field
                  id="password"
                  label="Пароль"
                  name="password"
                  v-model="userKey"
                  prepend-icon="$vuetify.icons.lock"
                  clearable
                  required
                  :rules="passwordRules"
                  :append-icon="
                    showPassword
                      ? '$vuetify.icons.eye'
                      : '$vuetify.icons.eyeOff'"
                  :type="showPassword ? 'text' : 'password'"
                  @click:append="showPassword = !showPassword"/>
                <div class="d-flex justify-center">
                  <v-btn type="submit"
                    :disabled="!valid"
                    width="200"
                    color="primary">Войти</v-btn>
                </div>
              </v-form>
            </v-card-text>
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
    userKey: "",
    valid: true,
    overlay: false,
    userPassword: null,
    showPassword: false,
    errors: [],
    passwordRules: [
      v => !!v || "Пароль обязателен",
      v => (v && v.length >= 6) || "Пароль должен быть больше чем 6 символов"
    ]
  }),

  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    logIn() {
      let registerFormValid = this.$refs.form.validate();
      if (!registerFormValid) return;

      this.overlay = true;
      const { userKey } = this;

      setTimeout(() => {
        this.overlay = false;
        this.$store.commit('keys/SET_LOGGED',userKey);
        this.$router.push("/");
        this.OPEN_SNACKBAR({
          color: "info",
          text: "Вы вошли в свой аккаунт"
        });
      }, 3000);
    }
  }
};
</script>

<style scoped></style>
