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
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
				<h2>Jautājums <?php echo $_GET['q']; ?></h2>
				<?php
					//ja sesijai ir piešķirts lietotāja vārds, izpildam kodu
					if (!empty($_SESSION['name'])) {
						$question = new Test();
						$count = new Test();
						$datas = $question->getTestQuestions($_SESSION['test'], $_GET['q']);
						$total = $count->getQuestionCount($_SESSION['test']);
						//ja esošais jautājums ir mazāks par kopējo, izpildam kodu
						if ($_GET['q'] <= $total) {
							//piepildam "input type=radio" ar jautājuma datiem no datubāzes
							foreach ($datas as $data) {
								echo '<h3>' . $data['question'] . '</h3>';
								echo '<div class="question">
									<input type="radio" name="' . $_GET['q'] . '" value="' . $data['answer_1'] . '">
									<span>' . $data['answer_1'] . '</span>
								</div>';
								echo '<div class="question">
									<input type="radio" name="' . $_GET['q'] . '" value="' . $data['answer_2'] . '">
									<span>' . $data['answer_2'] . '</span>
								</div>';
								echo '<div class="question">
									<input type="radio" name="' . $_GET['q'] . '" value="' . $data['answer_3'] . '">
									<span>' . $data['answer_3'] . '</span>
								</div>';
								echo '<div class="question">
									<input type="radio" name="' . $_GET['q'] . '" value="' . $data['answer_4'] . '">
									<span>' . $data['answer_4'] . '</span>
								</div>';
							}
							
				?>
							<div id="progressBar">
								<div id="fillBar"></div>
							</div>
				<?php
							//palielinam par vienu vienību jautājumu pēc kārtas
							$sum = $_GET['q'] + 1;
							echo '<input id="next" type="submit" name="submit" value="Nākamais" />';
							//ievietojam atbilžu rezultātu masīvā un ja lietotājs ir atbildējis pareizi,
							//palielinam skaitītāju par vienu
							if (isset($_POST['submit'])) {
								if (!empty($_POST[$_GET['q']])) {
									array_push($_SESSION['array'], $_POST[$_GET['q']]);
									if ($_POST[$_GET['q']] == $data['correct_answer']) {
										$_SESSION['counter']++;
									}
									//ja esošais jautājums nav pēdējais, pārejam pie nākamā jautājuma
									if ($_GET['q'] < $total) {
										header("Location: " . $_SERVER['PHP_SELF'] . "?q=" . $sum);
									} else {
										//ja esošais jautājums ir pēdējais, pārejam uz rezultātu lapu
										header("Location: result.php");
									}
								}
							}
						}
					}
				?>
				</form>
			</div>
		</div>
		<script>
			progressBar(<?php echo $_GET['q']; ?>, <?php echo $total ?>);
		</script>
	</body>
</html>