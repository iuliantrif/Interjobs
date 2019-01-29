	 	
<?php
	function print_nice($arr){
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}

	
function getUserById($id){
	global $conn;
	$sql = "SELECT * FROM `user` WHERE `id`='$id'";
	$res = mysqli_query($conn, $sql) or die ("Account not in Database.");
	$row = mysqli_fetch_assoc($res);
	return $row;
}
function changePIC($arr){	

	
	global $conn;
	$getUser = getUserById($_SESSION['id']);
	$target = "images/"; 
    $target = $target . basename( $arr['small_img']['name']); 
	$id1 = $getUser['id'];
    if ($arr["small_img"]["error"] > 0) {
      echo "Error: " . $arr["small_img"]["error"] . "<br>";
    }else if($arr['small_img']['type']=='image/jpeg' || $arr['small_img']['type']=='image/jpg' || $arr['small_img']['type']=='image/gif ' || $arr['small_img']['type']=='image/png'){
      $photo = $arr['small_img']['name'];
      $sql = "UPDATE `user` SET `photo`='$photo' WHERE `id`='$id1'";
      mysqli_query($conn,$sql) ;
    }
    move_uploaded_file($arr['small_img']['tmp_name'], $target);
}
function getProjects($id){
		global $conn; 

		$sql = "SELECT * FROM `projects` WHERE `id_user` = '$id'";

			
		$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
		$projects= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($projects,$row);
		};

		return $projects;
	}

function post_project($arr_data, $arr_files){
	global $conn;
	$target = "screenshots/"; 
    $target = $target . basename( $arr_files['small_img_ss']['name']); 
	$project_name = $arr_data['project_name'];
	$project_adress = $arr_data['project_adress'];
	$project_desc = $arr_data['project_desc'];
	$small_img_ss = $arr_files['small_img_ss'];

	$project_creator = $arr_data['project_creator'];
	$id_user = $_SESSION['id'];
	if ($arr_files['small_img_ss']["error"] > 0) {
      echo "Error: " . $arr_files['small_img_ss']["error"] . "<br>";
    }else if($arr_files['small_img_ss']['type']=='image/jpeg' || $arr_files['small_img_ss']['type']=='image/jpg' || $arr_files['small_img_ss']['type']=='image/gif ' || $arr_files['small_img_ss']['type']=='image/png'){
      $screenshot = $arr_files['small_img_ss']['name'];	
     }

	$sql = "INSERT INTO `projects` VALUES('', '$project_name', '$project_adress','$project_desc', '$id_user', '$project_creator','$screenshot','0','0' )";
	$res = mysqli_query($conn, $sql) or die("Nu am putut posta proiectul.");
	move_uploaded_file($arr_files['small_img_ss']['tmp_name'], $target);

}
/*
function changePIC($arr){

	
	global $conn;
	$target = "images/"; 
    $target = $target . basename( $arr['small_img']['name']); 
	 

    if ($arr["small_img"]["error"] > 0) {
      echo "Error: " . $arr["small_img"]["error"] . "<br>";
    }else if($arr['small_img']['type']=='image/jpeg' || $arr['small_img']['type']=='image/pjpeg' || $arr['small_img']['type']=='image/gif'){
      $photo = $arr['small_img']['name'];
      $sql = "UPDATE `user` SET `photo`='$photo'";
      mysqli_query($conn,$sql) ;
    }	
	if(move_uploaded_file($arr['small_img']['tmp_name'], $target)) { 

	echo "Merge"; 
	} else { 

	echo "Nu merge"; 
	}
}
*/
	function register_person()
	{
		global $conn;

		$username = $_POST['username'];
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$country = ''; 
		$city = '';

		$sql = "INSERT INTO `user` VALUES('', '$username','','', '$email', '$pass','','','', '0','','0','','','','')"; 
		echo $sql;
		$res = mysqli_query($conn, $sql) or die("Nu am introdus in baza de date!");

		header("Location:/index.php?pagina=homepage1");
	}

	function register_company()
	{
		global $conn;

		$username = $_POST['username'];
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$country = $_POST['country']; 
		$city = $_POST['city'];

		$sql = "INSERT INTO `user` VALUES('', '$username', '$email', '$pass','$country','$city','', '1','')"; 
		$res = mysqli_query($conn, $sql) or die("Nu am introdus in baza de date!");

		header("Location:/index.php?pagina=homepage1");
	}

	function getBanForUser($row){
		global $conn;

		$user = $_POST['username_v'];
		$pass = $_POST['password_v'];
		
		$sql = "SELECT `ban` FROM `user` WHERE `username` = '$user' AND `pass` = '$pass'";
		$res = mysqli_query($conn, $sql) or die("Error!");
		$row = mysqli_fetch_assoc($res);
		if (!empty($row)) {
			return $row;
		}
	}

	function login($arr)
	{
		global $conn;
		extract($arr);

		$user = $_POST['username_v'];
		$pass = $_POST['password_v'];

		$sql = "SELECT * FROM `user` WHERE `username`='$user' AND `pass`='$pass' AND `ban` = '0' ";
		$res = mysqli_query($conn, $sql) or die("Nume de utilizator sau parola gresita");
		$row = mysqli_fetch_assoc($res);
		$logat = 1;
		echo $logat;

		if (!empty($row))
		{
			session_start();

			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['country'] = $row['country'];
			$_SESSION['city'] = $row['city'];
			$_SESSION['tip'] = $row['tip'];
			if (!empty($row['video'])) {
				$_SESSION['video'] = $row['video'];
			}
			

			header("Location:index.php?pagina=Profile");
		}

			
	}

	function logout()
	{
		session_destroy();		
		header("Location:index.php?pagina=homepage1");
	}

		

	function posteaza_anunt($arr)
	{
		global $conn;

		extract($arr);

		$companie  = $_SESSION['username'];

		$sql = "INSERT INTO `anunt` VALUES('', '$titlu', '$companie', '$nume_post', '$descriere')";
		$res = mysqli_query($conn, $sql) or die("Nuam putut posta anuntul!");

		header("Location:index.php?pagina=homepage1");

	}

	function anunt()
	{
		global $conn;

		$sql = "SELECT * FROM `anunt`";
		$res = mysqli_query($conn, $sql) or die("Error!");
		$data = array();

		while ($row = mysqli_fetch_assoc($res))
		{
			array_push($data, $row);
		}

		return $data;
	}

	function getAnuntById($id)
	{
		global $conn;

		$sql = "SELECT * FROM `anunt` WHERE `id`='$id'";
		$res = mysqli_query($conn, $sql) or die("Error!");
		$row = mysqli_fetch_assoc($res);

		if (!empty($row))
			return $row;
	}


	function pagina_profil()
	{
		global $conn;

		$id = $_SESSION['id'];
		$text = $_POST['descriere'];

		$sql = "UPDATE `user` SET `descriere`='$text' WHERE `id`='$id'";
		$res = mysqli_query($conn, $sql) or die("Actualizarea nu a reusit!");
	}

	function lista_persoane()
	{
		global $conn;

		$sql = "SELECT * FROM `user` WHERE `tip`='0'";
		$res = mysqli_query($conn, $sql) or die("Error!");
		$data = array();

		while ($row = mysqli_fetch_assoc($res))
		{
			array_push($data, $row);
		}

		return $data;
	}

	function getPersoaneById($id)
	{
		global $conn;

		$sql = "SELECT * FROM `user` WHERE `id`='$id'";
		$res = mysqli_query($conn, $sql) or die("Error!");
		$row = mysqli_fetch_assoc($res);

		if (!empty($row))
			return $row;
	}

	function getCompanies(){
	global $conn; 
	$sql = "SELECT * FROM `user` WHERE `tip` = '2'	";
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$companies = array();
	while($row = mysqli_fetch_assoc($res)){
		array_push($companies,$row);
	};

	return $companies;
}

	function getUsers(){
		global $conn; 
		$sql = "SELECT * FROM `user` WHERE `tip` = '0' or `tip` = '3' or `tip` = '4' AND `ban` = '0'";
		$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
		$users= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($users,$row);
		};

		return $users;
	}
function post_video($video){
	global $conn;
	global $logat;

	
	$id_user = $_SESSION['id'];
	

	$sql = "UPDATE `user` SET `video` = '$video' WHERE `id` =  $id_user;";
	$res = mysqli_query($conn, $sql) or die("Nu am putut posta video-ul.");
	

}

function give_video($id){
	global $conn;
	$sql = "SELECT `video` FROM `user` WHERE  `id`= $id ";
	$res = mysqli_query($conn, $sql) or die("no");
	$row = mysqli_fetch_assoc($res);
	return $row['video'];
}

function getAllUsers(){
	global $conn; 
	$sql = "SELECT * FROM `user`";
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$users = array();
	while($row = mysqli_fetch_assoc($res)){
		array_push($users,$row);
	};

	return $users;

}

function getUsersById($id)
	{
		global $conn;
		global $profile_id;

		$sql = "SELECT * FROM `user` WHERE `id`='$profile_id'";
		$res = mysqli_query($conn, $sql) or die("Error!");
		$row = mysqli_fetch_assoc($res);

		if (!empty($row))
			return $row;
	}





function Rate(){
	global $conn;

	$note = $_POST['point'];
	$id = $_POST['idProiect'];
	$sql = "UPDATE `projects` SET `raters` = `raters` + 1, `rate` = `rate` + '$note' WHERE `id` = '$id'";
	echo $sql;
	$res = mysqli_query($conn, $sql) or die("Nu am putut da o nota proiectului");


}

function addArticle(){
	global $conn;

	$article_title = $_POST['article_title'];
	$article_autor = $_POST['article_autor'];
	$article_date = $_POST['article_date'];
	$article_content = $_POST['article_content'];

	$sql = "INSERT INTO `articles` VALUES ( '','$article_title', '$article_autor','$article_date','$article_content','4' )";
	$res = mysqli_query($conn, $sql) or die("Nu am putut posta articolul.");
}

function getArticles_by_devTeam(){
	global $conn;


	$sql = "SELECT * FROM `Articles` WHERE `tip` = '4' ";
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$articles= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($articles,$row);
		};

	return $articles;
}


function getArticles(){
	global $conn;


	$sql = "SELECT * FROM `Articles` ";
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$articles= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($articles,$row);
		};

	return $articles;
}


function addAEvents($arr){
	global $conn;
	extract($arr);
	$tip = $_SESSION['tip'];
	$sql = "INSERT INTO `events` VALUES ( '','$name','$country','$city','$str','$nr','$date','$descr','$creator','$host','$tip')";
	$res = mysqli_query($conn, $sql) or die("Nu am putut posta articolul.");
}

function getEvents(){
	global $conn;


	$sql = "SELECT * FROM `events` ";
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$events= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($events,$row);
		};

	return $events;
}

function getCountryes(){
	global $conn;

	$sql = "SELECT * FROM  `location` WHERE  `location_type` = '0'";
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$countryes= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($countryes,$row);
		};

	return $countryes;
}
function getCountybyCountryId($country_id){

	global $conn;
	$sql = "SELECT * FROM  `location` WHERE  `location_type` = '1' AND `parent_id` = '$country_id' ";
	echo $sql;
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$citys= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($citys,$row);
		};

	return $citys;
}
function getCitybyCountyId($county_id){

	global $conn;
	$sql = "SELECT * FROM  `location` WHERE  `location_type` = '2' AND `parent_id` = '$county_id' ";
	echo $sql;
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$citys= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($citys,$row);
		};

	return $citys;
}


function searchUsers(){
	global $conn;
	if(!empty($_POST['searchedStuff'])){
		$searchedStuff = $_POST['searchedStuff'];
		$sql = "SELECT * FROM `user` WHERE '$searchedStuff' = `username` or '$searchedStuff' = `firstName` or '$searchedStuff' = `lastName` or '$searchedStuff' = `country` or '$searchedStuff' = 'city' ";
		if (!empty($sql)) {
			$res = mysqli_query($conn, $sql) or die("Nu am putut lua niciun user!");
			$Users= array();
				while($row = mysqli_fetch_assoc($res)){
					array_push($Users,$row);
				};

			return $Users;
		}	
	}
}


function searchProjects(){
	global $conn;
	if(!empty($_POST['searchedStuff'])){
		$searchedStuff = $_POST['searchedStuff'];
		$sql = "SELECT * FROM `projects` WHERE '$searchedStuff' = `proiects_name` or '$searchedStuff' = `project_desc` or '$searchedStuff' = `project_adress` or '$searchedStuff' = `project_creator`";
		if (!empty($sql)) {
			$res = mysqli_query($conn, $sql) or die("Nu am putut lua niciun proiect!");
			$Projects= array();
				while($row = mysqli_fetch_assoc($res)){
					array_push($Projects,$row);
				};

			return $Projects;
		}
	}
}

function get_request()
{
	global $conn;
	$getUser=getUserById($_SESSION['id']);
	$do=$getUser['requestUser'];
	$do=explode(',',$do);
	return $do;
}
function send_request($idr)
{
	global $conn;
	$getUser=getUserById($_SESSION['id']);
	$getUserAc=getUserById($idr);
	$id1=$getUser['id'];
	$do1=$getUser['requestedUser'];
	$do1=explode(',',$do1);
	$result=count($do1);
	$do1[$result]=$idr;
	$do1=implode(',',$do1);
	$sql = "UPDATE `user` SET `requestedUser`='$do1' WHERE 

`id`='$id1'";
	mysqli_query($conn,$sql) ;
	$do2=$getUserAc['requestUser'];
	$do2=explode(',',$do2);
	$result=count($do2);
	$do2[$result]=$id1;
	$do2=implode(',',$do2);
	$sql = "UPDATE `user` SET `requestUser`='$do2' WHERE 

`id`='$idr'";
	mysqli_query($conn,$sql) ;
}
function decline_request($idr)
{
	global $conn;
	$getUser=getUserById($_SESSION['id']);
	$id1=$getUser['id'];
	$do1=$getUser['requestUser'];
	$do1_1=explode(',',$do1);
	$result=count($do1_1);
	for($i=0;$i<$result;$i++)
	{
		if($do1_1[$i]==$idr)
		{
			$poz=$i;
			$i=$result;
		}
	}
	$result=$result-1;
	for($i=$poz;$i<$result;$i++)
	{
		$do1_1[$i]=$do1_1[$i+1];
	}
	$dof=implode(',',$do1_1);
	$sql = "UPDATE `user` SET `requestUser`='$dof' WHERE 

`id`='$id1'";
	mysqli_query($conn,$sql) ;
}
function check_request($idr)
{
	global $conn;
	$getUser=getUserById($_SESSION['id']);
	$id1=$getUser['id'];
	$do=$getUser['acceptedUser'];
	$do1=$getUser['requestedUser'];
	$do=explode(',',$do);
	$lenght=count($do);
	for($i=1;$i<$lenght;$i++)
	{
		if($do[$i]==$idr)
			return 1;
	}
	$do1=explode(',',$do1);
	$lenght=count($do1);
	for($i=1;$i<$lenght;$i++)
	{
		if($do1[$i]==$idr)
			return 2;
	}
	return 0;
}
function show_friends($idr)
{
	global $conn;
	$getUser=getUserById($idr);
	$do=$getUser['acceptedUser'];
	$do=explode(',',$do);
	$lenght=count($do);
//	for($i=1;$i<$lenght;$i++)
//	{
	//	$getUserC=getUserById($do[$i]);
	//	echo $getUserC['username'];
	//	echo '\n';
	//}
	return $do;
}


function accept_request($idr)
{
	global $conn;
	$getUser=getUserById($_SESSION['id']);
	$getUserAc=getUserById($idr);
	$id1=$getUser['id'];
	$do1=$getUser['requestUser'];
	$ao1=$getUser['acceptedUser'];
	$ao1=explode(',',$ao1);
	$result1=count($ao1);
	$ao1[$result1]=$idr;
	$ao1=implode(',',$ao1);
	$sql = "UPDATE `user` SET `acceptedUser`='$ao1' WHERE 

`id`='$id1'";
		mysqli_query($conn,$sql) ;
	$do1_1=explode(',',$do1);
	$result=count($do1_1);
	for($i=0;$i<$result;$i++)
	{
		if($do1_1[$i]==$idr)
		{
			//$poz=$i;
			$do1_1[$i]=0;
			$i=$result;
		}
	}
	//$result=$result-1;
	//for($i=$poz;$i<$result;$i++)
	//{
	//	$do1_1[$i]=$do1_1[$i+1];
	//}
	$dof=implode(',',$do1_1);
	$sql = "UPDATE `user` SET `requestUser`='$dof' WHERE 

`id`='$id1'";
	mysqli_query($conn,$sql) ;
	/* */
	$id2=$getUserAc['id'];
	$do2=$getUserAc['requestUser'];
	$do2_1=explode(',',$do2);
	$result=count($do2_1);
	for($i=0;$i<$result;$i++)
	{
		if($do2_1[$i]==$idr)
		{
			//$poz=$i;
			$do2_2[$i]=0;
			$i=$result;
		}
	}
	//$result=$result-1;
	//for($i=$poz;$i<$result;$i++)
	//{
	//	$do2_1[$i]=$do2_1[$i+1];
	//}
	$dof2=implode(',',$do2_1);
	$sql = "UPDATE `user` SET `requestUser`='$dof2' WHERE 

`id`='$idr'";
	mysqli_query($conn,$sql) ;
	$ao2=$getUserAc['acceptedUser'];
	$ao2=explode(',',$ao2);
	$result1=count($ao2);
	$ao2[$result1]=$id1;
	$ao2=implode(',',$ao2);
	$sql = "UPDATE `user` SET `acceptedUser`='$ao2' WHERE 

`id`='$idr'";
	mysqli_query($conn,$sql) ;

}



function searchEvents(){
	global $conn;
	if(!empty($_POST['searchedStuff'])){
		$searchedStuff = $_POST['searchedStuff'];
		$sql = "SELECT * FROM `events` WHERE '$searchedStuff' = `name` or  '$searchedStuff' = `country` or '$searchedStuff' = `city` or '$searchedStuff' = `host` or '$searchedStuff' = `creator`";

		if (!empty($sql)) {
			$res = mysqli_query($conn, $sql) or die("Nu am putut lua niciun eveniment!");
			$Events= array();
				while($row = mysqli_fetch_assoc($res)){
					array_push($Events,$row);
				};

			return $Events;
		}
	}

}


function addFriend($id){
	global $conn;
	$idSessiune = $_SESSION['id'];
	$id = $_GET['id'];

	$sql = "UPDATE `user` SET `requestUser` = $id WHERE `id` = '$idSessiune'";
	$res = mysqli_query($conn, $sql) or die("Nu am putut trimite request userului.");
}

function sendFriend($id){
	global $conn;
	$idSessiune = $_SESSION['id'];
	$id = $_GET['id'];
	$sql = "UPDATE `user` SET `requestedUser` = $idSessiune WHERE `id` = '$id'";
	$res = mysqli_query($conn, $sql) or die("Nu am putut trimite request userului.");
}

function checkIfFriend($idUser){
	global $conn;

	$idSession = $_SESSION['id'];
	$idUser = $_GET['id'];
	$sql = "SELECT `acceptedUser` FROM `user` WHERE `id` = $idSession";
	$res = mysqli_query($conn, $sql) or die("	");
	$idArray= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($idArray,$row);
		};

	return $idArray;

	foreach ($idArray as $id) {
		if ($idUser == $idUser) {
			$ok = '1';
		}
	}

	return $ok;
}


function  postOnTheProfile()
	{
		global $conn;

		$idCreator = $_SESSION['id'];
		$content = $_POST['postare'];

		$sql = "INSERT INTO `postari` VALUES('','$idCreator','$content' )";
		$res = mysqli_query($conn, $sql) or die("Nuam putut posta anuntul!");

	}

function  getPostsOnProfile()
	{
		global $conn;

		$idCreator = $_SESSION['id'];
			
		$sql = "SELECT * FROM `postari` WHERE `idCreator` = $idCreator";
		$res = mysqli_query($conn, $sql) or die("Nuam putut lua nimic!");
		$Posts= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($Posts,$row);
		}

		return $Posts;

	}

function  getPostsOnPeoplesProfile()
	{
		global $conn;

		$idCreator = $_GET['id'];
			
		$sql = "SELECT * FROM `postari` WHERE `idCreator` = $idCreator";
		$res = mysqli_query($conn, $sql) or die("Nuam putut lua nimic!");
		$Posts= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($Posts,$row);
		}

		return $Posts;

	}

	function  getFriendsId()
	{
		global $conn;
		$id = $_SESSION['id'];
		$sql = "SELECT `acceptedUser` FROM `user` WHERE `id` = '$id'";
		$res = mysqli_query($conn, $sql) or die("Nuam putut lua nimic!");
		$idFriends= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($idFriends,$row);
		}

		return $idFriends;

	}

	function  getPostsFromFriend()
	{
		global $conn;

		$idFriends = getFriendsId();
		foreach ($idFriends as $idPrieten) {
			$idPrietenc = $idPrieten['acceptedUser'];
			$sql = "SELECT * FROM `postari` WHERE `idCreator` = '$idPrietenc' ";
			$res = mysqli_query($conn, $sql) or die("Nuam putut lua nimic!");
			$Posts= array();
			while($row = mysqli_fetch_assoc($res)){
				array_push($Posts,$row);
			}

			return $Posts;
		}
		

	}

	function  getYourPosts()
	{
		global $conn;

		$id = $_SESSION['id'];

			$sql = "SELECT * FROM `postari` WHERE `idCreator` = '$id' ";
			$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
			$Posts= array();
			while($row = mysqli_fetch_assoc($res)){
				array_push($Posts,$row);
			}

			return $Posts;
		

	}

function uploadFile()
	{
		global $conn;
		$target_dir="/files";
		$target_file=$target_dir. basename( $_FILES['small_img']['name']);
		$uploadOk=1;
		$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST['changePicture'])){
		if($_FILES['small_img']['error']>0)
				echo "Error: ".$_FILES['small_img']."<br>";
		else if(true)
		{
			$file = $_FILES['small_img']['name'];
		  $sql = "INSERT INTO `files` VALUES ('', '&target_file', '$file')";
		  mysqli_query($conn,$sql) ;
		}
		
	}
}


	function lista_companii()
	{
		global $conn;

		$id = $_SESSION['id'];

		$sql = "SELECT * FROM `person_chat` WHERE `person`='$id'";
		$res = mysqli_query($conn, $sql) or die("Error!");
		$data = array();

		while ($row = mysqli_fetch_assoc($res))
		{
			array_push($data, $row);
		}

		return $data;
	}

/*
function sendMail(){
	$msg = $_POST['content_1'];	
	$sender = $_POST['sender'];
	$subject = $_POST['subject'];
	$msg = wordwrap($msg,70);
	mail("appop99@gmail.com",$subject,$msg,$sender);
}
*/	
	

/*
function getCitys($country_id){
	global $conn;

	$idParent = "SELECT `id` FROM `location` WHERE $sql = "UPDATE `user` SET `requestedUser` = `requestedUser`.','.'$id'";`name` = '$country_name'";
	echo $idParent;
	$sql = "SELECT * FROM  `location` WHERE  `location_type` = '2' AND `parent_id` = '$idParent' ";
	$res = mysqli_query($conn, $sql) or die("Nu am putut lua nimic!");
	$citys= array();
		while($row = mysqli_fetch_assoc($res)){
			array_push($citys,$row);
		};

	return $citys;
}
*/
?>