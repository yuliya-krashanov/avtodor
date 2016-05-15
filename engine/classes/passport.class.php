<?php
class Passport {
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
			$templates = 'meteo_info';
		}

		return $templates;
	}

	public function get_alarm_tickets($val) {
		return $this->db->selectTicketsAlarmDb ($val);
	}

	public function getUpdateTicketStatus () {
		for ($i=0; $i < count($_POST['arr']); $i++) {
			$this->db->updateTicketStatus($_POST['arr'][$i], $_POST['val']);
		}
	}

	public function get_meteo_indicators() {
		return $this->db->select_meteo_indicators($_POST['st_id']);
	}

//		Get Devices by id
	public function getDevices_by_id($id='1') {
		if(!empty($_POST)) {
			$id = $_POST['id'];
		}
		return $this->db->getDevice_by_id($id);
	}

//		Delete device from station
	public function delDeviceFromStation() {
		if(!empty($_POST)){

			$id = $_POST['id'];
			$id_station = $_POST['id_station'];

			return $this->db->delDeviceFromStation($id, $id_station);
		}else{
			return false;
		}
	}
//		Add device in station
	public function addDeviceFromStation() {
		$id = $_POST['id'];
		$id_station = $_POST['id_station'];

		$variable = $this->db->addDeviceFromStation($id_station);

		foreach ($variable as $key => $value) {
			$count = 0;
			$name_column = '';
			if($value['tablo_1'] == 0){ ++$count; $name_column[] = 'tablo_1'; }
			if($value['tablo_2'] == 0){ ++$count; $name_column[] = 'tablo_2'; }
			if($value['meteo'] == 0){ ++$count; $name_column[] = 'meteo'; }
		}

//			Record
		if($count > 0) {
			if(!empty($id)) {
				$this->db->addDeviceFromStation_save($id_station, $name_column[0], $id[0]);
				for ($i=0; $i < count($id); $i++) {
					$id_result[] = $this->db->addDeviceFromStation_save($id_station, $name_column[$i], $id[$i]);

				}
				return $id_result;
			}
		}
		else {
			return false;
		}

	}

	public function getStationRow($id) {
		$station = $this->db->getStations_by_id($id);
//			Station
		foreach ($station as $key => $value) {
			if($value['tablo_1']) {
				$station_array[] = $value['tablo_1'];
			}
			if($value['tablo_2']) {
				$station_array[] = $value['tablo_2'];
			}
			if($value['meteo']) {
				$station_array[] = $value['meteo'];
			}
		}

		return $station_array;
	}
//		Get Station
	public function getDeviceValue() {
		$station = $this->db->getAllStations();
		$devices = $this->db->getAllDevices();

//			Station
		foreach ($station as $key => $value) {
			if($value['tablo_1']) { $station_array[] = $value['tablo_1']; }
			if($value['tablo_2']) { $station_array[] = $value['tablo_2']; }
			if($value['meteo']){ $station_array[] = $value['meteo']; }
		}

//			Diveces
		foreach ($devices as $key => $value) {
			if($value['id']){
				$devices_array[] = $value['id'];
			}
		}

		$station = array_unique($station_array);
//			Result
		foreach ($devices_array as $k => $v) {
			if(!in_array($v, $station)){
				$result[] = $devices_array[$k];
			}
		}
		return $result;
	}

//		Get alarm message
	public function getAlarmMessage_by_id(){
		if(!empty($_POST)){
			$id = $_POST['id'];
		}

		return $this->db->getMessageAlarm($id);
	}
//		Добавляем новое сообщение
	public function add_message() {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$userId = $_POST['userId'];
		$date = date('Y-m-d H:i:s');
		$message = $_POST['message'];
		$imgName = ($_POST['imgName']) ? implode($_POST['imgName'], ',') : '';

		return $this->db->addMessage($id, $name, $date, $message, $imgName, $userId);
	}

//		Загрузить новую картинку в в сообщение
	public function loadImage () {
		if ($_FILES['my_file']['size'] != 0) {
//				Проверка, действительно ли загруженный файл является изображением
			$date = date('YmdHis');
			$imageinfo = getimagesize($_FILES['my_file']['tmp_name']);
			if($imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png' && $imageinfo['mime'] != 'image/bmp') {
				echo 'Загруженное фото1 не в формате jpeg или jpg ';die;
			}
			$mime = explode("/",$imageinfo["mime"]);
//				Функция, перемещает файл из временной, в указанную вами папку и именует изображение. $mime[1] - в данном случае .jpeg
			if (move_uploaded_file($_FILES['my_file']['tmp_name'], ROOT.'/uploads/'.$date.'.'.$mime[1])) {
				$arr = array('path' => $date.'.'.$mime[1]);
				return json_encode($arr);
			}
			else {
				echo 'Произошла ошибка';
			}
		}
	}

// 		Получаем язык страници
	function return_lang(){
		if(isset($_SESSION['lang'])){$lang = $_SESSION['lang'];} else{$lang = "ukr";};
		$url = file_get_contents($_SERVER['DOCUMENT_ROOT']."/engine/lang/".$lang.".json");
		return $url;
	}

//		Задание позиции индикаторов табло
	public function set_position() {
		return $this->db->set_position($_POST['elem'], $_SESSION['auth'], $_POST['to_pos'], $_POST['prev_elem']);
	}

//		Отрисовка графика
	public function drawGraph() {
		$id = $_POST['station_id'];
		$date_begin = $_POST['begin_date'];
		$date_end = $_POST['end_date'];
		$count_days = $_POST['count_days'];
		return $this->db->selectValuesFromDate($date_begin, $date_end, $id, $count_days);
	}

//		Возвращение даты
	public function getDate(){
		return date('m,d,Y');
	}

//		Направление ветра
	public function get_meteo_direction_indicators() {
		return $this->db->select_meteo_direction_indicators($_POST['st_id']);
	}

//		Здесь происходит вывод всего контента на экран
	public function getBody() {
		$all_tickets = $this->get_alarm_tickets(1); // Получение всех активных тикетов
//		$get_message = $this->db->getMessageAlarm(2);
		require_once ROOT . '/engine/templates/passport/'.$this->tmp.'.php';
	}
}
?>