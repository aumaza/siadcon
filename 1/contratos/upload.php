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

	$id = $_GET['id'];
?>


<html><head>
	<meta charset="utf-8">
	<title>Subir PDF</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../icons/actions/bookmarks-organize.png" />
	<?php skeleton();?>
	
</head>
<body background="../../img/background.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">

<div class="container-fluid">
      <div class="row">
      <div class="col-md-12 text-center">
	<a href="../main/main.php"><button><span class="glyphicon glyphicon-chevron-left"></span> Volver</button></a>
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
                    <div class="col-md-8">
                    </div>
                </div>
            </div>
        </div>
		    <div class="container">
		      <div class="row">
			<div class="col-sm-8">
			  <div class="alert alert-success" role="alert">
			  <h1><strong>Importante: </strong></h1>
			  <h3>Solo suba archivos con extensión PDF, esto garantiza que el archivo se vea e imprima igual en cualquier computador</h3>
			  </div>
			</div>
		      </div>
                    </div>
                  
                          
	<form action="formUpload.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
	  <div class="container">
	    <div class="row">
	      <div class="col-sm-8">
		<div class="panel panel-default">
		  <div class='panel-heading'>
		    <strong>Seleccione el Archivo a Subir:</strong><br>
		    <input type="file" name="file" class="btn btn-default"><br>
		    <button type="submit" class="btn btn-warning navbar-btn" name="submit"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
		  </div>
		</div>
	      </div>  
	    </div>
	  </div>
	</form>
  </div>



</body>
</html>
