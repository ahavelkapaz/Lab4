<?php

	session_start();
	$_SESSION['loggedin']=false;
	unset ($SESSION['user']);
	unset ($SESSION['sid']);
	unset ($SESSION['loggedin']);
	unset ($SESSION['rol']);
	unset ($SESSION['start']);
	unset ($SESSION['expire']);

	session_destroy();

	header('Location: layout.html');

	?>