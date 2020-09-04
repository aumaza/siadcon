<?php
      include "../../connection/connection.php";
      include "../../functions/functions.php";

	session_start();
	$varsession = $_SESSION['user'];
	
	if($conn){
	$sql = "SELECT nombre FROM usuarios where user = '$varsession'";
	mysqli_select_db('siadcon');
        $retval = mysqli_query($conn,$sql);
        
        while($fila = mysqli_fetch_array($retval)){
	  $nombre = $fila['nombre'];
	  }
	  }else{
		echo "Error...". mysqli_error($conn);
	  }
        
	
	      
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../index.html"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}

	$archivo = basename($_GET['file_name']);
	

//Si la variable archivo que pasamos por URL no esta 
//establecida acabamos la ejecucion del script.
if($archivo){
//if (!isset($_GET['file_name']) || empty($_GET['file_name'])) {
   
   $path = '../../uploads/'.$archivo;
  
  
//Utilizamos basename por seguridad, devuelve el 
//nombre del archivo eliminando cualquier ruta. 
//$file = basename($_GET['file_name']);

//$path = 'uploads/tabs'.$file;

if (is_file($path))
{
   header('Content-Type: application/force-download');
   header('Content-Disposition: attachment; filename='.$archivo);
   header('Content-Transfer-Encoding: binary');
   header('Content-Length: '.filesize($path));

   readfile($path);
}
}else{
    echo '<html><head>';
	  skeleton();
    echo '</head><body background="../../img/background.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">';
    echo '<div class="section"><br>
	  <div class="container">
	  <div class="row">
	  <div class="col-md-12">';
    echo '<div class="alert alert-danger" role="alert">';
    echo '<p><img class="img-reponsive img-rounded" src="../../icons/status/task-attention.png" /> No hay archivo cargado aún. Cargue uno desde el botón PDF upload!</p>';
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo '</body></html>';
    echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
   }
?>