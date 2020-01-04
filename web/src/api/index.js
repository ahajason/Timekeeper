import {ApiRoot} from './config';
import axios from 'axios';

let startRequest = (url, data, scb, fcb) => {
  let requestData = data;
  axios.post(
    ApiRoot + url,
    requestData
  ).then((res) => {
    let response = res.data;
    if (response.success) {
      typeof scb == "function" && scb(response);
    } else {
      typeof fcb == "function" && fcb(response);
      if (response.code == 10001) {
        window.location = '/#/login'
      }
    }
  }).catch((error) => {
    typeof fcb == "function" && fcb(error);
  });
};
export {
  startRequest
}
