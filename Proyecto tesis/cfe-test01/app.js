const express = require("express");

var app = express();

// parse application/x-www-form-urlencoded
app.use(express.urlencoded({ extended: true }));

// parse application/json
app.use(express.json());

require('dotenv').config(); 

const port = process.env.PORT || 3001;

//Database conection
const mongoose = require('mongoose');
const uri = `mongodb+srv://${process.env.USER}:${process.env.PASSWORD}@cluster0.l8zlq.mongodb.net/${process.env.DBNAME}?retryWrites=true&w=majority`;

mongoose.connect(uri, 
  {useNewUrlParser: true, useUnifiedTopology: true}
)
  .then(() => console.log('Mongodb database connected!'))
  .catch(e => console.log(e));

// Motor de plantilla
app.set("view engine", "ejs");
app.set("views", __dirname + "/views");

//Archivos estaticos
app.use(express.static(__dirname + "/public"));

//Router del middlewere 
app.use('/', require('./router/r_autorizacion'));
app.use('/empleado', require('./router/r_empleado'));
app.use('/adminusuario', require('./router/r_usuario'));

//Pagina 404 sitio no encontrado
app.use((req, res, next) => {
res.status(404).render("v_404", {titulo:"404 "});
});

//Creacion del servidor web
app.listen(port, () => {
  console.log(`Our app is running on port ${ port }`);
});

