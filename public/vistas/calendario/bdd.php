<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=db_app_hotel;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
