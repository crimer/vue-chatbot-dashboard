import * as api from "../api/questions.api";

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
    async FETCH_TREE({ rootGetters,commit }) {
      try {
        const key = rootGetters["keys/GET_KEY"];
        const res = await api.getTree(key);
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
