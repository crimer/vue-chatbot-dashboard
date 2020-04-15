<template>
  <v-container class="fill-height" fluid>
    <v-layout align-center justify-center>
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="6">
          <v-alert
            color="error"
            v-if="errors.length"
            icon="$vuetify.icons.close"
            max-width="500px"
          >
            <p v-for="(item, index) in errors" :key="index" class="mb-3">
              {{ item }}
            </p>
          </v-alert>
          <v-card
            class="elevation-12"
            style="margin: auto;"
            width="100%"
            max-width="500px"
          >
            <v-overlay absolute :value="overlay">
              <LoginLoader />
            </v-overlay>
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>
                Регистрация
              </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
              <v-form v-model="valid">
                <v-text-field
                  label="Логин"
                  name="login"
                  prepend-icon="$vuetify.icons.account"
                  type="text"
                  clearable
                  :rules="loginRules"
                  v-model="userLogin"
                />

                <v-text-field
                  id="password"
                  label="Пароль"
                  name="password"
                  prepend-icon="$vuetify.icons.lock"
                  clearable
                  v-model="userPassword"
                  :rules="passwordRules"
                  :append-icon="
                    showPassword
                      ? '$vuetify.icons.eye'
                      : '$vuetify.icons.eyeOff'
                  "
                  :type="showPassword ? 'text' : 'password'"
                  @click:append="showPassword = !showPassword"
                />

                <v-text-field
                  id="confirmPassword"
                  label="Повторите пароль"
                  name="confirmPassword"
                  v-model="userConfirmPassword"
                  clearable
                  prepend-icon="$vuetify.icons.lock"
                  :rules="confirmPasswordRules"
                  :append-icon="
                    showConfirmPassword
                      ? '$vuetify.icons.eye'
                      : '$vuetify.icons.eyeOff'
                  "
                  :type="showConfirmPassword ? 'text' : 'password'"
                  @click:append="showConfirmPassword = !showConfirmPassword"
                />
              </v-form>
            </v-card-text>
            <v-card-actions class="d-flex justify-space-between">
              <router-link :to="{ path: 'login' }">
                Есть аккаунт?
              </router-link>
              <v-btn
                color="primary"
                :disabled="!valid"
                @click.prevent="register()"
              >
                Создать аккаунт
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-layout>
  </v-container>
</template>

<script>
import LoginLoader from "@/components/LoginLoader.vue";
import { mapActions } from "vuex";

export default {
  name: "RegisterPage",
  components: { LoginLoader },
  data() {
    return {
      overlay: false,
      valid: true,
      errors: [],

      userLogin: null,
      userPassword: null,
      userConfirmPassword: null,

      showPassword: false,
      showConfirmPassword: false
    };
  },
  watch: {
    userPassword() {
      return this.userPassword === this.userConfirmPassword
        ? (this.valid = true)
        : (this.valid = false);
    }
  },
  computed: {
    loginRules() {
      return [
        v => !!v || 'Логин обязателен',
        v => /.+@.+\..+/.test(v) || 'Логин должен быть валидным (test@mail.ru)'
      ];
    },
    passwordRules() {
      return [
        v => !!v || 'Пароль обязателен',
        v => (v && v.length >= 3) || 'Пароль должен быть больше чем 3 символов'
      ];
    },
    confirmPasswordRules() {
      return [
        v => !!v || 'Пароль обязателен',
        v => (v && v.length >= 3) || 'Пароль должен быть больше чем 3 символов',
        v => v === this.userPassword || 'Пароли не совподают'
      ];
    }
  },
  methods: {
    ...mapActions("SnackbarStore", ["OPEN_SNACKBAR"]),

    register() {
      this.overlay = true;
      setTimeout(() => {
        this.overlay = false;

        const { userLogin, userPassword } = this;
        console.log({ userLogin, userPassword });

        this.$router.push("/login");
        this.OPEN_SNACKBAR({
          color: "info",
          text: 'Вы успешно создали аккаунт. Теперь войдите'
        });
      }, 3000);
    }
  }
};
</script>

<style></style>
