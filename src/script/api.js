/**
const serverAddress = "http://localhost:8000";
const prefix = "API"



function upload(filePath, data, scb, fcb) {
  let requestData = data;
  let commonParam = getApp().globalData.commonApiParam;
  if (commonParam) {
    for (let key in commonParam) {
      requestData[key] = commonParam[key]
    }
  }

  wx.uploadFile({
    url: serverAddr + '/wxapp/upload',
    filePath: filePath,
    name: 'file',
    formData: requestData, // HTTP 请求中其他额外的 form data
    success: function(res){
      parseResponse(res, scb, fcb);
    },
    fail: function(res) {
      console.error(res);
      typeof fcb == "function" && fcb(res);
    }
  });
}

function login(data, scb, fcb) {
  let url = serverAddr + '/wxapp/login';
  startRequest(url, data, scb, fcb);
}

function modifyPhone(data, scb, fcb) {
  let url = serverAddr + '/wxapp/modifyPhone';
  startRequest(url, data, scb, fcb);
}

function getPhoneNum(data, scb, fcb) {
  let url = serverAddr + '/wxapp/getPhoneNum';
  startRequest(url, data, scb, fcb);
}

function recordShare(data, scb, fcb) {
  let url = serverAddr + '/wxapp/recordShare';
  startRequest(url, data, scb, fcb);
}

function getRecipient(data, scb, fcb) {
  let url = serverAddr + '/wxapp/getRecipient';
  startRequest(url, data, scb, fcb);
}

function updateRecipient(data, scb, fcb) {
  let url = serverAddr + '/wxapp/updateRecipient';
  startRequest(url, data, scb, fcb);
}

function drawLottery(data, scb, fcb) {
  let url = serverAddr + '/wxapp/drawLottery';
  startRequest(url, data, scb, fcb);
}

function getWinners(data, scb, fcb) {
  let url = serverAddr + '/wxapp/getWinners';
  startRequest(url, data, scb, fcb);
}

function startRequest(url, data, scb, fcb) {
  let requestData = data;
  let commonParam = getApp().globalData.commonApiParam;
  if (commonParam) {
    for (let key in commonParam) {
      requestData[key] = commonParam[key]
    }
  }
  console.log(`request param:${JSON.stringify(requestData)}`);
  wx.request({
    url: url,
    method: 'POST',
    data: requestData,
    success: function(res){
      parseResponse(res, scb, fcb);
    },
    fail: function(res) {
      console.error(res);
      typeof fcb == "function" && fcb(res);
    }
  });
}

function parseResponse(res, scb, fcb) {
  let data = res.data;
  if (typeof(res.data) == "string") {
      data = JSON.parse(res.data.trim());
  }
  if (data.result == 1) {
    console.debug(res);
    typeof scb == "function" && scb(data.response);
  } else {
    console.error(res);
    typeof fcb == "function" && fcb(res);
  }
}








export default api;

*/