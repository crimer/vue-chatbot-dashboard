import { url, http } from "./url.js";

export const getAllKeys = key => {
  return http.post(url.paths.allKeys, { key });
};

export const registerNewKey = key => {
  return http.post(url.paths.registerKey, { key });
};

export const deleteKey = (key, deleteKeyId) => {
  return http.post(url.paths.deleteKey, { key, key_id: deleteKeyId });
};

export const keyInfo = key => {
  return http.post(url.paths.keyInfo, { keykey });
};

export const keyCheck = key => {
  return http.post(url.paths.keyCheck, { key });
};
