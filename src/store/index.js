import Vue from "vue";
import Vuex from "vuex";
import questions from "./questions";
import auth from "./auth";
import snackbar from "./snackbar";
import modal from "./modal";
import tree from "./tree";
import keys from "./keys";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    QuestionsStore: questions,
    AuthStore: auth,
    SnackbarStore: snackbar,
    CreateEditModal: modal,
    TreeStore: tree,
    KeysStore: keys,
    
  }
});
