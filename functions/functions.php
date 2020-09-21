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

/*
* Funcion para cambiar los permisos de los usuarios al sistema
*/

function cambiarPermisos($id,$role,$conn){

  $sql = "UPDATE usuarios set role = '$role' where id = '$id'";
  mysqli_select_db('siadcon');
  $retval = mysqli_query($conn,$sql);
  if($retval){
    
    echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-success" role="alert">';
			echo 'Rol Actualizado Satisfactoriamente';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
  
	  }else{
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-warning" role="alert">';
			echo "El usuario no existe. Intente Nuevamente!";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
 
}


/*
* Funcion para agregar usuarios al sistema
*/

function agregarUser($nombre,$user,$email,$pass1,$pass2,$role,$conn){

	mysqli_select_db('siadcon');	

	$sqlInsert = "INSERT INTO usuarios ".
		"(nombre,user,email,password,role)".
		"VALUES ".
      "('$nombre','$user','$email','$pass1','$role')";
		
	
	
	    if(strlen($pass1) <= 15){

	      if(strcmp($pass2, $pass1) == 0){
		    mysqli_query($conn,$sqlInsert);	
		    echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo 'Usuario Creado Satisfactoriamente. Aguarde un Instante que será Redireccionado';
		    echo "</div>";
		    echo "</div>";	
		    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo "Las Contraseñas no Coinciden. Intente Nuevamente!. Aguarde un Instante que será Redireccionado";
			    echo "</div>";
			    echo "</div>";
		    }
		    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo "La supera los 15 caracteres!. Aguarde un Instante que será Redireccionado";
			    echo "</div>";
			    echo "</div>";
		    }
		    
		    
}



function usuarios($conn){

if($conn)
{
	$sql = "SELECT * FROM usuarios";
    	mysqli_select_db('siadcon');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Usuarios';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>Usuario</th>
                    <th class='text-nowrap text-center'>Role</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td align=center>".$fila['role']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuarios/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
			 echo '<a href="#" data-href="../usuarios/eliminar.php?id='.$fila['id'].'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Borrar</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<a href="../usuarios/nuevoRegistro.php"><button type="button" class="btn btn-default"><span class="pull-center "><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Agregar Usuario</button></a><br><hr>';
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}



function editPassUser($id,$conn){

      $sql = "select * from usuarios where id = '$id'";
      mysqli_select_db('siadcon');
      $res = mysqli_query($conn,$sql);
      $fila = mysqli_fetch_assoc($res);
      

      echo '<div class="container">
	    <div class="row">
	    <div class="col-sm-8">
	      <h2>Cambiar Password</h2><hr>
	      
	      <form action="formUpdate.php" method="post">
	      <input type="hidden" id="id" name="id" value="' . $fila['id'].'" />
   
         
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    <input id="text" type="text" class="form-control" value="' . $fila['nombre'].'" name="nombre" value="" onkeyup="this.value=Text(this.value);" readonly required>
	  </div>
	
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    <input id="text" type="text" class="form-control" name="user" onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" value="' . $fila['user'].'" readonly required>
	  </div>
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    <input id="password" type="password" class="form-control" name="pass1" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Password" >
	  </div>
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    <input  type="password" class="form-control" name="pass2" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Repita Password" >
	  </div>
	  <br>
	
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-12" align="left">
	  <button type="submit" class="btn btn-success" name="A"><span class="glyphicon glyphicon-pencil"></span>  Cambiar Password</button>
	  <a href="../main/main.php"><input type="button" value="Volver al Menú Principal" class="btn btn-primary"></a>
	  </div>
	  </div>
	</form> 
	      
	      </div>
	      </div>
	      </div>';

}


/*
* Funcion para editar la contraseña de los usuarios al sistema
*/

function updatePass($id,$pass1,$pass2,$conn){

	$sql = "UPDATE usuarios set password = '$pass1' WHERE id = '$id'";
    	mysqli_select_db('siadcon');
    	
    	
    	if(strcmp($pass2, $pass1) == 0){
    		
		      mysqli_query($conn,$sql);
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-success" role="alert">';
			echo 'Password Actualizado Satisfactoriamente<br>';
			echo 'Aguarde un Instante que será redirigido';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo '<meta http-equiv="refresh" content="4;URL=../main/main.php "/>';
			
	   	}else{
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-danger" role="alert">';
			echo "Las Contraseñas no Coinciden. Intente Nuevamente!<br>";
			echo 'Aguarde un instante que será redirigido';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo '<meta http-equiv="refresh" content="4;URL=../main/main.php "/>';

    	}
   
}


function contratos($conn,$varsession){

if($conn){
	
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
                    <th class='text-nowrap text-center'>Jurisdicción</th>
                    <th class='text-nowrap text-center'>Normativa</th>
                    <th class='text-nowrap text-center'>Excepción</th>
                    <th class='text-nowrap text-center'>UR</th>
                    <th class='text-nowrap text-center'>Monto</th>
                    <th class='text-nowrap text-center'>Desde</th>
                    <th class='text-nowrap text-center'>Hasta</th>
                    <th class='text-nowrap text-center'>GDE</th>
                    <th class='text-nowrap text-center'>Act. Adm.</th>
                    <th class='text-nowrap text-center'>Archivo</th>
                    <th class='text-nowrap text-center'>Observaciones</th>
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
			 echo "<td align=center>".$fila['jurisdiccion']."</td>";
			 echo "<td align=center>".$fila['tipo_contrato']."</td>";
			 echo "<td align=center>".$fila['excepcion']."</td>";
			 echo "<td align=center>".$fila['ur']."</td>";
			 echo "<td align=center>".$fila['monto']."</td>";
			 echo "<td align=center>".$fila['f_from']."</td>";
			 echo "<td align=center>".$fila['f_to']."</td>";
			 echo "<td align=center>".$fila['nro_gde']."</td>";
			 echo "<td align=center>".$fila['act_adm']."</td>";
			 echo "<td align=center>".$fila['file_name']."</td>";
			 echo "<td align=center>".$fila['observaciones']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../contratos/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-pencil"></span> Editar</a><br>';
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
		</div><hr>
		<div class="form-group">
		  <label for="pwd">Género</label><br>
		<div class="checkbox">
		    <label><input type="checkbox" name="genero" value="Femenino"> Femenino</label>
		  </div>
		  <div class="checkbox">
		    <label><input type="checkbox" name="genero" value="Masculino"> Masculino</label>
		  </div><hr>
		  </div>
		<div class="form-group">
		  <label for="pwd">Escalafón</label>
		  <input type="text" class="form-control" id="escalafon" name="escalafon" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Nivel y Grado</label>
		  <input type="text" class="form-control" id="nivel" name="nivel" onKeyDown="limitText(this,5);" onKeyUp="limitText(this,5);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Organismo:</label>
		  <input type="text" class="form-control" id="organismo" name="organismo" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,60);" onKeyUp="limitText(this,60);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Jurisdicción:</label>
		  <input type="text" class="form-control" id="jurisdiccion" name="jurisdiccion" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,60);" onKeyUp="limitText(this,60);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Normativa:</label>
		  <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato"  onKeyDown="limitText(this,25);" onKeyUp="limitText(this,25);" required>
		</div><hr>
		<div class="form-group">
		  <label for="pwd">Excepción</label><br>
		<div class="checkbox">
		    <label><input type="checkbox" name="excepcion" value="Si"> Si</label>
		  </div>
		  <div class="checkbox">
		    <label><input type="checkbox" name="excepcion" value="No"> No</label>
		  </div><hr>
		  </div>
		  <div class="form-group">
		  <label for="pwd">Cantidad UR:</label>
		  <input type="text" class="form-control" id="ur" name="ur" onkeyup="this.value=Numeros(this.value);" onKeyDown="envyText();" onKeyUp="limitText(this,6);" required>
		</div>
		<script>
		  function envyText(){
		      var ur = document.getElementById("ur").value;
		      result = ur * 54.02;
		      monto = parseFloat(result).toFixed(2);      
		      document.getElementById("monto").value = monto;
		  }
		</script>
		<div class="form-group">
		  <label for="pwd">Monto:</label>
		  <input type="text" class="form-control" id="monto" name="monto" onkeyup="this.value=Numeros(this.value);" onKeyDown="limitText(this,10);" onKeyUp="limitText(this,10);" required>
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
		<div class="form-group">
		  <label for="pwd">Observaciones:</label>
		  <textarea class="form-control" id="observaciones" name="observaciones" onKeyDown="limitText(this,120);" onKeyUp="limitText(this,12080);" required></textarea>
		</div>
		
		<button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/devices/media-floppy.png"  class="img-reponsive img-rounded"> Guardar</button>
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
		  <label for="pwd">Jurisdicción</label>
		  <input type="text" class="form-control" id="jurisdiccion" name="jurisdiccion" value="'.$fila['jurisdiccion'].'" onkeyup="this.value=Text(this.value);" onKeyDown="limitText(this,60);" onKeyUp="limitText(this,60);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Normativa:</label>
		  <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato" value="'.$fila['tipo_contrato'].'" onKeyDown="limitText(this,25);" onKeyUp="limitText(this,25);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Excepción:</label>
		  <input type="text" class="form-control" id="excepcion" name="excepcion" value="'.$fila['excepcion'].'" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);" required>
		</div>
		<div class="form-group">
		  <label for="pwd">Cantidad UR:</label>
		  <input type="text" class="form-control" id="ur" name="ur" value="'.$fila['ur'].'" onkeyup="this.value=Numeros(this.value);" onKeyDown="envyText();" onKeyUp="limitText(this,6);" required>
		</div>
		<script>
		  function envyText(){
		      var ur = document.getElementById("ur").value;
		      result = ur * 54.02;
		      monto = parseFloat(result).toFixed(2);      
		      document.getElementById("monto").value = monto;
		  }
		</script>
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
		<div class="form-group">
		  <label for="pwd">Observaciones:</label>
		  <textarea class="form-control" id="observaciones" name="observaciones"  onKeyDown="limitText(this,120);" onKeyUp="limitText(this,12080);" required>'.$fila['observaciones'].'</textarea>
		</div>
		
		<button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/devices/media-floppy.png"  class="img-reponsive img-rounded"> Guardar</button>
		</form>
	      <a href="../main/main.php"><button class="btn btn-primary btn-block"><img src="../../icons/actions/arrow-left.png"  class="img-reponsive img-rounded"> Volver</button></a>
	      
	    </div>
	    </div>
	</div>';

}


function updateContract($id,$nombre,$nro_dni,$genero,$escalafon,$nivel,$organismo,$jurisdiccion,$tipo_contrato,$excepcion,$ur,$monto,$f_from,$f_to,$nro_gde,$act_adm,$obs,$conn){

		
	mysqli_select_db('siadcon');
	$sqlInsert = "update contratos set nombre = '$nombre', nro_dni = '$nro_dni', genero = '$genero', escalafon = '$escalafon', nivel = '$nivel', organismo = '$organismo', jurisdiccion = '$jurisdiccion',
	tipo_contrato = '$tipo_contrato', excepcion = '$excepcion', ur = '$ur', monto = '$monto', f_from = '$f_from', f_to = '$f_to', nro_gde = '$nro_gde', observaciones = '$obs' where id = '$id'";
           
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

if($conn){
	
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
			 echo '<a href="../usuarios/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Cambiar Password</a>';
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


function addContract($nombre,$nro_dni,$genero,$escalafon,$nivel,$organismo,$jurisdiccion,$tipo_contrato,$excepcion,$ur,$monto,$f_from,$f_to,$nro_gde,$act_adm,$obs,$conn){

		
	mysqli_select_db('siadcon');
	$sqlInsert = "INSERT INTO contratos ".
		"(f_carga,nombre,nro_dni,genero,escalafon,nivel,organismo,jurisdiccion,tipo_contrato,excepcion,ur,monto,f_from,f_to,nro_gde,act_adm,observaciones)".
		"VALUES ".
      "(NOW(),'$nombre','$nro_dni','$genero','$escalafon','$nivel','$organismo','$jurisdiccion','$tipo_contrato','$excepcion','$ur','$monto','$f_from','$f_to','$nro_gde', '$act_adm','$obs')";
           
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

/*
** Funcion para generar archivo de password
*/


function gentxt($usuario,$password){
  
  $fileName = "gen_pass/$usuario.pass.txt"; 
  //$mensaje = $password;
  
  if (file_exists($fileName)){
  
  //echo "Archivo Existente...";
  //echo "Se actualizaran los datos...";
  $file = fopen($fileName, 'w+') or die("Se produjo un error al crear el archivo");
  
  fwrite($file, $password) or die("No se pudo escribir en el archivo");
  
  fclose($file);
	
	echo '<div class="alert alert-info" role="alert">';
	echo "Se ha generado su archivo de password. Descargue el archivo generado. Recuerde modificar su Password cuando ingrese nuevamente.";
	echo "</div>";
  echo "<hr>";
  echo '<a href="download_pass.php?file_name='.$fileName.'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Descargar</a>';
 
  }else{
  
      //echo "Se Generará archivo de respaldo..."
      $file = fopen($fileName, 'w') or die("Se produjo un error al crear el archivo");
      fwrite($file, $password) or die("No se pudo escribir en el archivo");
      fclose($file);
	
        echo '<div class="alert alert-info" role="alert">';
	echo "Se ha generado su archivo de password. Descargue el archivo generado. Recuerde modificar su Password cuando ingrese nuevamente.";
	echo "</div>";
        echo "<hr>";
        echo '<a href="download_pass.php?file_name='.$fileName.'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Descargar</a>';
       
  
  }
  
  
}


/*
** Funcion para generar password aleatorio
*/

function genPass(){
    //Se define una cadena de caractares.
    //Os recomiendo desordenar las minúsculas, mayúsculas y números para mejorar la probabilidad.
    $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@";
    //Obtenemos la longitud de la cadena de caracteres
    $stringLong = strlen($string);
 
    //Definimos la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, puedes poner la longitud que necesites
    //Se debe tener en cuenta que cuanto más larga sea más segura será.
    $longPass=15;
 
    //Creamos la contraseña recorriendo la cadena tantas veces como hayamos indicado
    for($i=1 ; $i<=$longPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos = rand(0,$stringLong-1);
 
        //Vamos formando la contraseña con cada carácter aleatorio.
        $pass .= substr($string,$pos,1);
    }
    return $pass;
}

/*
** Funcion para blanquear password
*/

function resetPass($conn,$usuario){

  $password = genPass();
  
  $sql = "UPDATE usuarios SET password = '$password' where user = '$usuario'";
  
  $retval = mysqli_query($conn,$sql);
 
  
  if($retval){
    echo '<div class="container">
      <div class="row">
      <div class="col-md-6">';
    
    echo '<div class="alert alert-success" role="alert">';
    echo "Su Password fue blanqueada con Exito!";
    echo "<br>";
    gentxt($usuario,$password);
    
    echo "</div>";
    echo '</div>
	  </div>
	  </div>';
    
  }else{
    
    echo '<div class="container">
      <div class="row">
      <div class="col-md-6">';
    echo '<div class="alert alert-danger" role="alert">';
    echo "Error al Blanquear Password";
    echo "</div>";
     echo '</div>
	  </div>
	  </div>';
    
  }
   
}


/*
** funcion para subir archivo csv
*/
function get_file(){

	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Archivo';
	echo '</div><br>';
	           
                          
	echo '<form action="../contratos/upload_file.php" method="post" enctype="multipart/form-data">
	  <div class="container">
	    <div class="row">
	      <div class="col-sm-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <strong>Seleccione el Archivo a Subir:</strong><br>
		    <input type="file" name="file" class="btn btn-default"><br>
		    <button type="submit" class="btn btn-warning navbar-btn" name="submit"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
		  </div>
		</div>
	      </div>  
	    </div>
	  </div>
	</form>';

}


function upload_file($conn){
	
	$targetDir = '../contratos/';
	$fileName = basename($_FILES["file"]["name"]);
	$targetFilePath = $targetDir . $fileName;
	$destinationPath = '../../files';

	$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
	
	if($conn){
	
	if(!empty($_FILES["file"]["name"])){
   
   // Allow certain file formats
    $allowTypes = array('csv');
    
    if(in_array($fileType, $allowTypes)){
    
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
        
		echo '<div class="alert alert-success" role="alert">';
		echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/success-img.png" alt="Avatar" class="avatar" ><strong>El Archivo '.$fileName. ' se ha subido correctamente.</strong>';
                echo "</div><hr>";
                
                }else{
		echo '<div class="alert alert-warning" role="alert">';
		echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/think-img.png" alt="Avatar" class="avatar" ><strong> Ups. Hubo un error subiendo el Archivo.</strong>';
                echo "</div><hr>";
                    
                }
                }else{
	    echo '<div class="alert alert-danger" role="alert">';
	    echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/aircraft-crash64-img.png" alt="Avatar" class="avatar" ><strong> Ups, solo archivos con extensión: CSV son soportados.</strong>';
	    echo "</div><hr>";
            
           }
           
          
	   $archivo = fopen($fileName, "r");
            // Insert image file name into database
            
            while (($data = fgetcsv($archivo, 1000, ",")) !== FALSE) {
		
		$sql = "INSERT INTO contratos ".
		"(f_carga,nombre,nro_dni,genero,escalafon,nivel,organismo,jurisdiccion,tipo_contrato,excepcion,ur,monto,f_from,f_to,nro_gde,act_adm,observaciones)".
		"VALUES ".
		"(NOW(),'$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]')";
           
		//echo $sql;
		mysqli_select_db('siadcon');
		$res = mysqli_query($conn,$sql);
		
           }
                 //$res = mysqli_query($conn,$sql);
                 fclose($archivo);
             
	      
	     if($res){
            
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/success-img.png" alt="Avatar" class="avatar" ><strong> Base de Datos Actualizada correctamente..</strong>';
                          echo "</div><hr>";
                          copy($fileName, "$destinationPath/$fileName");
                          unlink($fileName);
                                          
            }else{
			  echo mysqli_error($conn);
			  echo '<div class="alert alert-danger" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/think-img.png" alt="Avatar" class="avatar" ><strong>No se ha podido Actualizar la base de datos. </strong></h1>';
                          echo "</div><hr>";
                          
                
            }
           
          
                      
        
        }else{
			  echo '<div class="alert alert-info" role="alert">';
                          echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/refresh-img.png" alt="Avatar" class="avatar" ><strong> Por favor, seleccione al archivo a subir.</strong>';
                          echo "</div><hr>";
                          
}
}else{

  mysqli_error($conn);
}


}

/*
** Funcion que genera logs de log-in
*/

function logs($var){
      
      $fileName = "logs/$var.log.txt"; 
      $date = date("d/m/Y H:i:s");
      $message = 'Ultimo ingreso: '.$date;
       
  if (file_exists($fileName)){
  
  $file = fopen($fileName, 'a') or die("Se produjo un error al crear el archivo");
  fwrite($file, "\n".$date) or die("No se pudo escribir en el archivo");
  fclose($file);
  chmod($file, 0777);
  
  }else{
      $file = fopen($fileName, 'w') or die("Se produjo un error al crear el archivo");
      fwrite($file, $message) or die("No se pudo escribir en el archivo");
      fclose($file);
      chmod($file, 0777);
      }
  
}

/*
** funcion para realizar backup de directorio
*/
function backup(){

	 $message=shell_exec("../../backup.sh");
         echo '<div class="alert alert-success" role="alert">';
	 echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"><strong> '.print_r($message).'</strong></h1>';
         echo "</div>";
         

}


?>