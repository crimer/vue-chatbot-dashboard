import axios from "axios";
import url from "./url.js";

// экземпляр axios для обращения к api
const http = axios.create({
  baseURL: url.domain
});

export const getAll = () => {
  return false;
};
// экспорт метода getTree, который принемает key, отправляет get
// запрос на api, с атрибутом key
export const getTree = key => {
  return http.get(url.paths.tree, { params: { key } });
};

export const getQuestions = () => {
  return http.get(url.paths.questions);
};
// ?key=f9sl2e
