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
      return state.questions.map(
        item => new { value: item.id, text: item.text }
      );
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
    },

    async ADD_NEW_QUESTION({ rootGetters, commit }, text) {
      const key = rootGetters["keys/GET_KEY"];
      try {
        const res = await api.addNewQuestion(key, text);
        if (res.status === 200) {
          return true;
        }
      } catch (error) {
        console.log(error);
        return false;
      }
    },
    
    async EDIT_QUESTION({ rootGetters }, question) {
      const key = rootGetters["keys/GET_KEY"];
      
      try {
        const res = await api.editQuestion(key, question.id, question.text);
        if (res.status === 200) {
          return true;
        }
      } catch (error) {
        console.log(error);
        return false;
      }
    },
    async DELETE_QUESTION({ rootGetters }, id) {
      const key = rootGetters["keys/GET_KEY"];
      
      try {
        const res = await api.deleteQuestion(key, id);
        console.log(res.data);
        
        if (res.data.status === 'ok') {
          return true;
        }else{
          return false;
        }
      } catch (error) {
        console.log(error);
        return false;
      }
    },

    async ADD_NEW_ANSWERS({ rootGetters }, answersArray) {
      const key = rootGetters["keys/GET_KEY"];
      console.log("answersArray",answersArray);
      try {
        answersArray.map(async (answer) => {
          const res = await api.addNewAnswers(key, answer.text, answer.question_id, answer.next_question_id,answer.keys)
          console.log(res);
          
        })

        return true;
      } catch (error) {
        console.log(error);
        return false;
      }
    },
    async EDIT_ANSWERS({ rootGetters }, answersArray) {
      const key = rootGetters["keys/GET_KEY"];
      
      
      try {
        answersArray.map(async (answer) => {
          const res = await api.editAnswers(key, answer.id, answer.text, answer.keys, answer.question_id, answer.next_question_id)
        })
        return true;
      } catch (error) {
        console.log(error);
        return false;
      }
    }
  }
};
