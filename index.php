<?php

require "EmailForm.html";
		
spl_autoload_register( 
		function ($class_name) {
	include $class_name .'.php';
	} 
);

$sendEmail = new Email($_POST('email'), $_POST('name'), $_POST('message'));
$sendEmail->validateData();
$sendEmail->sendEmail();

?>