<?php  include "../../functions/functions.php";
       include "../../connection/connection.php"; 

	session_start();
	$varsession = $_SESSION['user'];
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../index.html"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}



?>


<html><head>
	<meta charset="utf-8">
	<title>Nuevo Registro</title>
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
	  	
	     if (isset($_POST['A'])) {
	     
			    $nombre = mysqli_real_escape_string($conn,$_POST["nombre"]);
                            $nro_dni = mysqli_real_escape_string($conn,$_POST["dni"]);
                            $genero = mysqli_real_escape_string($conn,$_POST["genero"]);
                            $escalafon = mysqli_real_escape_string($conn,$_POST["escalafon"]);
                            $nivel = mysqli_real_escape_string($conn,$_POST["nivel"]);
                            $organismo = mysqli_real_escape_string($conn,$_POST["organismo"]);
                            $organismo = strtoupper($organismo);
                            $tipo_contrato = mysqli_real_escape_string($conn,$_POST["tipo_contrato"]);
                            $monto = mysqli_real_escape_string($conn,$_POST["monto"]);
                            $f_from = mysqli_real_escape_string($conn,$_POST["f_from"]);
                            $f_to = mysqli_real_escape_string($conn,$_POST["f_to"]);
                            $nro_gde = mysqli_real_escape_string($conn,$_POST["gde"]);
                            $act_adm = mysqli_real_escape_string($conn,$_POST["act_adm"]);
                                                        
                             addContract($nombre,$nro_dni,$genero,$escalafon,$nivel,$organismo,$tipo_contrato,$monto,$f_from,$f_to,$nro_gde,$act_adm,$conn);
                            }
                            }else{
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
