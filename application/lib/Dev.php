<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);

//debug function
function debug($str)
{
	echo '<pre>';
	print_r($str);
	echo '</pre>';
	exit();	
} 