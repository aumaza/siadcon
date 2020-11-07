<?php include "../../connection/connection.php"; 
      include "../../functions/functions.php";

        session_start();
	$varsession = $_SESSION['user'];
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}
	
	if($conn){
            
            $data = $_GET['name'];
	         genExcel($data,$conn);
                             
		}else{
		      mysqli_error($conn);
		     }
                                    

  //cerramos la conexion
  
  mysqli_close($conn);

?>

