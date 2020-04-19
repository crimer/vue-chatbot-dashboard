export default {
  namespaced: true,
  state: {
    data: {},
    modalData: {
      show: false,
      title: "",
      icon: "",
    }
  },
  mutations: {
    CLOSE_MODAL(state) {
      state.modalData.show = false;
    },
    SAVE_MODAL(state) {
      state.modalData.show = false;
    },
    OPEN_MODAL(state, title, data) {
      state.modalData.title = title;
      console.log('data',data);
      
      Object.assign(state.data, data);
      state.modalData.show = true;
    }
  },
  actions: {}
};
