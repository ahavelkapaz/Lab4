<?php

	require_once 'db_config.php';
	
	$option=trim($_REQUEST['op']);
	
	if($option=="borrar"){ //Borrar Pregunta

	 $id_borrar=trim($_REQUEST['id']);
	 
	 $sql2="DELETE FROM quiz_questions WHERE id_quiz='$id_borrar'";
	 if(!mysqli_query($conn,$sql2)){
		die('Error' . mysqli_error($conn));
	}
	else{ 
		echo '<h5> Has borrado la pregunta ' . $id_borrar . ' con exito</h5>';
	}
	}
	else if($option=="complejidad"){//Modificar complejidad
	
	$id_q=trim($_REQUEST['id']);
	$rate=trim($_REQUEST['rate']);
	 
	 $sql2="UPDATE quiz_questions SET rate='$rate' WHERE id_quiz='$id_q'";
	 if(!mysqli_query($conn,$sql2)){
		die('Error' . mysqli_error($conn));
	}
	else{ 
		echo '<h5> Has actualizado la complejidad de ' . $id_q . ' a ' . $rate . '</h5>';
	}
		
	}
	 
	mysqli_close($conn);




?>