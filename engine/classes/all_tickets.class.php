<?php
class All_tickets {
	public $db;
	public $tmp;

	public function __construct() {
		session_start ();
		// Проверка авторизации
		$this->db = $this->db();
		$auth = $_SESSION ['auth'];
		if (! isset ( $auth )) { header ( 'Location: ?opt=auth' ); }
		$this->tmp = $this->checkTemplates();
	}
// 		Соединение с базой данных
	public function db() {
		return new DataBase();
	}
//		Проверка существует ли шаблон
	public function checkTemplates () {
		if (isset($_GET['tmp'])) {
			$templates = $_GET['tmp'];
		}
		else {
			$templates = 'all_tickets';
		}

		return $templates;
	}

    public function parseAddress($address){
        $parseArr = json_decode($address, true);
        return $parseArr;
    }
//		Получение технических тикетов
	public function select_alarm_tickets($val) {
		return $this->db->selectTicketsAlarmDbAndStation($val);
	}

// 		Здесь происходит вывод всего контента на экран
	public function getBody() {
		$all_tickets = $this->select_alarm_tickets(null); // Получение всех активных тикетов
		require_once ROOT . '/engine/templates/all_tickets/'.$this->tmp.'.php';
	}
}
?>