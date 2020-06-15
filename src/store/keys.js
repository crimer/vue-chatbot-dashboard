import VueCookie from "vue-cookie";
import * as api from "../api/keys.api.js";

export default {
  namespaced: true,
  state: {
    // ключ вошедшего юзера (который сейчас работаем в админке)
    currentUserKey: VueCookie.get("key_session") || null,
    isLogged: false,
    keysList: [],
    isFirstDataLoaded: false,
    errors: []
  },
  getters: {
    GET_KEY: state => state.currentUserKey,
    GET_ALL_KEYS: state => state.keysList.keys,
    IS_LOGGED: state => state.isLogged
  },
  mutations: {
    SET_COOKIE(state, payload) {
      VueCookie.set("key_session", payload, { expires: "15m" });
    },
    CLEAR_COOKIE(state) {
      VueCookie.delete("key_session");
    },
    SET_LOGGED(state, payload) {
      state.currentUserKey = payload;
      state.isLogged = true;
    },
    SET_KEYS_LIST(state, payload) {
      state.keysList = payload.keys;
    },
    PUSH_TO_KEYS_LIST(state, payload) {
      state.keysList.push(payload);
    },
    REMOVE_FROM_KEYS_LIST(state, payload) {
      var index = state.keysList.map(item => item.id).indexOf(payload);
      state.keysList.splice(index, 1);
    },
    SET_CURRENT_USER_KEY(state, payload) {
      state.currentUserKey = payload;
    }
  },
  actions: {
    async FETCH_ALL_KEYS({ commit, getters }) {
      const key = getters.GET_KEY;
      try {
        const res = await api.getAllKeys(key);
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

    async KEY_CHECK({ commit }, key) {
      try {
        const res = await api.keyCheck(key);

        if (res.data.status === "valid") {
          return true;
        } else {
          console.log("key not valid");
          return false;
        }
      } catch (e) {
        console.log(e);

        return false;
      }
    },

    async REGISTER_NEW_KEY({ commit, getters }) {
      const key = getters.GET_KEY;
      try {
        const res = await api.registerNewKey(key);
        if (res.status === 200) {
          console.log("ключ зарегестрирован");
          commit("PUSH_TO_KEYS_LIST", res.data.key);
        } else {
          // TODO:
        }
      } catch (e) {
        console.log(e);
        // TODO:
      }
    },

    async DELETE_KEY({ commit, getters }, deleteKeyId) {
      const key = getters.GET_KEY;
      try {
        const res = await api.deleteKey(key, deleteKeyId);
        if (res.status === 200) {
          // TODO:
          commit('REMOVE_FROM_KEYS_LIST',deleteKeyId)
          console.log("ключ удвлен из бд");
        } else {
          // TODO:
        }
      } catch (e) {
        console.log(e);
        // TODO:
      }
    }
  }
};
