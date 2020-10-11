const mysql = require('mysql');

module.exports = function (code, value, callback) {
    let config = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        port: "3306",
        database: "ont"
    });
    config.connect();
    config.query(code,value,(err,data)=>{
        callback() && callback(err,data);
    });
    config.end();
};