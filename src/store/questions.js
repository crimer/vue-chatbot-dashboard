import * as api from "../api/questions.api.js";

export default {
  namespaced: true,
  state: {
    questions: [],
    answers: [],
    isFirstDataLoaded: false
  },
  getters: {
    GET_QUESTION_WITH_KEYS: state => {
      return state.answers.filter(item => item.keys !== null)
    },
  },
  mutations: {
    SET_ALL_QUESTION: (state, payload) => {
      state.questions = payload;
      state.isFirstDataLoaded = true;
    },
    SET_ALL_ANSWERS: (state, payload) => {
      state.answers = payload;
      state.isFirstDataLoaded = true;
    },
    SET_QUESTION: (state, payload) => {
      state.questions.push(payload);
    }
  },
  actions: {
    async LOAD_ALL_ANSWERS({ commit, rootGetters }) {
      const key = rootGetters["keys/GET_KEY"];
      try {
        const res = await api.getAllAnswers(key);
        if (res.status === 200) {
          commit("SET_ALL_ANSWERS", res.data.answers);
        }
      } catch (error) {
        console.log(error);
      }
    },
    async LOAD_ALL_QUESTIONS({ rootGetters, commit }) {
      const key = rootGetters["keys/GET_KEY"];
      try {
        const res = await api.getAllQuestions(key);
        if (res.status === 200) {
          commit("SET_ALL_QUESTION", res.data.questions);
        }
      } catch (error) {
        console.log(error);
      }
    }
  }
};
