export default {
  namespaced: true,
  state: {
    addEditQueston: {
      id: null,
      text: ""
    },
    addEditAnswers: [
      {
        id: null,
        keys: '',
        text: ""
      }
    ]
  },
  mutations: {
    CLEAR_QUESTION(state) {
      state.addEditQueston = {
        id: null,
        text: ""
      };
    },
    CLEAR_ANSWERS(state) {
      state.addEditAnswers = {
        id: null,
        text: ""
      };
    },
    SET_QUESTION(state, obj) {
      Object.assign(state.addEditQueston,obj);
    },
    SET_ANSWERS(state, obj) {}
  },
  actions: {}
};
