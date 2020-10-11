const http = require('http'),
    express = require('express'),
    app = express(),
    bodyParser = require('body-parser');


app.set('views',__dirname+'/views');
app.set('view engine','ejs');
app.use(express.static(__dirname+'/public'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));

app.use('/',require('./router/index')); // 访问index交给router admin.js处理

http.createServer(app).listen(3000);