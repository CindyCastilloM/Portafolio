const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const rolSchema = new Schema({ 
    nombre: String
});

//Creacion del modelo
const rol = mongoose.model('roles', rolSchema);

module.exports = rol;