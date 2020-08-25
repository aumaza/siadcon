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
	
	//cantidad de mujeres
	$muejeres = 0;
	$ql = "select genero from contratos where genero = 'Femenino'";
	mysqli_select_db('siadcon');
	$res = mysqli_query($conn,$ql);
	while($row = mysqli_fetch_array($res)){
	    $mujeres++;
	}
	
	//cantidad de hombres
	$hombres = 0;
	$query = "select genero from contratos where genero = 'Masculino'";
	mysqli_select_db('siadcon');
	$res = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($res)){
	    $hombres++;
	}
	
	//cantidad de mujeres por organismo
	$sql = "select organismo, count(genero) as femenino from contratos where genero = 'Femenino' group by organismo";
	mysqli_select_db('siadcon');
	$res = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($res)){
	       $label[] = $row['organismo'];
	       $genre[] = $row['femenino'];
	}
	$labels = json_encode($label);
	$data = json_encode($genre);
	
	//cantidad de hombres por organismo
	$consql = "select organismo, count(genero) as masculino from contratos where genero = 'Masculino' group by organismo";
	mysqli_select_db('siadcon');
	$resval = mysqli_query($conn, $consql);
	while($fila = mysqli_fetch_array($resval)){
	     $label1[] = $fila['organismo'];
	     $genre1[] = $fila['masculino'];
	}
	$labels1 = json_encode($label1);
	$data1 = json_encode($genre1);
	
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <title>Informes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../../icons/places/folder-bookmark.png" />
  <?php skeleton(); ?>
  
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Sistema de Administración de Contratos</h1>      
    <p>Informes</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-list-alt"></span> Informes</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Deals</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../main/main.php"><span class="glyphicon glyphicon-chevron-left"></span> Volver</a></li>
       </ul>
    </div>
  </div>
</nav>

<!-- primer bloque -->
<div class="container">    
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading">Cantidad de Mujeres Contratadas</div>
         <div class="panel-body"><canvas id="myChart" width="600" height="600"></canvas>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ['Mujeres'],
        datasets: [{
            label: 'Mujeres',
            data: [<?php echo $mujeres;?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>   
  </div>
       
        <div class="panel-footer">Contratos Mujeres: <?php echo $mujeres; ?></div>
      </div>
    </div>
    
    <div class="col-sm-6"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Cantidad de Hombres Contratados</div>
         <div class="panel-body"><canvas id="myChart1" width="600" height="600"></canvas>
<script>
var ctx = document.getElementById('myChart1');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ['Hombres'],
        datasets: [{
            label: 'Hombres',
            data: [<?php echo $hombres;?>],
            backgroundColor: [
             'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
               'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>   
  </div>
         <div class="panel-footer">Contratos Hombres: <?php echo $hombres; ?></div>
      </div>
    </div>
    </div>
    </div>
<!-- end primer bloque -->

<!-- segundo bloque -->
   <div class="container">
   <div class="row">
   <div class="col-sm-6"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Comparativa Hombres/Mujeres</div>
             <div class="panel-body"><canvas id="myChart2" width="600" height="600"></canvas>
<script>
var ctx = document.getElementById('myChart2');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["Mujeres","Hombres"],
        datasets: [{
            label: ['Cantidad'],
            data: [<?php echo $mujeres .','. $hombres;?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>   
  </div>
        <?php $total = $mujeres + $hombres; ?>
        <div class="panel-footer">Total: <?php echo $total; ?></div>
      </div>
    </div>
     
  
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading">Cantidad Contratos Mujeres por Organismo</div>
       
        <div class="panel-body"><canvas id="myChart3" width="600" height="600"></canvas>
       <script>
	var ctx = document.getElementById('myChart3');
	var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $labels; ?>,
        datasets: [{
            label: ['Cantidad'],
            data: <?php echo $data; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>    
</div>
     
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    </div>
    </div>
    </div>
<!-- end segundo bloque -->
   
<!-- tercer bloque -->   
   <div class="container">
   <div class="row">
   <div class="col-sm-6"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Cantidad Contratos Hombres por Organismo</div>
             <div class="panel-body"><canvas id="myChart4" width="600" height="600"></canvas>
<script>
var ctx = document.getElementById('myChart4');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: <?php echo $labels1; ?>,
        datasets: [{
            label: ['Cantidad'],
            data: <?php echo $data1; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>   
  </div>
        <?php $total = $mujeres + $hombres; ?>
        <div class="panel-footer">Total: <?php echo $total; ?></div>
      </div>
    </div>
     
  
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading">Cantidad Contratos Mujeres por Organismo</div>
       
        <div class="panel-body"><canvas id="myChart5" width="600" height="600"></canvas>
       <script>
	var ctx = document.getElementById('myChart5');
	var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $labels; ?>,
        datasets: [{
            label: ['Cantidad'],
            data: <?php echo $data; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>    
</div>
     
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    </div>
    </div>
    </div>
<!-- end tercer bloque -->  

<footer class="container-fluid text-center">
  <p>Ministerio de Economia - Dirección de Presupuesto y Evaluación de Gastos en Personal</p>  
</footer>


</body>
</html>
