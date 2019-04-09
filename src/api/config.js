
let ApiRoot = ''; 

if (process.env.NODE_ENV == 'development') {
    ApiRoot = "http://localhost:8000/api";
}else if(process.env.NODE_ENV == 'production'){
    ApiRoot = "/api";
}

export {
	ApiRoot
}