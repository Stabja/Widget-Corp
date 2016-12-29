<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', 'poiqwe123');
    define('DB', 'widget_corp');
	$connection = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect');
	
?>
