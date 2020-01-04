let ApiRoot = '';

if (process.env.NODE_ENV == 'development') {
  ApiRoot = "http://timekeeper.dev.com/api";
} else if (process.env.NODE_ENV == 'production') {
  ApiRoot = "/api";
}

export {
  ApiRoot
}
