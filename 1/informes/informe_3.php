<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      
	session_start();
	$varsession = $_SESSION['user'];
	
	$sql = "select nombre from usuarios where user = '$varsession'";
	mysqli_select_db('siadcon');
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	      $nombre = $row['nombre'];
	}
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}

	$sql = "select count(genero) as cant from contratos where genero = 'Femenino'";
	mysqli_select_db('siadon');
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	    $mujeres = $row['cant'];
	}
	
	$sql = "select count(genero) as cant from contratos where genero = 'Masculino'";
	mysqli_select_db('siadon');
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	    $hombres = $row['cant'];
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>

  
  
  <style type="text/css">
  h1{
    color: grey;
    text-align: center;
    
    }
  
  h2{
    color: grey;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
  }
  
  h3{
    color: grey;
    text-align: center;
  }
  
  h1.italic {
  font-style: italic;
}
p{
    color: grey;
    text-align: center;
}

  
  </style>
  
  

</head>
<body>
<p><img class="img-reponsive img-rounded" src="../../img/escudo32x32.png" /> Ministerio de Economía de la Nación - Dirección de Presupuesto y Evaluación de Gastos en Personal</p>
<hr>
<h1 class="italic">Sistema de Administración de Contratos</h1>
<h2 >Informe</h2>
<h3>Comparativa Mujeres / Hombres</h3><hr>

<p>Esta es una comparativa de cantidad de Mujeres y Hombres Contratados</p>
<p>Los Valores expresados corresponden a la totalidad de contratos</p>

<?php  
 echo '<p><strong>Cantidad de Mujeres: </strong>' .$mujeres.' </p>';
 echo '<p><strong>Cantidad de Hombres: </strong>' .$hombres.' </p>';

?>


</body>
</html>
