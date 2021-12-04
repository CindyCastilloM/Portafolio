	<?php
	include_once 'config.php';
	if(isset($_POST['btn-update']))
	{

		$rpe = $_POST['rpe'];
		$rol = $_POST['rol'];
		$sql_query = "UPDATE usuarios SET rpe='$rpe',rol='$rol' WHERE id_usuarios=".$_GET['edit_id'];
		if(mysqli_query($link, $sql_query))
		{
			?>
			<script type="text/javascript">
				alert('Ha sido guardado con éxito');
				window.location.href='administrarusuarios.php';
			</script>
			
			<?php
			//header("Location: administrarusuarios.php");
		}
		else
		{
			//
		}
		// sql query execution function
	}
	if(isset($_GET['edit_id']))
	{
		$sql_query="SELECT * FROM usuarios WHERE id_usuarios=".$_GET['edit_id'];
		$result_set=mysqli_query($link, $sql_query);
		$fetched_row=mysqli_fetch_array($result_set);
		//echo $sql_query;
	}
	if(isset($_POST['btn-cancel']))
	{
		header("Location: administrarusuarios.php");
	}
	?>

	<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Editar usuarios</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
		<body style="background-color:#DDCAF3;">
		</head>

		<body>
			<center>
				<br>
				<h3><th colspan="5"><a href="directorio3.php" style="background-color:Violet;">Regresar</a></th></h3>
				<div id="header">
					<div id="content">
					</div>
				</div>

				<div id="body">
					<div id="content">
						<form method="post">
							<table align="center">
								<br><br>

								<tr>
									<td><input readonly type="text" name="id_usuarios" placeholder="id_usuarios" value="<?php echo $fetched_row['id_usuarios']; ?>" required /></td>
								</tr>
								<tr>
									<td><input maxlength="50"  type="text" name="rpe" placeholder="rpe" value="<?php echo $fetched_row['rpe']; ?>" required /></td>
								</tr>

								<td>
									<select name="rol">
										<option>Administrador</option>
										<option>Zona</option>
										<option>Consulta</option>
									</select>
								</td>
								<tr>
									<td>
										<button type="submit" name="btn-update"><strong>Actualizar</strong></button>
										<button type="submit" name="btn-cancel"><strong>Cancelar</strong></button>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</center>
		</body>
		</html>