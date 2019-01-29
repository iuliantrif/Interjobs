<?php
	session_start();

	include "config.php";
	global $conn;
	global $idUser;
	$id1 = $_SESSION['id'];
	
function getUserById($id){
	global $conn;
	$sql = "SELECT * FROM `user` WHERE `id`='$id'";
	$res = mysqli_query($conn, $sql) or die ("Account not in Database.");
	$row = mysqli_fetch_assoc($res);
	return $row;
}

	$username1 = $_SESSION['username'];

	$sql = "SELECT * FROM `user_chat` WHERE `username_eu`='$username1' AND `username_partener`='$idUser' OR `username_eu`='$idUser' AND `username_partener`='$id1'";
	echo $sql;
	$res = mysqli_query($conn, $sql) or die("n-am gasit");

	$data = array();
	while($row = mysqli_fetch_assoc($res)){
		array_push($data,$row);
	}

	foreach($data as $dat){?>
		<div class='msgln'>
			<?php
				echo "(".$dat['date'].") <b>".$dat['username_eu']."</b>: ".$dat['text']."<br />";
				/*if ($_SESSION['tip'] == '1')
					$dat['username_eu'];*/
			?>
		</div>
<?php } ?>