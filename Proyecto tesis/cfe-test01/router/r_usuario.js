const express = require('express');
const router = express.Router();
const usuario = require('../models/m_usuario');
const rol = require('../models/m_rol');

//Ruta para cargar toda la lista de usuarios
router.get('/', async(req, res) => {
    
    try
    {
        const arrayusuario = await usuario.find();

        res.render("v_adminusuarios", {arrayusuario});
    }
    catch (error)
    {
        console.log(error);
    }    
});

//Ruta para obtener el formulario para crear un nuevo USUARIO
router.get('/crearusuario', async(req, res) => {
    try
    {
        const arrayrol = await rol.find();
        res.render("v_crearusuario", {arrayrol});
    }
    catch (error)
    {
        console.log(error);
    }    
});

//Crear un nuevo usuario
router.post('/', async (req, res) => {

    //Email unique constraint
    const rpeExiste = await User.findOne({ rpe: req.body.rpe });
    if (rpeExiste) {
        return res.status(400).json(
            {error: 'RPE ya registrado!'}
        );
    }

    // hash contraseña
    const salt = await bcrypt.genSalt(10);
    const passwordhash = await bcrypt.hash(req.body.password, salt);

    const user = new User({
        rpe: req.body.rpe,
        email: req.body.email,
        password: passwordhash,
        rol: req.body.rol
    });

    try {
        const savedUser = await user.save();
        res.json({
            error: null,
            data: savedUser
        });
    } catch (error) {
        res.status(400).json({error});
    }
});

//Editar un usuario
router.get('/editarusuario', async(req, res) => {
    try
    {
        const arrayrol = await rol.find();
        res.render("v_editarusuario", {arrayrol});
    }
    catch (error)
    {
        console.log(error);
    }    
});


//Ruta para obtener el formulario de edición de un USUARIO
router.get('/:id', async(req, res) => {
    const id = req.params.id;
    try {
        const usuarioDB = await usuario.findOne({_id: id});
        const arrayrol = await rol.find();

        res.render('v_editarusuario', {
            usuario: usuarioDB,
            arrayrol,
            error: false
        });
    } catch (error) {
        console.log(error);
        res.render('v_editarusuario', {
            error: true,
            mensaje: 'No se encuentra el usuario buscado'
        });
    }
});

//Ruta para borrar un USUARIO específico
router.delete('/:id', async(req, res) => {
    const id = req.params.id;
    try {
        const usuarioDB = await usuario.findOneAndDelete({_id: id});
     
        if(usuarioDB){
            res.json({
                estado: true,
                mensaje: 'Eliminado'
            });
        }
        else{
            res.json({
                estado: false,
                mensaje: 'No se pudo eliminar'
            });
        }
    } catch (error) {
        console.log(error);
    }
});

//Ruta para la edición de un USUARIO en particular
router.put('/:id', async(req, res) => {
    const id = req.params.id;
    const body = req.body;

    try {
        const usuarioDB = await usuario.findByIdAndUpdate(
            id, body, { useFindAndModify: false }
        );
        res.json({
            estado: true,
            mensaje: 'Información editada'
        });
    } catch (error) {
        console.log(error);
        res.json({
            estado: false,
            mensaje: 'Error al editar'
        });
    }
});


module.exports = router;