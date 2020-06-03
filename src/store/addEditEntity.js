export default {
  namespaced: true,
  state: {
    addEditQueston: {
      id: null,
      text: ""
    },
    addEditAnswers: {
      type: 'ADD',
      data: {
        id: null,
        count:1,
        answers: [
          {
            id: null,
            keys: [],
            text: ""
          }
        ]
      }
    }
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
        type: 'ADD',
        data: {
          id: null,
          count:1,
          answers: [
            {
              id: null,
              keys: [],
              text: ""
            }
          ]
        }
      };
    },

    SET_QUESTION(state, obj) {
      Object.assign(state.addEditQueston, obj);
    },
    SET_ANSWERS(state, obj) {
      state.addEditAnswers.type = obj.type;
      Object.assign(state.addEditAnswers.data, obj.data);
    }
  },
  actions: {}
};
