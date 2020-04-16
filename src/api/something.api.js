import url, { http } from "./url.js";
import Axios from "axios";

export const getAll = () => {
  return false;
};
// экспорт метода getTree, который принемает key, отправляет get
// запрос на api, с атрибутом key
export const getTree = key => {
  return http.get(url.paths.tree, { params: { key } });
};

// TODO: удалить
export const getQuestions = () => {
  return Axios.get(url.paths.questions);
};
// ?key=f9sl2e
