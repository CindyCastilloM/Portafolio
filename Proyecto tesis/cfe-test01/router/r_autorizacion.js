const router = require('express').Router();
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const empleado = require('../models/m_empleado');
const User = require('../models/m_usuario');

router.get('/', (req, res) => {
    res.render("v_login", {titulo:"CFE Login"});
});

// constraseña
router.post('/register', async (req, res) => {

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

router.post('/login', async (req, res) => {    
    const user = await User.findOne({ rpe: req.body.rpe });
    
    if (!user)
    {
        //return res.status(400).json({ error: 'Usuario no encontrado' });
        return res.render("v_loginfail");
    }

    const passwordValido = await bcrypt.compare(req.body.password, user.password);

    if (!passwordValido) 
    {
        //return res.status(400).json({ error: 'contraseña no válida' });
        //res.render('');
        return res.render("v_loginfail");
    }

    // create token
    /*
    const token = jwt.sign({
        rpe: user.rpe,
        id: user._id
    }, process.env.TOKEN_SECRET);*/
    
    /*res.json({
        error: null,
        data: 'exito bienvenido',
        token: token
    });*/

    res.redirect('/empleado');
});

module.exports = router;