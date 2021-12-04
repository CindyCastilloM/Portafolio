const express = require('express');
const router = express.Router();
const empleado = require('../models/m_empleado');
const zona = require('../models/m_zonas');

//Ruta para cargar toda la lista de empleado
router.get('/search/:busqueda', async (req, res) => {
    const busqueda = req.params.busqueda;
    const arrayempleado = await empleado.findOne({jefe: busqueda});
    res.render('v_empleado', {arrayempleado});
});

//Ruta para cargar toda la lista de empleado
router.get('/', async(req, res) => {
    try
    {
        const arrayempleado = await empleado.find()
        res.render("v_empleado", {arrayempleado});
    }
    catch (error)
    {
        console.log(error);
    }    
});

//Ruta para obtener el formulario para ADMINISTRAR un USUARIO
router.get('/adminusuario', async(req, res) => {
    try
    {
        const arrayzona = await zona.find();
        res.render("v_adminusuarios", {arrayzona});
    }
    catch (error)
    {
        console.log(error);
    }    
});

//Ruta para obtener el formulario para crear un nuevo EMPLEADO
router.get('/crear', async(req, res) => {
    try
    {
        const arrayzona = await zona.find();
        res.render("v_crearempleado", {arrayzona});
    }
    catch (error)
    {
        console.log(error);
    }    
});

//Crear un nuevo empleado
router.post('/', async(req, res) => {
    const body = req.body;
    try {        
        await empleado.create(body);
        res.redirect('/empleado');
    } catch (error) {
        console.log(error);
    }
});

//Ruta para obtener el formulario de edición de un empleado
router.get('/:id', async(req, res) => {
    const id = req.params.id;
    try {
        const empleadoDB = await empleado.findOne({_id: id});
        const arrayzona = await zona.find();

        res.render('v_detalleempleado', {
            empleado: empleadoDB,
            arrayzona,
            error: false
        });
    } catch (error) {
        console.log(error);
        res.render('v_detalleempleado', {
            error: true,
            mensaje: 'No se encuentra el empleado buscado'
        });
    }
});

//Ruta para borrar un empleado específico
router.delete('/:id', async(req, res) => {
    const id = req.params.id;
    try {
        const empleadoDB = await empleado.findOneAndDelete({_id: id});
     
        if(empleadoDB){
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

//Ruta para la edición de un empleado en particular
router.put('/:id', async(req, res) => {
    const id = req.params.id;
    const body = req.body;

    try {
        const empleadoDB = await empleado.findByIdAndUpdate(
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