<template>
  <div id="app">
    <component :is="layout">
      <router-view />
    </component>
  </div>
</template>

<script>
import EmptyLayout from "@/layouts/EmptyLayout.vue";
import MainLayout from "@/layouts/MainLayout.vue";
import { mapState, mapGetters } from "vuex";
import axios from "axios";

export default {
  name: "App",
  components: {
    EmptyLayout,
    MainLayout,
  },
  computed: {
    layout() {
      return `${this.$route.meta.layout || "Empty"}Layout`;
    }
  }
  // created: function() {
  //     axios.interceptors.response.use(undefined, function(err) {
  //         return new Promise(function(resolve, reject) {
  //             if (
  //                 err.status === 401 &&
  //                 err.config &&
  //                 !err.config.__isRetryRequest
  //             ) {
  //                 // if you ever get an unauthorized, logout the user
  //                 this.$store.dispatch(AUTH_LOGOUT);
  //                 // you can also redirect to /login if needed !
  //             }
  //             throw err;
  //         });
  //     });
  // }
};
</script>
<style lang="scss">
// TODO: почистить все кастомные стили по файлам и разобраться со шрифтами
// #app {
//   font-family: "Avenir", Helvetica, Arial, sans-serif;
//   -webkit-font-smoothing: antialiased;
//   -moz-osx-font-smoothing: grayscale;
//   text-align: center;
//   color: #2c3e50;
// }

// #nav {
//   padding: 30px;

//   a {
//     font-weight: bold;
//     color: #2c3e50;

//     &.router-link-exact-active {
//       color: #42b983;
//     }
//   }
// }
</style>
