<?php


/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/siadcon/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/siadcon/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/siadcon/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/siadcon/skeleton/css/fontawesome.css">
	<link rel="stylesheet" href="/siadcon/skeleton/css/fontawesome.min.css" >
	<link rel="stylesheet" href="/siadcon/skeleton/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="/siadcon/skeleton/Chart.js/Chart.min.css" >
	<link rel="stylesheet" href="/siadcon/skeleton/Chart.js/Chart.css" >
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/siadcon/skeleton/js/jquery-3.4.1.min.js"></script>
	<script src="/siadcon/skeleton/js/bootstrap.min.js"></script>
	
	<script src="/siadcon/skeleton/js/jquery.dataTables.min.js"></script>
	<script src="/siadcon/skeleton/js/dataTables.editor.min.js"></script>
	<script src="/siadcon/skeleton/js/dataTables.select.min.js"></script>
	<script src="/siadcon/skeleton/js/dataTables.buttons.min.js"></script>
	
	<script src="/siadcon/skeleton/Chart.js/Chart.min.js"></script>
	<script src="/siadcon/skeleton/Chart.js/Chart.bundle.min.js"></script>
	<script src="/siadcon/skeleton/Chart.js/Chart.bundle.js"></script>
	<script src="/siadcon/skeleton/Chart.js/Chart.js"></script>';
}


function contratos($conn,$varsession){

if($conn)
{
	$sql = "SELECT * FROM contratos";
    	mysqli_select_db('siadcon');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/apps/preferences-contact-list.png"  class="img-reponsive img-rounded"> Contratos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Cargado</th>
                    <th class='text-nowrap text-center'>Nombre y Apellido</th>
                    <th class='text-nowrap text-center'>DNI</th>
                    <th class='text-nowrap text-center'>Género</th>
                    <th class='text-nowrap text-center'>Escalafón</th>
                    <th class='text-nowrap text-center'>Nivel</th>
                    <th class='text-nowrap text-center'>Organismo</th>
                    <th class='text-nowrap text-center'>Tipo Contrato</th>
                    <th class='text-nowrap text-center'>Monto</th>
                    <th class='text-nowrap text-center'>Desde</th>
                    <th class='text-nowrap text-center'>Hasta</th>
                    <th class='text-nowrap text-center'>GDE</th>
                    <th class='text-nowrap text-center'>Act. Adm.</th>
                    <th class='text-nowrap text-center'>Archivo</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['f_carga']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['nro_dni']."</td>";
			 echo "<td align=center>".$fila['genero']."</td>";
			 echo "<td align=center>".$fila['escalafon']."</td>";
			 echo "<td align=center>".$fila['nivel']."</td>";
			 echo "<td align=center>".$fila['organismo']."</td>";
			 echo "<td align=center>".$fila['tipo_contrato']."</td>";
			 echo "<td align=center>".$fila['monto']."</td>";
			 echo "<td align=center>".$fila['f_from']."</td>";
			 echo "<td align=center>".$fila['f_to']."</td>";
			 echo "<td align=center>".$fila['nro_gde']."</td>";
			 echo "<td align=center>".$fila['act_adm']."</td>";
			 echo "<td align=center>".$fila['file_name']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../contratos/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Editar</a><br>';
			 echo '<a href="#" data-href="../contratos/eliminar.php?id='.$fila['id'].'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Borrar</a><br>';
			 echo '<a href="../contratos/upload.php?id='.$fila['id'].'" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-cloud-upload"></span> PDF</a><br>';
			 echo '<a href="../contratos/download.php?file_name='.$fila['file_name'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-cloud-download"></span> PDF</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


/*
** Funcion alta de contracto
*/
function newContract(){

      echo '<div class="container">
	    <div class="row">
	    <div class="col-sm-8">
	      <h2>Nuevo Contrato</h2><hr>
	        <form action="../contratos/formNuevoRegistro.php" method="POST">
	        <div class="form-group">
		  <label for="nombre">Nombre y Apellido</label>
		  <input type="text" class="form-control" id="nombre" name="nombre"  onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,25);" onKeyUp="limitText(this,25);" required>
		</div>
		<div class="form-group">
		  <label for="apellido">DNI</label>
		  <input type="text" class="form-control" id="dni" name="dni"  onkeyup="this.value=Numeros(this.value);" onKeyDown="limitText(this,11);" onKeyUp="limitText(this,11);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Género</label>
		  <input type="text" class="form-control" id="genero" name="genero" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,9);" onKeyUp="limitText(this,9);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Escalafón</label>
		  <input type="text" class="form-control" id="escalafon" name="escalafon" onkeyup="this.value=Numeros(this.value);" onKeyDown="limitText(this,10);" onKeyUp="limitText(this,10);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Nivel y Grado</label>
		  <input type="text" class="form-control" id="nivel" name="nivel" onKeyDown="limitText(this,5);" onKeyUp="limitText(this,5);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Organismo</label>
		  <input type="text" class="form-control" id="organismo" name="organismo" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,60);" onKeyUp="limitText(this,60);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Tipo Contrato:</label>
		  <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato"  onKeyDown="limitText(this,25);" onKeyUp="limitText(this,25);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Monto:</label>
		  <input type="text" class="form-control" id="monto" name="monto" onkeyup="this.value=Numeros(this.value);" onKeyDown="limitText(this,6);" onKeyUp="limitText(this,6);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Fecha Desde:</label>
		  <input type="date" class="form-control" id="f_from" name="f_from" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Fecha Hasta:</label>
		  <input type="date" class="form-control" id="f_to" name="f_to" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Nro GDE:</label>
		  <input type="text" class="form-control" id="gde" name="gde" onKeyDown="limitText(this,70);" onKeyUp="limitText(this,70);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Acto Administrativo:</label>
		  <input type="text" class="form-control" id="act_adm" name="act_adm" onKeyDown="limitText(this,80);" onKeyUp="limitText(this,80);" required>
		</div>
		
		<button type="submit" class="btn btn-success btn-block" name="A">Agregar</button>
	      </form> <br>
	      
	    </div>
	    </div>
	</div>';

}


/*
** Funcion Editación de contracto
*/
function editContract($id,$conn){

      $sql = "select * from contratos where id = '$id'";
      mysqli_select_db('siadcon');
      $res = mysqli_query($conn,$sql);
      $fila = mysqli_fetch_assoc($res);

      echo '<div class="container">
	    <div class="row">
	    <div class="col-sm-8">
	      <h2>Editar Contrato</h2><hr>
	        <form action="../contratos/formUpdate.php" method="POST">
	        <input type="hidden" id="id" name="id" value="'.$fila['id'].'" />
	        <div class="form-group">
		  <label for="nombre">Nombre y Apellido</label>
		  <input type="text" class="form-control" id="nombre" name="nombre"  value="'.$fila['nombre'].'" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,25);" onKeyUp="limitText(this,25);" required>
		</div>
		<div class="form-group">
		  <label for="apellido">DNI</label>
		  <input type="text" class="form-control" id="dni" name="dni"  value="'.$fila['nro_dni'].'" onkeyup="this.value=Numeros(this.value);" onKeyDown="limitText(this,11);" onKeyUp="limitText(this,11);" required>
		</div>
		<div class="form-group">
		 <label for="pwd">Género</label>
		  <input type="text" class="form-control" id="genero" name="genero" value="'.$fila['genero'].'" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,9);" onKeyUp="limitText(this,9);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Escalafón</label>
		  <input type="text" class="form-control" id="escalafon" name="escalafon" value="'.$fila['escalafon'].'" onkeyup="this.value=Numeros(this.value);" onKeyDown="limitText(this,10);" onKeyUp="limitText(this,10);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Nivel y Grado</label>
		  <input type="text" class="form-control" id="nivel" name="nivel" value="'.$fila['nivel'].'" onKeyDown="limitText(this,5);" onKeyUp="limitText(this,5);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Organismo</label>
		  <input type="text" class="form-control" id="organismo" name="organismo" value="'.$fila['organismo'].'" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,60);" onKeyUp="limitText(this,60);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Tipo Contrato:</label>
		  <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato" value="'.$fila['tipo_contrato'].'" onKeyDown="limitText(this,25);" onKeyUp="limitText(this,25);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Monto:</label>
		  <input type="text" class="form-control" id="monto" name="monto" value="'.$fila['monto'].'" onkeyup="this.value=Numeros(this.value);" onKeyDown="limitText(this,6);" onKeyUp="limitText(this,6);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Fecha Desde:</label>
		  <input type="date" class="form-control" id="f_from" name="f_from" value="'.$fila['f_from'].'" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Fecha Hasta:</label>
		  <input type="date" class="form-control" id="f_to" name="f_to" value="'.$fila['f_to'].'" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Nro GDE:</label>
		  <input type="text" class="form-control" id="gde" name="gde" value="'.$fila['nro_gde'].'" onKeyDown="limitText(this,70);" onKeyUp="limitText(this,70);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Acto Administrativo:</label>
		  <input type="text" class="form-control" id="act_adm" name="act_adm" value="'.$fila['act_adm'].'" onKeyDown="limitText(this,80);" onKeyUp="limitText(this,80);" required>
		</div>
		
		<button type="submit" class="btn btn-success btn-block" name="A">Editar</button>
		</form>
	      <a href="../main/main.php"><button class="btn btn-primary btn-block">Volver</button></a>
	      
	    </div>
	    </div>
	</div>';

}


function updateContract($id,$nombre,$nro_dni,$genero,$escalafon,$nivel,$organismo,$tipo_contrato,$monto,$f_from,$f_to,$nro_gde,$act_adm,$conn){

		
	mysqli_select_db('siadcon');
	$sqlInsert = "update contratos set nombre = '$nombre', nro_dni = '$nro_dni', genero = '$genero', escalafon = '$escalafon', nivel = '$nivel', organismo = '$organismo',
	tipo_contrato = '$tipo_contrato', monto = '$monto', f_from = '$f_from', f_to = '$f_to', nro_gde = '$nro_gde' where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Actualizado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Actualizar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}


function delContract($id,$conn){

		
	mysqli_select_db('siadcon');
	$sql = "delete from contratos where id = '$id'";
           
	$res = mysqli_query($conn,$sql);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Eliminado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Eliminar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}


function loadUser($conn,$nombre){

if($conn)
{
	$sql = "SELECT * FROM usuarios where nombre = '$nombre'";
    	mysqli_select_db('siadcon');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Mis Datos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>Usuario</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuario/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Cambiar Password</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}

function uploadPDF($id,$conn){

  // File upload path
$targetDir = '../../uploads/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('pdf');
    
    if(in_array($fileType, $allowTypes)){
    
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
           
            
            // Insert image file name into database
           
           $sql = "update contratos set file_path = '$targetFilePath', file_name = '$fileName' where id = '$id'";
           mysqli_select_db('siadcon');
	    $insert = mysqli_query($conn,$sql);
         
            if($insert){
            
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/success-img.png" alt="Avatar" class="avatar" ><strong> Base de Datos Actualizada. El Archivo '.$fileName. ' se ha subido correctamente..</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
                
            }else{
		  
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/success-img.png" alt="Avatar" class="avatar" ><strong>El Archivo '.$fileName. ' se ha subido correctamente.</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
                
            } 
        }else{
			  echo '<div class="alert alert-warning" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/think-img.png" alt="Avatar" class="avatar" ><strong> Ups. Hubo un error subiendo el Archivo.</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
        }
    }else{
    
			  echo '<div class="alert alert-danger" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/aircraft-crash64-img.png" alt="Avatar" class="avatar" ><strong> Ups, solo archivos con extensión: PDF son soportados.</strong>';
			  echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
    }
}else{
			  echo '<div class="alert alert-info" role="alert">';
                          echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/refresh-img.png" alt="Avatar" class="avatar" ><strong> Por favor, seleccione al archivo a subir.</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
}




}


function addContract($nombre,$nro_dni,$genero,$escalafon,$nivel,$organismo,$tipo_contrato,$monto,$f_from,$f_to,$nro_gde,$act_adm,$conn){

		
	mysqli_select_db('agenda_sirhu');
	$sqlInsert = "INSERT INTO contratos ".
		"(f_carga,nombre,nro_dni,genero,escalafon,nivel,organismo,tipo_contrato,monto,f_from,f_to,nro_gde,act_adm)".
		"VALUES ".
      "(NOW(),'$nombre','$nro_dni','$genero','$escalafon','$nivel','$organismo','$tipo_contrato','$monto','$f_from','$f_to','$nro_gde', '$act_adm')";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Guardado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al guardar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}






?>