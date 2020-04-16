import axios from "axios";

// экспорт методов api
const url = {
  domain: process.env.VUE_APP_URL,
  paths: {
    questions: "https://jsonplaceholder.typicode.com/posts",
    tree: "admin/chat/tree",
    keys: "chat/keys",
    allKeys: "admin/key/list",
    registerKey: 'admin/key/create',
    deleteKey:'admin/key/remove',
    keyInfo:'admin/key/info',
  }
};
console.log(process.env.VUE_APP_URL);

// экземпляр axios для обращения к api
export const http = axios.create({
  baseURL: url.domain,
  // headers: { bala: "bla" },
  // params: {
  //   testKey: "test"
  //   // key: process.env.VUE_APP_ADMIN_KEY
  // }
});
// http.defaults.params = {
//   'test': 'testos',
// };
// http.defaults.params = {
//   qw:'wq'
// };
// http.defaults.data = { test: "T" };
// http.defaults.params["lol"] = "lol";
// http.defaults.headers.common["aaa"] = "loool";

export default url;
