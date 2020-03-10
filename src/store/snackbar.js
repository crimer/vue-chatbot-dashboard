export default {
  namespaced: true,
  state: {
    snackbars: []
  },
  mutations: {
    SET_SNACKBAR(state, snackbar) {
      state.snackbars = state.snackbars.concat(snackbar);
    }
  },
  actions: {
    OPEN_SNACKBAR({ commit }, snackbar) {
      snackbar.show = true;
      snackbar.color = snackbar.color || "info";
      snackbar.timeout = snackbar.timeout || 3000;
      commit("SET_SNACKBAR", snackbar);
    }
  }
};
