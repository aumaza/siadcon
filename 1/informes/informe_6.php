<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      
	session_start();
	$varsession = $_SESSION['user'];
	
	$sql = "select nombre from usuarios where user = '$varsession'";
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

		
	$sql = "select organismo, count(organismo) as cant from contratos group by organismo";
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	    $organismos[] = $row['organismo'];
	    $cantidad[] = $row['cant'];
	}
	
	
?>



  
  
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
    font-family: Arial, Helvetica, sans-serif;
  }
  
  h1.italic {
  font-style: italic;
}
  p{
    color: grey;
    text-align: center;
}
table{
border-radius: 10px;

}
th{
  background-color: grey;
  color: white;
}
  td, th {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 15px;
  text-align: center;
  border-spacing: 1px;
  width: 45%;
  
}

div{
  
  padding-top: 50px;
  padding-right: 30px;
  padding-bottom: 50px;
  padding-left: 80px;
  
    }



  
  </style>
<page>
<p><img class="img-reponsive img-rounded" src="../../img/escudo32x32.png" /> Ministerio de Economía de la Nación - Dirección de Presupuesto y Evaluación de Gastos en Personal</p>
<hr>
<h1 class="italic">Sistema de Administración de Contratos</h1>
<h2 >Informe</h2>
<h3 >Cantidad de Contratos por Organismo</h3><hr>
<div>
<table style='width:100%'>
  <tr>
    <th>Organismos</th>
    <th>Cantidad de Contratos</th>
    </tr>
   <?php
   foreach(array_combine($organismos, $cantidad) as $org => $cant){
	    echo "<tr>";
	      echo "<td> $org </td> <td> $cant </td>";
		echo "</tr>";
	}
    ?>
 
 </table>
</div>
</page>
