<?php

$host = 'localhost';
$utilizator = 'root';       
$parola = '';
$numebd = 'interJobsFinal';

$conn=@mysqli_connect($host, $utilizator, $parola, $numebd);
if(!$conn)
{
	die("Error to connect".mysqli_connect_error());
}

?>