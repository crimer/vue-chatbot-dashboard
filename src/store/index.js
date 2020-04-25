import Vue from "vue";
import Vuex from "vuex";
import questions from "./questions";
import snackbar from "./snackbar";
import deleteModal from "./modals/deleteModal";
import createEditModal from "./modals/createEditModal";
import tree from "./tree";
import keys from "./keys";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    createEditModal,
    deleteModal,
    questions,
    snackbar,
    tree,
    keys,
  }
});
export default store;
