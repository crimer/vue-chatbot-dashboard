import { getQuestions } from "../api/something.api";

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
    async LOAD_QUESTIONS({ commit }) {
      try {
        const { data } = await getQuestions();
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
