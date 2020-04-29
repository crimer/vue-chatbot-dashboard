import * as api from "../api/questions.api.js";

export default {
  namespaced: true,
  state: {
    questions: [],
    answers: [],
    isFirstDataLoaded: false,
  },
  getters: {
    GET_BY_ID: (state, id) => {
      return state.questions.indexOf(id);
    },
    GET_QUESTION_BY_ID: (state) => {
      return state.questions.find(item => item.id === state.selectedQuestionId);
    }
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
    },
  },
  actions: {
    async LOAD_ALL_ANSWERS({ commit }) {
      try {
        const { data } = await api.getAllAnswers('f9sl2e');
        commit("SET_ALL_ANSWERS", data);
      } catch (error) {
        console.log(error);
      }
    },
    async LOAD_ALL_QUESTIONS({ commit }) {
      try {
        const { data } = await api.getAllQuestions('f9sl2e');
        commit("SET_ALL_QUESTION", data);
      } catch (error) {
        console.log(error);
      }
    },
    ADD_NEW_QUESTION({ commit }) {
      commit("SET_QUESTION", commit);
    },
  }
};
