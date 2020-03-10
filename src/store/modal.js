export default {
  namespaced: true,
  state: {
    modalData: {
      show: false,
      title: "",
      icon: "",
      question: "",
      answer: ""
    }
  },
  mutations: {
    CLOSE_MODAL(state) {
      state.modalData.show = false;
    },
    SAVE_MODAL(state) {
      state.modalData.show = false;
    },
    OPEN_MODAL(state, title) {
      state.modalData.title = title;
      state.modalData.show = true;
    }
  },
  actions: {}
};
