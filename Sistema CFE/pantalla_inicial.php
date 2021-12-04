  <?php
  session_start();
  include_once 'config.php';

  if(isset($_GET['delete_id']))
  {
    $sql_query="DELETE FROM jefaturas WHERE id=".$_GET['delete_id'];
    mysqli_query($link, $sql_query);
    header("Location: $_SERVER[PHP_SELF]");
  }
  ?>

<<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Jefaturas</title>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
</head>
<body>
  <ul class="navbar">
    <br><li>Menú </li><br>
    <?php 
    if ($_SESSION["rol"] == "Administrador")
    {
      ?>
      <li><i><b><a href="administrarusuarios.php">Administrar usuarios</a></i></b>
        <?php
      }  
      ?>
      <li><i><b><a href="destruir_sesion.php">Cerrar sesión</a></i></b>
      </ul>
      <center>
       <div style="margin-left:18%;padding:1px 16px;height:1000px;">
        <div id="body">
          <div id="content">
            <table align="center">
                <?php
                echo "<h3>Bienvenido ".$_SESSION[username];
                echo "<h3>Zona ".$_SESSION[zona];

                $_SESSION['instante']   = time();
                ?>

                <script type="text/javascript">
                  function edt_id(id)
                  {
                    Swal.fire({
                      title: 'Seguro que deseas cambiar al responsable?',
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si!'
                    }).then((result) => {
                      if (result.value) {
                       window.location.href='editar.php?edit_id='+id;
                     }
                   });
                  }
                  function delete_id(id)
                  {

                    Swal.fire({
                      title: 'Seguro que deseas eliminar?',

                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes!'
                    }).then((result) => {
                      if (result.value) {
                        window.location.href='directorio3.php?delete_id='+id;
                      }
                    });
                  }
                </script>

                <style>
                table {
                  font-family: arial, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
                  background-color: #00539F;
                }

                td, th {
                  border: 1px solid #dddddd;
                  text-align: left;
                  padding: 8px;
                }

                tr:nth-child(even) {
                  background-color: #dddddd;
                }

                {
                  margin: 0;
                }

                ul {
                  list-style-type: none;
                  margin: 0;
                  padding: 0;
                  width: 15%;
                  background-color: #AECADC;
                  position: fixed;
                  height: 100%;
                  overflow: auto;
                }

                li a {
                  display: block;
                  color: #000;
                  padding: 8px 16px;
                  text-decoration: none;
                }

                li a.active {
                  background-color: #4CAF50;
                  color: white;
                }

                li a:hover:not(.active) {
                  background-color: #555;
                  color: white;
                }

                h1 {
                  text-shadow: 2px 2px 10px blue;
                }
              </style>

              <link rel="stylesheet" href="estilo.css">
              <script type="text/javascript">
                  const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: 'success',
                  title: 'Signed in successfully'
                })
              </script>


              <div id="body">
                <div id="content">
                  <table class= "test" align="center"border="1" cellpadding="5" cellspacing="5" font-family= "arial, sans-serif";> 
                      <center><h1  style="border:2px solid DodgerBlue;">Jefaturas </h1></center>
                      <br>

                      <?php 
                      if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Zona")
                      {
                        ?>
                        <tr> 
                          <th><h3><p style="color:#BF159D";>Proceso</h3></p></th>
                          <th><h3><p style="color:#BF159D";>Jefatura</p></h3></th>
                          <th><h3><p style="color:#BF159D";>Jefe</h3></p></th>
                          <th><h3><p style="color:#BF159D";>RPE</p></h3></th>
                          <th><h3><p style="color:#BF159D";>Correo</h3></p></th>
                          <th  style="color:#BF159D"  COLSPAN="2" ><h3>Operaciones</th>
                          </tr>
                          <?php
                        }  
                        else
                        {
                          ?>
                          <tr > 
                            <th><h3><p style="color:#BF159D";>Proceso</h3></p></th>
                            <th><h3><p style="color:#BF159D";>Jefatura</p></h3></th>
                            <th><h3><p style="color:#BF159D";>Jefe</h3></p></th>
                            <th><h3><p style="color:#BF159D";>RPE</p></h3></th>
                            <th><h3><p style="color:#BF159D";>Correo</h3></p></th>
                            <?php
                          }
                          ?>
                          <?php
                          $sql_query = "SELECT * FROM jefaturas WHERE CONCAT('DU0',centro_trabajo,'0')='$_SESSION[zona]'";

                          $result_set=mysqli_query($link,$sql_query);
                          if(mysqli_num_rows($result_set)>0)
                          {
                            while($row=mysqli_fetch_row($result_set)) 
                            {
                              ?>
                              <center>
                                <tr>
                                  <th><?php echo $row[3]; ?></th>
                                  <th><?php echo $row[5]; ?></th>
                                  <th><?php echo $row[6]; ?></th>
                                  <th><?php echo $row[7]; ?></th>
                                  <th><?php echo $row[9]; ?></th>

                                  <?php 
                                  if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Zona")
                                  {
                                    ?>
                                    <td align="center"><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="editar.png" width="50" height="50"align="EDIT" /></a></td>
                                    <td align="center"><a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="borrar1.png" width="50" height="50" align="DELETE" /></a></td>
                                  </tr>
                                </center>
                                <?php
                              }  
                              else
                              {
                                ?>
                                <?php
                              }
                              ?>  
                              <?php
                            }
                          }
                          else
                          {
                            ?>
                              <script type="text/javascript">
                                Swal.fire({
                                  title: 'Error',
                                  icon: 'error',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok'
                                }).then((result) => {
                                  if (result.value) {
                                    window.location.href='index.php';
                                  }
                                });
                              </script>
                            <?php
                          }
                          ?>
                        </table>
                      </div>
                    </body>
                    </html>
