import Axios from "axios";

export default {
  namespaced: true,
  state: {
    questions: [],
    isFirstDataLoaded: false
  },
  getters: {
    GET_BY_ID: (state, id) => {
      return state.questions.indexOf(id);
    }
  },
  mutations: {
    LOAD_QUESTION: (state, payload) => {
      state.questions = payload;
      state.isFirstDataLoaded = true;
    },
    SET_QUESTION: (state, payload) => {
      state.questions.push(payload);
    }
  },
  actions: {
    // LOAD_QUESTION({ commit }) {
    //     return new Promise((resolve, reject) => {
    //         Axios.get("https://jsonplaceholder.typicode.com/posts")
    //             .then(response => {
    //                 commit("LOAD_QUESTION", response.data);
    //                 resolve();
    //             })
    //             .catch(errors => {
    //                 console.log(errors);
    //                 reject();
    //             });
    //     });
    // },
    async LOAD_QUESTIONS({ commit }) {
      try {
        const { data } = await Axios.get(
          "https://jsonplaceholder.typicode.com/posts"
        );
        commit("LOAD_QUESTION", data);
      } catch (error) {
        console.log(error);
      }
    },
    ADD_NEW_QUESTION({ commit }) {
      commit("SET_QUESTION", commit);
    }
  }
};
