<?php
	class Tickets {
		public $db;
		public $id;
		
		public function __construct () {
			header('Content-Type: text/html; charset=utf-8');
			$this->db = $this->DB();
			$this->id = $_POST['id'];
		}
		
// 			Connect to DataBase
		public function DB() {
			return new DataBase();
		}
// 			Show all enable tickets
		public function showTick () {
// 				Show active tickets
			$result[0] = $this->db->getAllTickets();
		}
		
// 		Получаем тикеты регистрации и изменения табла
		public function getTickets () {
			return $this->db->getAllTickets();
		}

// 		Получаем технические тикеты
		public function getTechnicalTickets () {
		
		}
		
		public function getBody () {
			$this->showTick();
		}
	}
?>