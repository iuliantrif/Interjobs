<?php
	session_start();
	
	include "config.php";
	include "functions.php";

	global $id2;

	if (!empty($_GET['pagina']))
		$pagina = $_GET['pagina'];
	else
		$pagina = '';

	$logat = 0;
	if (!empty($_SESSION['tip'] )) {
		$logat = 1;
	}
	if(!empty($_GET['id']))
		$id = $_GET['id'];
	if (isset($_POST['register_person']))
		register_person();
	if (isset($_POST['register_company']))
		register_company();
	if (isset($_POST['login'])){
		getBanForUser($_POST);
		login($_POST);
		$logat = 1;
	}
	if (isset($_POST['titlu_anunt']))
		afisare_anunt();
    if (isset($_POST['pagina_profil']))
        pagina_profil();
 
    if (isset($_POST['add_offert_button'])){
		posteaza_anunt($_POST);
	}
    if (isset($_POST['video_button'])) {
    	post_video($_POST['video']);
    }

    if (isset($_POST['project_submit'])){
    	if ($_POST['project_name'] != ''){
    		post_project($_POST,$_FILES);
	    }else{
	    	echo "You haven't enter a website.";
	   	}
	    	
    }

    if (isset($_POST['post_article'])) {
    	addArticle($_POST);
    }

    if(isset($_GET['logout'])){ 
     
	    //Simple exit message
	    $fp = fopen("log.html", 'a');
	    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
	    fclose($fp);
	     
	    session_destroy();
	   }
               //out from the session , after session username can use the isset

	if (isset($_SEND['database_00'])) {
		fopen("log.php" $fp);
		
	}

	return isset($fp, $_POST)) {
	echo "Can't open mysql.";

	while ($_POST && $_sen)
}
	// isset clean


	// isset contrast
	// isset session_destroy

	if(isset($_SESSION['username'])){
		if ($pagina == 'chat'){
			if(isset($_POST['submitmsg'])){
				$text = $_POST['usermsg'];
			    if ($text == '') {
			     	echo "You haven't entered a message";
			     }else{
			    	$fp = fopen("log.html", 'a');
			    	fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['username']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
			    	fclose($fp);
				}
			}
		}   
	}

	if(isset($_POST['createEvent'])){
    	addAEvents($_POST);
    }

    if (isset($_POST['searchButton'])){
    	$_SESSION['searched'] = $_POST;
		if(!empty($_SESSION['searched'])){
	    	searchProjects($_POST['searchButton']);
	    	searchEvents($_POST['searchButton']);
	    	searchUsers($_POST['searchButton']);
		}
	}
	if (isset($_POST['friendRequestButton'])) {
		addFriend($id);
		sendFriend($id);
	}

	if (isset($_POST['posteaza'])) {
		postOnTheProfile();
	}

	if (isset($_POST['changePicture'])) {
		uploadFile();
	}
	if(isset($_POST['submit_image'])){
	changePIC($_FILES);
}

if (isset($_POST['rate'])) {
	Rate();
}


if(isset($_POST['friendAccept']))
	{
	accept_request($_SESSION['nefericit']);
	} 
if(isset($_POST['friendDecline']))
	{
	decline_request($_SESSION['nefericit']);
	} 
if(isset($_POST['friendRequestButton']))
	{
		$ce=$_SESSION['ce_trebe'];
		send_request($ce);
	}  


/*
if (isset($_POST['submitMail'])) {
	sendMail();
}
*/

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $pagina;?></title>
		
		<meta charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	   	<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="styles.css">
	    <link rel="stylesheet" href="css/style.css" type="text/css" />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<script type="text/javascript" src="js/script.js"></script>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	    <script src="script.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	   
	   
	</head>
	<body style="text-align:center">
		
				<div id="header1">
					<div class = "container">
						<?php 
							if (!empty($pagina) && $pagina != "homepage") {
								include "header.php"; 
							}
						?>
					</div>
				</div>

			<div id="content" class = "container">
				<?php
				include "mail.php";
					if (empty($pagina)){
						include "html/homepage.html";
					}else if($pagina!="homepage" && $pagina!="register" && $pagina!="register_person" && $pagina!="register_company" && $pagina!="logout" && $pagina!="postare_anunt" && $pagina!="anunturi" && $pagina!="afisare_anunt" && $pagina!="homepage1" && $pagina != "contact" && $pagina != "companies" && $pagina != "Login"  && $pagina != "Profile" && $pagina != "other_user" && $pagina!="chat" && $pagina != "user_profile" && $pagina != "search_user" && $pagina != "search_comp" && $pagina != "search" && $pagina != "info" && $pagina != 'Blog' && $pagina != 'What_do_we_offer' && $pagina != 'events' && $pagina != '?changePicture' && $pagina != "devBlog" && $pagina != "friend_requests"){
						include "html/error.html";
					}else{
						include "html/".$pagina.".html";
					}
				?>
			</div>
			
			<div id="footer1">
				<?php
					if (!empty($pagina) && $pagina != "homepage") {
							include "footer.php"; 
						}

				?>
			</div>
		</div>

	</body>
</html>