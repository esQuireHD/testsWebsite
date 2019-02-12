<?php
	include_once("includes/connect.class.php");
	include_once("includes/user.class.php");
	include_once("includes/test.class.php");
	//atslēdzamies no sesijas
	if (isset($_SESSION)) {
		session_destroy();
	} else {
		//uzsākam sesiju un skaitītājam piešķiram 0 un izveidojam sesijas masīvu
		session_start();
		$_SESSION['counter'] = 0;
	}
	$_SESSION['array'] = array();
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
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
				<h2>Testa uzdevums</h2>
				<input id="yourName" type="text" name="name" placeholder="Vārds" />
				<select id="selectTest" name="test">
					<option class="selectedOption" value="">Izvēlies testu</option>
					<?php
						$test = new Test();
						$datas = $test->getTest();
						//piepildam "option" tag ar testa numuriem no datumāzes
						foreach ($datas as $data) {
							echo '<option class="selectedOption" value="' . $data['test_id'] . '">' . $data['title'] . '</option>';
						}
					?>
				</select>
				<input id="start" type="submit" name="submit" value="Sākt" />
				</form>
				
				<?php
					$user = new User();
					//ja ir nospiesta poga "submit", izpildam kodu
					if (isset($_POST['submit'])) {
						//ja ir ievadīts lietotāja vārds un izvēlēts tests, izpildam kodu
						if (!empty($_POST['name']) && !empty($_POST['test'])) {
							//piešķiram sesijai lietotāja vārdu un testu un pārejam uz jautājumu lapu
							$_SESSION['name'] = $_POST['name'];
							$_SESSION['test'] = $_POST['test'];
							header('Location: tests.php?q=1');
						} else {
							echo 'Aizpildi visus laukus!';
						}
					}
				?>
			</div>
		</div>
	</body>
</html>