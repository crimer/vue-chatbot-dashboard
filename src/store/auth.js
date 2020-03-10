import Axios from "axios";

export default {
  namespaced: true,
  state: {
    user: localStorage.getItem("user") || null,
    token: localStorage.getItem("user-token") || null,
    role: "",
    logged: false,
    errors: [],

    users: [],
    isFirstDataLoaded: false
  },
  getters: {
    IS_AUTHENTICATED: state => state.token,
    AUTH_ROLE: state => state.role,
    IS_LOGGED: state => state.logged,
    USER_INFO: state => {
      return (
        JSON.parse(state.user) || {
          active: null,
          email: null,
          name: null
        }
      );
    }
  },
  mutations: {
    SET_USERS(state, payload) {
      state.users = payload;
      state.isFirstDataLoaded = true;
    },
    LOGIN(state, data) {
      const { token } = data;
      const user = JSON.stringify(data.user);
      localStorage.setItem("user-token", token);
      localStorage.setItem("user", user);
      state.user = user;
      state.token = token;
      state.role = data.role;
      state.logged = true;
    },
    LOGOUT(state) {
      state.user = null;
      state.token = null;
      state.role = null;
      state.logged = false;
      localStorage.removeItem("user-token");
      localStorage.removeItem("user");
    }
  },
  actions: {
    // TODO: (убрать потом) это для страницы пользователей (для таблицы)
    // async LOAD_USERS({ commit }) {
    //     try {
    //         const { data } = await Axios.get(
    //             "https://jsonplaceholder.typicode.com/users/"
    //         );
    //         commit("SET_USERS", data);
    //     } catch (error) {
    //         console.log(error);
    //     }
    // },
    async REGISTER_TOKEN({ state, commit }) {
      try {
        const { data } = await Axios({ url: "", data: user, method: "POST" });
        const token = data.token;
        localStorage.setItem("user-token", token);
      } catch (error) {
        localStorage.removeItem("user-token");
        state.errors = error;
      }
    },
    async AUTH_REQUEST({ commit, state }, user) {
      try {
        const { data } = await Axios({
          url: "url",
          data: user,
          method: "POST"
        });
        commit("LOGIN", data);
      } catch (error) {
        commit("LOGOUT");
        state.errors.push(error);
        console.log(error);
      }
    },
    AUTH_LOGOUT({ commit }) {
      return new Promise((resolve, reject) => {
        commit("AUTH_LOGOUT");
        localStorage.removeItem("user-token");
        resolve();
      });
    }
  }
};
