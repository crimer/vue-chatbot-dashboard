import VueCookie from "vue-cookie";
import * as api from "../api/keys.api";

export default {
  namespaced: true,
  state: {
    // ключ вошедшего юзера (который сейчас работаем в админке)
    currentUserKey: VueCookie.get('key') || null,
    isAdmin: true,
    logged: false,
    keysList: [],
    isFirstDataLoaded: false,
    errors: [],
  },
  getters: {
    GET_ALL_KEYS: (state) => {
      return state.keysList.keys;
    },
    IS_ADMIN: state => state.isAdmin,
    IS_LOGGED: state => state.logged,
  },
  mutations: {
    SET_COOKIE(state, payload) {
      VueCookie.set("session", payload, { expires: "15m" });
    },
    CLEAR_COOKIE(state) {
      VueCookie.delete("session");
    },
    SET_LOGGED(state, payload){
      state.currentUserKey = payload;
      state.logged = true;
    },
    SET_KEYS_LIST(state, payload) {
      state.keysList = payload.keys;
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
    async REGISTER_NEW_KEY({ newKey }) {
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
