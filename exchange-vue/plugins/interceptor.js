let cancelObj = {}
export default function(ctx) {
  let { app, $axios, redirect, store, route } = ctx
  let cacheConfig = []

  $axios.onRequest(
    (config) => {
      let token = localStorage.getItem("jwt_token")
      if(token)
      config.headers.Authorization= token

      return config
    },
    (error) => Promise.reject({ meta: error, data: null })
  )

    $axios.onError(async error => {
      if(error.response || error.message)
        app.$toast.show(error.response? `${error.response.data.meta.msg} ` : error.message , {
          type: 'error',
          icon: 'error'
        })
    return error
    // if (code === 400) {
    //   redirect('/400')
    // }
  })
}
