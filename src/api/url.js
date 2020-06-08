import axios from "axios";

// экспорт методов api
export const url = {
  domain: process.env.VUE_APP_URL,
  paths: {
    getTree: "admin/chat/tree",
    keys: "chat/keys",
    allKeys: "admin/key/list",
    registerKey: 'admin/key/create',
    deleteKey:'admin/key/remove',
    keyInfo:'admin/key/info',
    keyCheck: 'admin/key/check',

    allQuestions: 'admin/chat/questions',
    addNewQuestion: 'admin/chat/add/question',
    editQuestion: 'admin/chat/edit/question',
    deleteQuestion: 'admin/chat/remove/question',
    
    allAnswers: 'admin/chat/answers',
    addNewAnswers: 'admin/chat/add/answer',
    editAnswers: 'admin/chat/edit/answer',
    deleteAnswer: 'admin/chat/remove/answer'
  }
};

// экземпляр axios для обращения к api
export const http = axios.create({
  baseURL: url.domain,
});

