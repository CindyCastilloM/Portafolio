const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const zonaSchema = new Schema({ 
    nombre: String
});

//Creacion del modelo
const zona = mongoose.model('zonas', zonaSchema);

module.exports = zona;