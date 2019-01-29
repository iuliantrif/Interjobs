<?php
	include "config.php";
	include "functions.php";

	if (!empty($_GET['pagina']))
		$pagina = $_GET['pagina'];
	else
		$pagina = '';

	if(!empty($_GET['id']))
		$id = $_GET['id'];
	if (isset($_POST['register_person']))
		register_person();
	if (isset($_POST['register_company']))
		register_company();
	if (isset($_POST['login']))
		login();
	if (isset($_POST['posteaza'])){
		posteaza_anunt($_POST);
		//print_r($_POST);
		//$descriere = $_POST['descriere'];
		//$descriere = str_replace("%0D%0A", "<br />", $descriere);
		//echo $descriere;
	}
	if (isset($_POST['titlu_anunt']))
		afisare_anunt();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<title>Homepage</title>
	</head>
		</script>
		<body>
			<div id="container">
				<div id="header">
					<?php include "header.php"; ?>
				</div>
				<div id="content">
					<?php 
						if ($pagina == "") {
								include "html/homepage.html";
							}
							else if ($pagina != 'homepage' && $pagina != 'contact' && $pagina != 'about' && $pagina != 'companies') {
								include "html/error.html";

							}
							else
							{
								include "html/".$pagina.".html";
						}
					?>
				</div>
				<div id="footer">
					<?php include "footer.php"; ?>
				</div>
			</div>
		</body>
</html>
