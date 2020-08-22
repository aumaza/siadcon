<?php include "connection/connection.php";
      include "functions/functions.php";

	$user = mysqli_real_escape_string($conn,$_POST["user"]);
	$pass1 = mysqli_real_escape_string($conn,$_POST["pass"]);
	session_start();
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass1;
	
      if($conn){
	        
	mysqli_select_db('siadcon');
	
	$sql = "SELECT * FROM usuarios where user='$user' and password='$pass1' and role = 1";
	$q = mysqli_query($conn,$sql);
	
	$query = "SELECT * FROM usuarios where user='$user' and password='$pass1' and role = 0";
	$retval = mysqli_query($conn,$query);
	
	}

?>
  <html style="height: 100%">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="icons/actions/bookmarks-organize.png" />
   <?php skeleton();?>
	
    <title>Bienvenido</title>
    </head>
    <body background="img/login-img.jpg" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover" style="height: 100%"><br>
    <div class="container">
    <div class="main">
    <h2></h2>

<?php
	
    		if(!$q && !$retval){	
			echo '<div class="alert alert-danger" role="alert">';
			echo "Error de Conexion..." .mysqli_error($conn);
			echo "</div>";
			echo '<a href="index.html"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
			exit;			
			
			}
		
			if($user = mysqli_fetch_assoc($retval)){
				

				echo '<div class="alert alert-danger" role="alert">';
				echo "<strong>Atención!  </strong>" .$_SESSION["user"];
				echo "<br>";
				echo '<span class="pull-center "><img src="icons/status/security-low.png"  class="img-reponsive img-rounded"><strong> Usuario Bloqueado. Contacte al Administrador.</strong>';
				echo "</div>";
				echo '<meta http-equiv="refresh" content="5;URL=logout.php "/>';
				exit;
			}

			else if($user = mysqli_fetch_assoc($q)){

				if(strcmp($_SESSION["user"], 'root') == 0){

				echo "<br>";
				echo '<div class="alert alert-success" role="alert">';
				echo '<span class="pull-center "><img src="img/tenor.gif" class="img-reponsive img-rounded" weight="5%" height="5%">';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=root/main/main.php "/>';
				//echo '<a href="root/main.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a><br>';		
			}else{
				echo '<div class="alert alert-success" role="alert">';
				echo '<span class="pull-center "><img src="img/tenor.gif" class="img-reponsive img-rounded"  weight="5%" height="5%">';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=1/main/main.php "/>';
				//echo '<a href="1/main.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a><br>';
			}
			}else{
				echo '<div class="alert alert-danger" role="alert">';
				echo '<span class="pull-center "><img src="icons/status/dialog-warning.png"  class="img-reponsive img-rounded"> Usuario o Contraseña Incorrecta. Reintente Por Favor....';
				//echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
				echo "</div>";
				echo '<meta http-equiv="refresh" content="5;URL=logout.php "/>';
				}
	
			
	
	//cerramos la conexion
	
	mysqli_close($conn);
    ?>
</div>
</div>
</body>
</html>