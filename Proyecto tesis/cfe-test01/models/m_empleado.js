const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const empleadoSchema = new Schema({
    centrot: String,
    proceso: String,
    cvjefatura: String,
    jefatura: String,
    jefe: String,
    rpe: String,
    nlvautoridad: String,
    correo: String
});

//Creacion del modelo
const empleado = mongoose.model('empleados', empleadoSchema);

module.exports = empleado;