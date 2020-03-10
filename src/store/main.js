export default {
  namespaced: true,
  state: {
    locale: localStorage.getItem("locale"),
    isDarkTheme: localStorage.getItem("isDarkTheme") || false
  },
  mutations: {
    SET_THEME(state, payload) {
      localStorage.setItem("isDarkTheme", payload);
      state.isDarkTheme = payload;
    },
    SET_LOCALE(state, locale) {
      localStorage.setItem("locale", locale);
      state.locale = locale;
    }
  }
};
