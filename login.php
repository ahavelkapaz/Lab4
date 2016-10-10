<?php
session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		echo 'Hola ' . $_SESSION['user'] . '<br>';
		echo '<a href="verPreguntas.php">Ver preguntas</a><br>';
		echo '<a href="register_quiz.php">Registrar una nueva pregunta</a><br>';
		echo '<a href="logout.php">Cerrar Sesion</a>';
		exit();
	}

?>

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>
<div class="container">
	<div class="row">
        <div class="col-sm-6">
            <div class="login">
        		<div class="panel panel-default">
                  <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Acceso Usuarios</div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" method="POST">
                             <div class="form-group">
                                <label class="sr-only" for="Uemail">Email address</label>
                                <input type="text" class="form-control" id="Uemail" name= "Uemail" placeholder="Email">
                              </div>                        
                             <div class="form-group">
                                <label class="sr-only" for="Uemail">Password</label>
                                <input type="password" class="form-control" id="Upassword" name= "Upassword" placeholder="Password">
                              </div>
                              <button type="submit" class="btn btn-success">Login</button>
                        </form>                        
                    </div>
                  </div>
                </div>

            </div>
        </div>
	</div>
</body>


<?php
require_once 'db_config.php';

if(isset($_REQUEST['Uemail'])){
	

//Recibimos las dos variables
$usuario=mysqli_real_escape_string($conn,$_REQUEST["Uemail"]);
$password=mysqli_real_escape_string($conn,$_REQUEST["Upassword"]);

$users = mysqli_query($conn,"SELECT * FROM users WHERE email = '$usuario' AND password = '$password'");


if(mysqli_num_rows($users) > 0) 
{

    session_start();
 
		$_SESSION['user']="$usuario";
	    $_SESSION['loggedin'] = true;
		$row = mysqli_fetch_array( $users);
	    $_SESSION['rol'] = $row['rol'];
	    $_SESSION['start'] = time();
	    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
		
		echo "Bienvenido! " . $_SESSION['user'];
		mysqli_close($conn); 
		header("Location: login.php");
 
    exit(); 
}
 
else 
{

   $mensajeaccesoincorrecto = "El usuario y la contraseña son incorrectos, por favor vuelva a introducirlos.";
   echo $mensajeaccesoincorrecto . '<a href="registro.html">Registrate</a>'; 
}

mysqli_close($conn); 
}
?>
