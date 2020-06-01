export default {
  namespaced: true,
  state: {
    addEditQueston: {
      id: null,
      text: ""
    },
    addEditAnswers: {
      id: null,
      text: ""
    }
  },
  mutations: {
    CLEAR_QUESTION(state){
      state.addEditQueston = {
        id: null,
        text: ""
      };
    },
    CLEAR_ANSWERS(state){
      state.addEditAnswers = {
        id: null,
        text: ""
      };
    },
    SET_QUESTION(state, obj) {
      state.addEditQueston.id = obj.id;
      state.addEditQueston.text = obj.text;
    },
    SET_ANSWERS(state, obj) {
      
    },

  },
  actions: {}
};
