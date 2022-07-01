<?php
//database connection settings
return  [
	"host" => "localhost",
	"username" => "root",
	"password" => "mysql",
	"db" => "sibers",
	"options" => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
]; 