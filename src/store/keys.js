import * as api from "../api/keys.api";

export default {
  namespaced: true,
  state: {
    // ключ вошедшего юзера (который сейчас работаем в админке)
    currentUserKey: "",
    keysList: [],
    isFirstDataLoaded: false
  },
  mutations: {
    SET_KEYS_LIST(state, payload) {
      state.keysList = payload;
    },
    SET_CURRENT_USER_KEY(state, payload) {
      state.currentUserKey = payload;
    }
  },
  actions: {
    async FETCH_ALL_KEYS({ commit }) {
      try {
        const res = await api.getAllKeys();
        if (res.status === 200) {
          commit("SET_KEYS_LIST", res.data);
        } else {
          // TODO:
        }
      } catch (e) {
        console.log(e);
        // TODO:
      }
    },
    async GERISTER_NEW_KEY({ newKey }) {
      try {
        const res = await api.registerNewKey(newKey);
        if (res.status === 200) {
          // TODO:
          console.log("ключ зарегестрирован");
        } else {
          // TODO:
        }
      } catch (e) {
        console.log(e);
        // TODO:
      }
    }
  },
  async DELETE_KEY({ deleteKeyId }) {
    try {
      const res = await api.deleteKey(deleteKeyId);
      if (res.status === 200) {
        // TODO:
        console.log("ключ удвлен из бд");
      } else {
        // TODO:
      }
    } catch (e) {
      console.log(e);
      // TODO:
    }
  }
};
