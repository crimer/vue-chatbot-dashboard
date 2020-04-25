export default {
  namespaced: true,
  state: {
    deleteModalOptions: {
      show: false,
      title: ""
    }
  },
  mutations: {
    OPEN_DELETE_MODAL(state, title) {
      state.deleteModalOptions.show = true;
      state.deleteModalOptions.title = title;
    },
    CLOSE_DELETE_MODAL(state) {
      state.deleteModalOptions.show = false;
    }
  },
  actions: {}
};
