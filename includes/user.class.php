<?php

	class User extends Connect {
		public $userName;
		public $test;
		public $question1;
		public $question2;
		public $question3;
		public $result;
		
		//funkcija kas ievada datus (cilvēka vārdu, testa numuru,
		//jautājumus kādus lietotājs bija izvēlējies, beigu rezultātu) datubāzē
		public function setName($userName, $test, $question1, $question2, $question3, $result) {
			$this->userName = $userName;
			$this->test = $test;
			$this->question1 = $question1;
			$this->question2 = $question2;
			$this->question3 = $question3;
			$this->result = $result;
			$sql = "INSERT INTO `users`(`name`, `question_1`, `question_2`, `question_3`, `result`, `test_id`) VALUES ('$this->userName', '$this->question1', '$this->question2', '$this->question3', '$this->result', '$this->test')";
			$result = $this->connect()->query($sql);
		}
	}

?>