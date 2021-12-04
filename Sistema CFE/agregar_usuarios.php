    <?php
    include_once 'config.php';
    if(isset($_POST['btn-save']))
    {
        $rpe = $_POST['rpe'];
        $rol = $_POST['rol'];
        
        $sql_query = "INSERT INTO usuarios ( rpe, rol) VALUES( '$rpe','$rol')";
        
        if(mysqli_query($link,$sql_query))
        {
            ?>
            <script type="text/javascript">
                alert('Se ha guardado con éxito ');
                window.location.href='administrarusuarios.php';
            </script>
            <?php
        }
        else
        {
            ?>
            <script type="text/javascript">
                alert('Error en la base de datos');
            </script>
            <?php
        }
    }
    ?>
    <!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Usuarios</title>
        <body style="background-color:#EDE4F6;">
            <link rel="stylesheet" href="style.css" type="text/css" />
        </head>

        <body>
            <center>
                <div id="header">
                    <div id="body">
                      <div id="content">
                        <form method="post">
                            <table align="center">
                                <tr></tr></tr><table BORDER="1" cellpadding="5" cellspacing="5" width="80%";>
                                    <h1>Usuarios</h1>
                                    <h3><li><i><b><a href="administrarusuarios.php">Atrás</a></i></b></h3>
                                     <th><H3><p style="color:#BF159D";>rpe</p></H3></th>
                                     <tr>
                                        <td><input type="text" name="rpe"  required /></td>
                                    </tr>

                                    <th><h3><p style="color:#BF159D";>Rol</p></h3>
                                        <select name="rol">
                                            <option>Administrador</option>
                                            <option>Zona</option>
                                            <option>Consulta</option>
                                        </select>
                                    </tr>
                                </th>
                                <td><button type="submit" name="btn-save"><strong>GUARDAR</strong></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

        </center>
    </body>
    </html>
