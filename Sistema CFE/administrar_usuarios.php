    <?php
    include_once 'config.php';

    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM usuarios WHERE id_usuarios=".$_GET['delete_id'];
        mysqli_query($link, $sql_query);
        header("Location: $_SERVER[PHP_SELF]");
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <meta charset=utf-8" />
      <script src="sweetalert2.min.js"></script>
      <link rel="stylesheet" href="sweetalert2.min.css">
      <script type="text/javascript">
      </script>
    </head>

    <script type="text/javascript">
        function edt_id(id)
        {
          
            Swal.fire({
              title: '¿Seguro que deseas editar?',
              
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si!'
          }).then((result) => {
              if (result.value) {
                 window.location.href='editarusuarios.php?edit_id='+id;
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
          confirmButtonText: 'Si!'
      }).then((result) => {
          if (result.value) {
              window.location.href='administrarusuarios.php?delete_id='+id;
          }
      });

    }
    </script>

    <style>

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 50%;
      background-color: white;

    }

    td, th {
      border: 1px solid #dddddd;
      text-align: center;
      padding: 4px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    h1 {
      text-shadow: 2px 2px 10px blue;
    }
    </style>
    <body>
        <title>Administración de usuarios</title>

        <div id="body">
            <h3><li><b><a href="agregarusuarios.php">Agregar usuarios</a></b>
              <li><b><a href="directorio3.php">Atrás</a></b></h3>

                <table BORDER="1" align="center" cellpadding="5" cellspacing="5";>
                    <center><h1 style="border:2px solid DodgerBlue">Usuarios </h1></center>
                    
                    <tr >
                     <th><h3><p style="color:#BF159D";>ID</p></h3></th>
                     <th><h3><p style="color:#BF159D";>rpe</p></h3></th>
                     <th><h3><p style="color:#BF159D";>rol</h3></p></th>
                     <th  style="color:#BF159D"  COLSPAN="2" ><h3>Operaciones</th>
                     </tr>
                 </center>

                 <?php
                 $sql_query="SELECT * FROM usuarios";
                 $result_set=mysqli_query($link,$sql_query);
                 if(mysqli_num_rows($result_set)>0)
                 {
                    while($row=mysqli_fetch_row($result_set)) 
                    {
                      ?>
                      <center>
                        <tr>
                            <th><?php echo $row[0]; ?></th>
                            <th><?php echo $row[1]; ?></th>
                            <th><?php echo $row[2]; ?></th>

                            <td align="center"><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="editar.png" width="60" height="60"align="EDIT" /></a></td>
                            <td align="center"><a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="borrar1.png" width="60" height="60" align="DELETE" /></a></td>
                        </tr>
                    </center>

                    <?php
                }
            }
            ?>
        </table>
    </div>
    </body>
    </html>


