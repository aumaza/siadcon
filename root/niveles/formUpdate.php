<?php  include "../../functions/functions.php"; ?>
<?php  include "../../connection/connection.php"; 

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

	$id = $_GET['id'];
	

?>


<html><head>
	<meta charset="utf-8">
	<title>Niveles - Actualizar Registro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../icons/actions/bookmarks-organize.png" />
	<?php skeleton();?>
	
</head>
<body background="../../img/background.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">

<div class="container-fluid">
      <div class="row">
      <div class="col-md-12 text-center">
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['user'] ?></button>
	<?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-time"></span> <?php echo "Hora Actual: " . date("H:i"); ?></button>
	 <?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-calendar"></span> <?php echo "Fecha Actual: ". strftime("%d de %B del %Y"); ?> </button>
	</div>
	</div>
	</div>
	<br>

  <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </div>
        
       <?php
        
       if($conn){
       
	mysqli_select_db('siadcon');
	  	
	     if (isset($_POST['A'])){
			    
                            $id = mysqli_real_escape_string($conn,$_POST["id"]);
                            $cod_nivel = mysqli_real_escape_string($conn,$_POST["cod_nivel"]);
                            $cod_nivel = strtoupper($cod_nivel);
                            $descripcion = mysqli_real_escape_string($conn,$_POST["descripcion"]);
                            $descripcion = strtoupper($descripcion);
                                                          
                             if(!empty($cod_nivel) || !empty($descripcion)){
                             updateNivel($id,$cod_nivel,$descripcion,$conn);
			      }else{
				    echo "<br>";
				    echo '<div class="container">';
				    echo '<div class="alert alert-warning" role="alert">';
				    echo "Hay datos que no ha ingresado, reintente!. Aguarde un Instante que será Redireccionado";
				    echo "</div>";
				    echo "</div>";
				    
			      }
			      }
                              }else {

                                      mysqli_error($conn);

                                    }

  //cerramos la conexion
  
  mysqli_close($conn);


?>
<div class="container">
<div class="row">
<div class="col-md-12">
<meta http-equiv="refresh" content="3;URL=../main/main.php "/>
</div>
</div>
</div>


</body>
</html>
