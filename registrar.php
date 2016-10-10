<?php

	require_once 'db_config.php';

	$user_name = $_POST['nombre'];
	$user_email = trim($_POST['email']);
	$user_pass = trim($_POST['password']);//SHA1
	$user_phone = trim($_POST['telefono']);
	$user_speciality = htmlspecialchars($_POST['selectoptions']);

	if($user_speciality=='Otros'){
		$user_speciality = htmlspecialchars($_POST['hideotros']);
	}
	$user_tech= htmlspecialchars($_POST['tech']);
	  
	if(!preg_match('/^([a-zA-Z]+)\s([a-zA-Z]+)\s{0,1}([a-zA-Z]*)$/',$user_name)){
		die('Eres un travieso, has cambiado el nombre');
	}
	if(!preg_match('/^([a-zA-Z]{2,})\d{3}@(ikasle\.){0,1}ehu\.(eus|es)$/',$user_email)){
		die('Eres un travieso, has cambiado el correo');
	}
	if(!preg_match('/^(\+[0-9]{2}){0,1}[0-9]{9,25}$/',$user_phone)){
		die('Eres un travieso, has cambiado el telefono');
	}
	if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{8,16}$/',$user_pass)){
		die('Eres un travieso, has cambiado la contraseña');
	}
	  

	
	$image="";
    //Añadir imagen
	if($_FILES['image']['size']>0)
	{
		$image= mysqli_real_escape_string($conn, file_get_contents($_FILES['image']['tmp_name']));
	}
	else
	{
		$image = mysqli_real_escape_string($conn,file_get_contents("avatar.jpg"));
	}
	
	
	$time=date("Y-m-d H:i:s");
	
	$sql="INSERT INTO users(name,email,password,phone,department,tech_tools,avatar,date) VALUES('$user_name','$user_email','$user_pass','$user_phone','$user_speciality','$user_tech','$image','$time')";
	/*$sql_check_mail="SELECT * from users where email='$user_email'";

	$result = mysqli_query($conn,$sql_check_mail);
	if ($result.count()>0) {
		echo 'Error Usuario registrado';
	}
	else{*/

	if(!mysqli_query($conn,$sql)){
		//die('Error' . mysqli_error($conn));
		die('Error Usuario ya Registrado');
	}
	else{ 
		echo "<a href='verUsuarios.php'>Ver Usuarios Registrados</a>";
	}

	//}

	mysqli_close($conn);



?>