import  { url, http } from "./url.js";

export const getAllQuestions = key => {
  return http.post(url.paths.allQuestions, { key });
};

export const getAllAnswers = key => {
  return http.post(url.paths.allAnswers, { key });
};

// экспорт метода getTree, который принемает key, отправляет get
// запрос на api, с атрибутом key
export const getTree = key => {
  return http.post(url.paths.tree, { key });
};

export const addNewQuestion = (key, text) => {
  return http.post(url.paths.addNewQuestion, { key, text });
};
export const editQuestion = (key, id, text) => {
  return http.post(url.paths.editQuestion, { key, id, text });
};

