import Vue from "vue";
import Vuex from "vuex";
import questions from "./questions";
import auth from "./auth";
import snackbar from "./snackbar";
import modal from "./modal";
import tree from "./tree";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    QuestionsStore: questions,
    AuthStore: auth,
    SnackbarStore: snackbar,
    CreateEditModal: modal,
    TreeStore: tree
  }
});
