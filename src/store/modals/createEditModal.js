export default {
  namespaced: true,
  state: {
    modalData: {},
    modalOptions: {
      show: false,
      title: ""
    }
  },
  mutations: {
    CLOSE_MODAL(state) {
      state.modalOptions.show = false;
      state.modalData = {};
    },
    SAVE_MODAL(state) {
      state.modalOptions.show = false;
      state.modalData = {};
    },
    OPEN_MODAL(state, obj) {
      state.modalOptions.title = obj.title;
      Object.assign(state.modalData, obj.selectedItem);
      state.modalOptions.show = true;
    }
  },
  actions: {}
};
