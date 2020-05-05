export default {
  namespaced: true,
  state: {
    modalData: {},
    modalShow: false,
    modalTitle: ""
  },
  mutations: {
    CLOSE_MODAL(state) {
      state.modalTitle = "";
      state.modalShow = false;
      state.modalData = {};
    },
    SAVE_MODAL(state) {
      state.modalTitle = "";
      state.modalShow = false;
      state.modalData = {};
    },
    OPEN_MODAL(state, obj) {
      Object.assign(state.modalData, obj.selectedItem);
      state.modalShow = true;
      state.modalTitle = obj.title;
    }
  },
  actions: {}
};
