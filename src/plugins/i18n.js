import VueI18n from "vue-i18n";
import Vue from "vue";
import ru from "@/locales/ru.js";
import eng from "@/locales/eng.js";

Vue.use(VueI18n);

const messages = {
  ru,
  eng
};

const dateTimeFormats = {
  en: {
    short: {
      year: "numeric",
      month: "short",
      day: "numeric"
    },
    long: {
      year: "numeric",
      month: "short",
      day: "numeric",
      weekday: "short",
      hour: "numeric",
      minute: "numeric",
      second: "numeric",
      hour12: true
    }
  },
  ru: {
    short: {
      year: "numeric",
      month: "short",
      day: "numeric"
    },
    long: {
      year: "numeric",
      month: "short",
      day: "numeric",
      weekday: "short",
      hour: "numeric",
      minute: "numeric",
      second: "numeric"
    }
  }
};

export default new VueI18n({
  locale: localStorage.getItem("locale") || "ru",
  fallbackLocale: "ru",
  // silentFallbackWarn: true,
  dateTimeFormats,
  messages,
});
