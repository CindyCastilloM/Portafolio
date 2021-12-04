
  <?php
  include_once 'config.php';
  ?>

  <html>
  <head>
    <title>Directorio Activo Ejemplo</title>

    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

  </head>
  <body>
    <style>
    body {
      background-color: hsla(290,60%,70%,0.3);
    }
  </style>
  </body>
  </html>

  <?php
  if(isset($_POST['username']) && isset($_POST['password'])){

   $adServer = "127.0.0.1:3307";  

   $ldap = ldap_connect($adServer);
   $username = $_POST['username'];
   $password = $_POST['password'];
   $ldaprdn = 'cfe' . "\\" . $username;

   ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
   ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

   $conexion = @ldap_bind($ldap, $ldaprdn, $password);
   if ($conexion)
   {

    $filter="(sAMAccountName=$username)";
    $result = ldap_search($ldap,"dc=cfe,dc=mx",$filter);
    ldap_sort($ldap,$result,"sn");
    $info = ldap_get_entries($ldap, $result);

    for ($i=0; $i<$info["count"]; $i++)
   {
      if($info['count'] > 1)
        break; 

      $sql_query = "SELECT * FROM usuarios WHERE rpe='$username' ";

      if(mysqli_query($link,$sql_query)) 
    {
        if (mysqli_num_rows(mysqli_query($link,$sql_query))>0) 
        {
         $row=mysqli_fetch_row(mysqli_query($link,$sql_query));

         session_start();

         $_SESSION["username"] = $info[$i]["givenname"][0];
         $_SESSION["apellido"] = $info[$i]["sn"][0];
         $_SESSION["correo"] = $info[$i]["mail"][0];
         $_SESSION["rol"] = $row[2];


         $userDn = $info[$i]["distinguishedname"][0];
         $array = explode(",",$userDn);
         echo "Zona: ";
         echo substr ($array[2], 3, 5). PHP_EOL;
         echo "<br><br><br>";

         $_SESSION["zona"] =substr ($array[2], 3, 5);
         ?>
         <?php
         header("Location: directorio3.php");
       }
       else
       {
        ?>
        <script type="text/javascript">
          Swal.fire({
            title: 'No tiene permisos para ingresar',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            allowEscapeKey: false,
            allowOutsideClick: false,
          }).then((result) => {
            if (result.value) {
              window.location.href='index.php';
            }
          });
        </script>
        <?php
       }
    }
    else
    {
      ?>
      <script type="text/javascript">
        Swal.fire({
          title: 'No se pudo conectar a base de datos',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok'
          allowEscapeKey: false,
          allowOutsideClick: false,
        }).then((result) => {
          if (result.value) {
            window.location.href='index.php';
          }
        });
      </script>
      <?php
    }
    ?>
    <?php
  }
  @ldap_close($ldap);
  } else 
  {
    ?>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script type="text/javascript">

      Swal.fire({
        title: 'No existe ',
        text: 'Verificar correo o contraseña ',
        icon: 'error',

        confirmButtonColor: '#3085d6',
        allowEscapeKey: false,
        allowOutsideClick: false,

        confirmButtonText: 'Ok'
      }).then((result) => {
        if (result.value) {
          window.location.href='index.php';
        }
      });
    </script>
    <?php
  }
  }else
  {
    header("Location: index.php");
  }
  ?>