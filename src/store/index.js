import Vue from "vue";
import Vuex from "vuex";
import questions from "./questions";
import snackbar from "./snackbar";
import deleteModal from "./deleteModal";
import tree from "./tree";
import keys from "./keys";
import addEditEntity from './addEditEntity'

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    deleteModal,
    questions,
    snackbar,
    tree,
    keys,
    addEditEntity,
  },
});
export default store;
