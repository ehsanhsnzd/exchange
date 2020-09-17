import axios from 'axios'

export function  isJson(str) {
  let parsedJson
  try {
    parsedJson = JSON.parse(str)
  }catch (e) {
    return false
  }
  return parsedJson
}



export function execute(method, resource, data, params) {
  return window.$nuxt
    .$axios({
      method,
      url: 'http://localhost:84'+resource,
      data,
      params
    })
    .then((res) => {
      if (res) return res.data
    })
    .catch(err=>{
      return err.response.data
    })
}

