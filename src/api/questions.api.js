import  { url, http } from "./url.js";

// GET ALL
export const getAllQuestions = key => {
  return http.post(url.paths.allQuestions, { key });
};
export const getAllAnswers = key => {
  return http.post(url.paths.allAnswers, { key });
};
// экспорт метода getTree, который принемает key, отправляет get
// запрос на api, с атрибутом key
export const getTree = key => {
  return http.post(url.paths.getTree, { key });
};

// QUESTION
export const addNewQuestion = (key, text) => {
  return http.post(url.paths.addNewQuestion, { key, text });
};
export const editQuestion = (key, id, text) => {
  return http.post(url.paths.editQuestion, { key, id, text });
};
// ANSWERS
export const addNewAnswers = (key, text, question_id, next_question_id, sort) => {
  return http.post(url.paths.addNewAnswers, { key, text, question_id, next_question_id, sort });
};

