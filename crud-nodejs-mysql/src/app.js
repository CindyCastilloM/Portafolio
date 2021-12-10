const express = require('express');
const path =require('path');
const morgan =require('morgan');
const mysql = require('mysql');
const myConnection = require('express-myconnection');

const app = express();

//importando rutas
const customerRoutes = require('./routes/customer');
const { urlencoded } = require('express');


// settings (aqui poner puerto que da el servidor)
app.set('port', process.env.PORT || 3000);
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

//middelwares (son funciones) se declaran arriba y aqui se usan
app.use(morgan('dev'));
app.use(myConnection(mysql, {
    host: 'localhost',
    user: 'root',
    password: 'cindy',
    port: 3306,
    database: 'crudnodejsmysql'
}, 'single'));
app.use(express.urlencoded({extended: false}));

//routes
app.use('/', customerRoutes);

//archivos estaticos (archivos css, frameworks, jsfront, etc)
app.use(express.static(path.join(__dirname, 'public')));

//empezando el servidor
app.listen(app.get('port'), () => {
    console.log('Server on port 3000');
});