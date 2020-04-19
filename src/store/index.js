import Vue from "vue";
import Vuex from "vuex";
import questions from "./questions";
import snackbar from "./snackbar";
import modal from "./modal";
import tree from "./tree";
import keys from "./keys";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    questions,
    snackbar,
    modal,
    tree,
    keys
  }
});
export default store;
