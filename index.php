<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "EmailForm.html";
		
spl_autoload_register( 
		function ($class_name) {
	include $class_name .'.php';
	} 
);


$sendEmail = new Email($_POST['email'], $_POST['name'], $_POST['message'], 'asya.manolova@mentormate.com');
$sendEmail->sendEmail();

?>