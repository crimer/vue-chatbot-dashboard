import * as api from "../api/something.api";

export default {
  namespaced: true,
  state: {
    tree: {},
    isFirstDataLoaded: false
  },
  getters: {},
  mutations: {
    SET_TREE: (state, payload) => {
      state.tree = payload;
    }
  },
  actions: {
    async FETCH_TREE({ commit }) {
      try {
        const res = await api.getTree("f9sl2e");
        if (res.status === 200) {
          commit("SET_TREE", res.data.tree);
        } else {
          // TODO: ошибки
        }
      } catch (error) {
        console.log(error);
        // TODO: ошибки
      }
    }
  }
};
