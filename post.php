<?php 
	session_start();
	
	include "config.php";
	global $conn;

	$id = $_POST['id'];
	$text = $_POST['text'];
	$username = $_SESSION['username'];
	$sql = "INSERT INTO `user_chat` VALUES('', now() ,'$username','$id','$text')";
	echo $sql;
	$res = mysqli_query($conn, $sql) or die("n-am bagat");


	if ($_SESSION['tip'] == 1)
	{
		$id = $_POST['id'];
		$eu = $_SESSION['username'];

		$sql = "SELECT * FROM `person_chat` WHERE `company`='$eu' AND `person`='$id'";
		$res = mysqli_query($conn, $sql) or die("FATAL ERROR!");
		$row = mysqli_fetch_assoc($res);

		if (empty($row))
		{
			$sql1 = "INSERT INTO `person_chat` VALUES('', '$eu', '$id')";
			$res1 = mysqli_query($conn, $sql1) or die("Nu am resuit sa introduc in baza de date!");
		}
	}
?>