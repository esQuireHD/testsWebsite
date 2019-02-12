<?php
	include_once("includes/connect.class.php");
	include_once("includes/user.class.php");
	include_once("includes/test.class.php");
	//uzsākam sesiju
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tests</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<script src="js/progressbar.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="data">
			<?php
				//ja sesijai ir piešķirts lietotāja vārds, izpildam kodu
				if (isset($_SESSION['name'])) {
					$count = new Test();
					$user = new User();
					$total = $count->getQuestionCount($_SESSION['test']);
					$counter = $_SESSION['counter'];
					//pasakam Paldies lietotājam un parādam cik pareizi no cik atbildēts uz jautājumiem
					echo '<h3>Paldies, ' . $_SESSION['name'] . '!</h3>
						<h4>Tu atbildēji pareizi uz ' . $counter . ' no ' . $total . ' jautājumiem!';
					//gala rezultātus (cilvēka vārdu, testa numuru, jautājumus kādus lietotājs bija izvēlējies,
					//beigu rezultātu) aizsūtam uz funkciju setName()
					$result = $user->setName($_SESSION['name'], $_SESSION['test'], $_SESSION['array'][0], $_SESSION['array'][1], $_SESSION['array'][2], $_SESSION['counter']);
				} else {
					echo '<h3>Pamēģini vēlreiz!</h3>';
				}
			?>
			</div>
		</div>
	</body>
</html>

<?php
	//atslēdzamies no sesijas
	session_destroy();
?>