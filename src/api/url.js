import axios from "axios";

// экспорт методов api
export const url = {
  domain: process.env.VUE_APP_URL,
  paths: {
    questions: "https://jsonplaceholder.typicode.com/posts",
    tree: "admin/chat/tree",

    keys: "chat/keys",
    allKeys: "admin/key/list",
    registerKey: 'admin/key/create',
    deleteKey:'admin/key/remove',
    keyInfo:'admin/key/info',
    keyCheck: '/admin/key/check',

    allQuestions: 'admin/chat/questions',
    allAnswers: 'admin/chat/answers',
  }
};

// экземпляр axios для обращения к api
export const http = axios.create({
  baseURL: url.domain,
});

