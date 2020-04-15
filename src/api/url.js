// экспорт методов api
export default {
  domain: process.env.VUE_APP_URL,
  paths: {
    tree: "admin/chat/tree",
    keys: "chat/keys",
    questions: "https://jsonplaceholder.typicode.com/posts",
  }
};
