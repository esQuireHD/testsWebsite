<?php

	class Test extends Connect {
		public $test;
		public $question;
		
		//funkcija, kas atgriež visus testa numurus
		public function getTest() {
			$sql = "SELECT * FROM `tests`";
			$result = $this->connect()->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
			return $data;
			}
		}
		
		//funkcija, kas atgriež jautājumus un atbildes + kuram testam pieder
		public function getTestQuestions($test, $question) {
			$sql = "SELECT * FROM `questions` WHERE `test_id` = '$test' AND `question_id` = '$question'";
			$result = $this->connect()->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$array[] = $row;
				}
			return $array;
			}
		}
		
		//funkcija, kas atgriež jautājumu skaitu testā
		public function getQuestionCount($test) {
			$sql = "SELECT COUNT(*) AS total FROM `questions` WHERE `test_id` = '$test'";
			$result = $this->connect()->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$total = $row['total'];
				}
			return $total;
			}
		}
		
	}

?>