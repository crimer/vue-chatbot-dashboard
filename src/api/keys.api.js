import url, { http } from "./url.js";

export const getAllKeys = () => {
  return http.post(url.paths.allKeys, { key: "f9sl2e" });
};

export const registerNewKey = newKey => {
  return http.post(url.paths.registerKey, { key: newKey });
};

export const deleteKey = deleteKeyId => {
  return http.post(url.paths.deleteKey, { key_id: deleteKeyId });
};

export const keyInfo = () => {
  return http.post(url.paths.keyInfo, { key: "f9sl2e" });
};
