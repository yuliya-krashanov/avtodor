<?php
class Admin {
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
			$templates = 'main';
		}

		return $templates;
	}
//		Получение технических тикетов
	public function select_alarm_tickets($val) {
		return $this->db->selectTicketsAlarmDb ($val);
	}
//		Получени всех незарегистрированных пользователей по регионам
	public function get_all_users($region) {
		return $this->db->getAllUsers ($region);
	}
//		Вывод даных о незарегистрированном пользователе (ajax)
	public function showUsersId () {
		$id = $_POST['id'];
		return $this->db->userId($id);
	}
//		Подтверждаем нового пользователя (ajax)
	public function confirm_user () {
		$id = $_POST['id'];
		$permissions = $_POST[permissions];
		return $this->db->confirmUser($id, $permissions);
	}
//		Все пользователи
	public function all_users () {
		return $this->db->allUsers();
	}
//		 Показать инфо по региону
	public function showRegion($id = 1){
		if(!empty($_POST)){
			$id = $_POST['id'];
		}
		return $this->db->showRegion_by_id($id);
	}
//		 Обновление значений региона
	public function updateRegions(){
		$id = $_POST['id'];
		$min_temperature = $_POST['min_temperature'];
		$max_temperature = $_POST['max_temperature'];
		$min_visibility = $_POST['min_visibility'];
		$max_visibility = $_POST['max_visibility'];
		$min_coef_slipperiness = $_POST['min_coef_slipperiness'];
		$max_coef_slipperiness = $_POST['max_coef_slipperiness'];
		$min_temperature_coating = $_POST['min_temperature_coating'];
		$max_temperature_coating = $_POST['max_temperature_coating'];
		$min_wind_speed = $_POST['min_wind_speed'];
		$max_wind_speed = $_POST['max_wind_speed'];
		$brightness = $_POST['brightness'];
		return $this->db->updateRegion($id, $min_temperature, $max_temperature, $min_visibility, $max_visibility, $min_coef_slipperiness, $max_coef_slipperiness, $min_temperature_coating, $max_temperature_coating, $min_wind_speed, $max_wind_speed, $brightness);
	}
// 		Получение активных регионов
	public function checkAllRegions () {
		return $this->db->checkRegion();
	}
//		Закрытие тикета (аларм)
	public function getUpdateTicketStatus () {
		for ($i=0; $i < count($_POST['arr']); $i++) {
			$this->db->updateTicketStatus($_POST['arr'][$i]);
		}
	}
//		Изменение пароля статуса и региона пользователя
	public function resultUpdateUser () {
		$id = $_POST['id']; // Id пользователя
		$area = $_POST['area']; // Новая область
		$access = $_POST['assets']; // Уровень доступа
		$password = md5($_POST['password'].'password');
		$result = $this->db->updateUser($id, $area, $access, $password);
		return $result;
	}
//		Удаляем пользователя
	public function user_delete () {
		$id = $_POST['id'];
		$this->db->userDelete($id);
	}
// 		Здесь происходит вывод всего контента на экран
	public function getBody() {
		$activeRegions = $this->db->checkRegion(); // Получение активных регионов
		$all_tickets = $this->select_alarm_tickets(null); // Получение всех активных тикетов
		$users = $this->get_all_users(null); // Получение всех незарегистрированных пользователей
		$allUsers = $this->all_users(); // Получение всех пользователей
		require_once ROOT . '/engine/templates/admin/'.$this->tmp.'.php';
	}
}
?>