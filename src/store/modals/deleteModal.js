export default {
  namespaced: true,
  state: {
    deleteModalShow: false,
    
  },
  mutations: {
    OPEN_DELETE_MODAL(state) {
      state.deleteModalShow = true;
    },
    CLOSE_DELETE_MODAL(state) {
      state.deleteModalShow = false;
    }
  },
  actions: {}
};
