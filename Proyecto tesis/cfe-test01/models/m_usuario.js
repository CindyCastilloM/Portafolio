const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const usuarioSchema = new Schema({
    rpe: {
        type: String,
        required: true,
        minlength: 6
    },
    password: {
        type: String,
        required: true,
        minlength: 6
    },
    email: String,
    rol: String,
    date: {
        type: Date,
        default: Date.now
    }
});

//Creacion del modelo
const usuario = mongoose.model('usuarios', usuarioSchema);
module.exports = usuario;