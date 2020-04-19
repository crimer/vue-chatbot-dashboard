import Vue from "vue";
import Vuetify from "vuetify/lib";
import "@mdi/font/css/materialdesignicons.css";

Vue.use(Vuetify);

const MY_ICONS = {
  search: "mdi-search",
  apps: "mdi-apps",
  bell: "mdi-bell",
  history: "mdi-history",
  table: "mdi-table-large",

  homeAccount: "mdi-home-account",
  login: "mdi-login",
  logout: "mdi-logout",
  account: "mdi-account",
  accountPlus: "mdi-account-plus",

  edit: "mdi-pencil",
  delete: "mdi-delete",
  plus: "mdi-plus",
  close: "mdi-close",
  refresh: "mdi-refresh",
  person: "mdi-person",
  lock: "mdi-lock",
  eye: "mdi-eye",
  eyeOff: "mdi-eye-off",
  translate: "mdi-translate",
  power: "mdi-power",
  settings: "mdi-settings",
  theme: "mdi-brightness-6",
  arrorLeft: "mdi-chevron-left",
  arrorRight: "mdi-arrow-right",
  send: "mdi-send",
  key: "mdi-key",
  
  // for Tree Table
  tree: "mdi-file-tree",
  addNode: 'mdi-folder-plus-outline',
  addLeaf: 'mdi-note-plus-outline',
  question: 'mdi-help',
  answer: 'mdi-checkbox-blank-circle',
  collapse: 'mdi-arrow-collapse',
  folder: 'mdi-folder',
};

const MY_THEME = {
  light: {
    primary: "#4A76A8",
    success: "#4CAF50",
    warning: "#FB8C00",
    info: "#2196F3",
    danger: "#FF5252",
    error: "#FF5252"
  },
};

export default new Vuetify({
  breakpoint: {
    scrollBarWidth: 16,
    thresholds: {
      xs: 600,
      sm: 960,
      md: 1280,
      lg: 1920
    }
  },
  icons: {
    iconfont: "mdi",
    values: MY_ICONS
  },
  theme: {
    themes: MY_THEME
  }
});

