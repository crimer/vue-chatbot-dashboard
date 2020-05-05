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
              <div class="text-center">
                <v-progress-circular
                  :size="50"
                  color="primary"
                  indeterminate
                ></v-progress-circular>
              </div>
            </v-overlay>
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>
                Вход
              </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
              <v-form
                v-model="valid"
                @submit.prevent="logIn(userKey)"
                ref="form"
              >
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
                      : '$vuetify.icons.eyeOff'
                  "
                  :type="showPassword ? 'text' : 'password'"
                  @click:append="showPassword = !showPassword"
                />
                <div class="d-flex justify-center">
                  <v-btn
                    type="submit"
                    :disabled="!valid"
                    width="200"
                    color="primary"
                    >Войти</v-btn
                  >
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
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
  name: "LoginPage",
  data: () => ({
    userKey: "",
    valid: true,
    overlay: false,
    userPassword: null,
    showPassword: false,
    errors: [],
    passwordRules: [
      v => !!v || "Пароль обязателен",
      v => (v && v.length === 6) || "Пароль должен быть равен 6 символам"
    ]
  }),

  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapMutations("keys", ["SET_LOGGED", "SET_COOKIE"]),
    ...mapActions("keys", ["KEY_CHECK"]),

    async logIn(userKey) {
      let registerFormValid = this.$refs.form.validate();
      if (!registerFormValid) return;

      this.overlay = true;
      let keyValid = await this.KEY_CHECK(userKey);

      setTimeout(() => {
        if (!keyValid) {
          this.OPEN_SNACKBAR({ color: "error", text: "Пароль не верный" });
          this.overlay = false;
          return;
        }
        this.overlay = false;
        this.SET_LOGGED(userKey);
        this.SET_COOKIE(userKey);
        this.$router.push("/");
        this.OPEN_SNACKBAR({
          color: "info",
          text: "Вы вошли в систему"
        });
      }, 1000);
    }
  }
};
</script>

<style scoped></style>
