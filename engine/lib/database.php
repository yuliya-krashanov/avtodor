<?php
	class DataBase {
		public $db; // DataBase
// 			Connect to data base
		public function __construct() {
			$this->db = new PDO(TYPE.':host='.HOST.'; dbname='.DB.';', LOG, PAS);
            $this->db->exec("SET NAMES 'utf8'");
		}
			
		public function query($sql) {
			return $this->db->query($sql);
		}
		
		public function fetch($result) {
			return $result->fetch(PDO::FETCH_ASSOC);
		}
		
		public function fetchAll ($result) {
			return $result->fetchAll(PDO::FETCH_ASSOC);
		}

//            Все пользователи
        public function allUsers () {
            $query = $this->query("SELECT `user`.*, `regions`.`area`
                                    FROM `user`
                                    INNER JOIN `regions`
                                    ON `user`.`region`=`regions`.`id`");
            return $result = $this->fetchAll($query);
        }
//            Проверка на существование логина
        public function checkUsers ($login) {
            $query = $this->query("SELECT `user`.`login` FROM `user` WHERE login = '$login'");
            return $this->fetch($query);
        }
//            Получения совпадения логина и пароля
        public function getUser($login, $password){
            $query = $this->query("SELECT * FROM `user` WHERE login='$login' AND pass='$password'");
            return $result = $this->fetchAll($query);
        }
//            Получени всех незарегистрированных пользователей по регионам
        public function getAllUsers ($region) {
            if (isset($region)) {
                $query = $this->query("SELECT * FROM `user` WHERE region='$region' AND type='none'");
                return $result = $this->fetchAll($query);
            }
            else {
                $query = $this->query("SELECT user.*, regions.area FROM `user` INNER JOIN `regions` ON user.region=regions.id WHERE user.type='none'");
                return $result = $this->fetchAll($query);
            }
        }
//            Получаем пользователя по id
        public function userId($id) {
            $query = $this->query("SELECT user.id, user.name, user.lastname, user.login, user.pass, user.phone, user.type, user.region, regions.area FROM `user` INNER JOIN `regions` ON user.region=regions.id WHERE user.id='$id'");
            return $this->fetch($query);
        }
//            Подтверждение нового пользователя и установка прав доступа
        public function confirmUser($id, $permissions) {
            $query = $this->query("UPDATE user SET type='$permissions' WHERE user.id ='$id'");
            return $query;
        }
//            Создание нового тикета
        public function addNewTicket($title, $id_region, $date, $name) {
        	$query = $this->query("INSERT INTO `tickets` (title, id_region, date, name, history) VALUES
                                  ('$title', '$id_region', '$date', '$name', '0')");
        	return $query;
        }
//            Добавление нового пользователя
        public function addNewUser($name, $lastname, $login, $password, $phone, $type, $region){
            return $query = $this->query("INSERT INTO `user` (name, lastname, login, pass, phone, type, region) VALUES
                                        ('$name','$lastname','$login','$password','$phone','$type','$region')");
        }
//            Тикеты регистрации и изменения табло
        public function getTickets(){
            $query = $this->query("SELECT * FROM `tickets`");
            return $result = $this->fetchAll($query);
        }

        public function getAllStations(){
            $query = $this->query("SELECT * FROM stations");
            return $result = $this->fetchAll($query);
        }
//		        Получение технических тикетов
        public function selectTicketsAlarmDb ($val) {
            if (isset($val)) {
                $query = $this->query("SELECT * FROM `alarm-tickets` WHERE station_id='$val'");
                return $result = $this->fetchAll($query);
            }
            else {
                $query = $this->query("SELECT * FROM `alarm-tickets`");
                return $result = $this->fetchAll($query);
            }

        }

    //       Show Region
        public function showRegion_by_id($id){
            $query = $this->query("SELECT * FROM regions WHERE id='$id'");
            return $this->fetch($query);
        }

    //      update Region
        public function updateRegion($id, $min_temperature, $max_temperature, $min_visibility, $max_visibility, $min_coef_slipperiness, $max_coef_slipperiness, $min_temperature_coating, $max_temperature_coating, $min_wind_speed, $max_wind_speed, $brightness){
            $query = $this->query("UPDATE regions SET min_temperature = '$min_temperature',
                                                          max_temperature =  '$max_temperature',
                                                          min_visibility =  '$min_visibility',
                                                          max_visibility =  '$max_visibility',
                                                          min_coef_slipperiness =  '$min_coef_slipperiness',
                                                          max_coef_slipperiness =  '$max_coef_slipperiness',
                                                          min_temperature_coating =  '$min_temperature_coating',
                                                          max_temperature_coating =  '$max_temperature_coating',
                                                          min_wind_speed =  '$min_wind_speed',
                                                          max_wind_speed =  '$max_wind_speed',
                                                          brightness =  '$brightness' WHERE id ='$id'");
            if(!empty($query)){
                return true;
            }
        }

//          Проверка на сущесвование региона в тикетах и заявках
        public function checkRegion () {
            $query = $this->query("SELECT DISTINCT `stations`.`region`, `regions`.`area`
                                  FROM `stations`, `regions` WHERE `stations`.`region`=`regions`.`id`");
            return $this->fetchAll($query);
        }

//		    Изменение пароля статуса и региона пользователя
        public function updateUser($id, $area, $access, $password) {
            $query = $this->query("UPDATE `user` SET `user`.`pass`='$password',
                                                      `user`.`region`='$area',
                                                      `user`.`type`='$access' WHERE id ='$id'");
            return $query;
        }
//            Закрытие тикета
        public function updateTicketStatus($id, $val=0){
            $query = $this->query("UPDATE `alarm-tickets` SET finish='$val' WHERE id ='$id'");
            return $this->fetch($query);
        }
//            Саша
        public function getAllDevices(){
            $query = $this->query("SELECT * FROM devices");
            return $result = $this->fetchAll($query);
        }
        public function getStations_by_id($id){
            $query = $this->query("SELECT * FROM stations WHERE id ='$id'");
            return $this->fetchAll($query);
        }
        public function getDevice_by_id($id){
            $query = $this->query("SELECT * FROM devices WHERE id ='$id'");
            return $this->fetchAll($query);
        }
        public function delDeviceFromStation($id, $id_station) {
            $query = $this->query("UPDATE stations SET `tablo_1` = replace(`tablo_1`, $id, 0), `tablo_2` = replace(`tablo_2`, $id, 0), `meteo` = replace(`meteo`, $id, 0) WHERE id = '$id_station'");
            if(!empty($query)){
                return $this->getDevice_by_id($id);
            }
        }
        public function addDeviceFromStation($id_station){
            $query = $this->query("SELECT id, tablo_1, tablo_2, meteo FROM `stations`  WHERE id = '$id_station' AND (tablo_1 = 0 or tablo_2 = 0 or meteo = 0)");
            return  $this->fetchAll($query);
        }
        public function addDeviceFromStation_save($id_station, $name_column, $id){
            $query = $this->query("UPDATE stations SET `$name_column` = $id WHERE id = '$id_station'");
            if(!empty($query)){
                return $id;
            }
        }
//            Юля
        public function getPointsFromMap(){
            $query = $this->query("SELECT `id`, `gps`, `meteo_error`, `error` from `stations`");
            return $result = $this->fetchAll($query);
        }

        public function getStationById($id){
            $query = $this->query("SELECT * from stations WHERE id = {$id}");
            return $result = $this->fetchAll($query);
        }

        public function getDeviceById($id){
            $query = $this->query("SELECT * from devices WHERE id = {$id}");
            return $result = $this->fetch($query);
        }

//            Добавить сообщение для тикета
         public function addMessage($id, $name, $date, $message, $images, $id_user) {
             $query = $this->query("INSERT INTO alarm_message_tickets (id_alarm_tickets, name, date, message, images, id_user)
                                    VALUES ('$id', '$name', '$date', '$message', '$images', '$id_user')");
             if($query == true) { return true; } else { return false; }
         }

//            Вывод сообщений для тикетов
         public function getMessageAlarm($id){
             $query = $this->query("SELECT `alarm-tickets`.`id`,
                                           `alarm-tickets`.`note`,
                                           `alarm-tickets`.`date`,
                                           `alarm_message_tickets`.`name`,
                                           `alarm_message_tickets`.`date` AS `messdate`,
                                           `alarm_message_tickets`.`message`,
                                           `alarm_message_tickets`.`images`,
                                           `alarm_message_tickets`.`id_user`
                                    FROM `alarm-tickets`
                                      INNER JOIN `alarm_message_tickets`
                                        ON `alarm-tickets`.`id`=`alarm_message_tickets`.`id_alarm_tickets`
                                    WHERE `alarm_message_tickets`.`id_alarm_tickets`= '$id'");
             $result = $this->fetchAll($query);
             return $result;

         }
//            Достаем с базы все тикеты
        public function selectTicketsAlarmDbAndStation($val) {
            if (isset($val)) {
                $query = $this->query("SELECT `stations`.address, `alarm-tickets`.id, `alarm-tickets`.date, `alarm-tickets`.status, `alarm-tickets`.liable, `alarm-tickets`.note, `alarm-tickets`.region, `alarm-tickets`.finish FROM `alarm-tickets` INNER JOIN `stations` ON `alarm-tickets`.station_id=`stations`.id WHERE  `alarm-tickets`.region='$val'");
                return $result = $this->fetchAll($query);
            }
            else {
                $query = $this->query("SELECT `stations`.address, `alarm-tickets`.id, `alarm-tickets`.date, `alarm-tickets`.status, `alarm-tickets`.liable, `alarm-tickets`.note, `alarm-tickets`.region, `alarm-tickets`.finish FROM `alarm-tickets` INNER JOIN `stations` ON `alarm-tickets`.station_id=`stations`.id");
                return $result = $this->fetchAll($query);
            }
        }

//          Получаем значение по дате с метео истории
        public function selectValuesFromDate($date_begin, $date_end, $id, $count_days){
            if ($count_days == 1) {
                $query = $this->query("SELECT air_temp, road_temp, date, time FROM `temperatures_history` WHERE station_id = '$id' AND date = '$date_begin' ORDER by time");
            }
            else{
                $query = $this->query("SELECT air_temp, road_temp, date FROM `temperatures_history` WHERE station_id = '$id' AND TIME='00:00' AND date BETWEEN '$date_begin' AND '$date_end' ORDER by date");
            }
            return $result = $this->fetchAll($query);

        }
//          Направление ветра
        public function select_meteo_direction_indicators($id) {
            $query = $this->query("SELECT angle_arrow, angle_road, wind_speed FROM `stations` WHERE id = '$id'");
            return $this->fetch($query);
        }
//          Возврат значение в табло
        public function select_meteo_indicators($id, $userLogin) {
            $query = $this->query("SELECT `stations`.air_temp, `stations`.road_temp, `stations`.coating_condition, `stations`.visibility, `stations`.dot_dew, `stations`.coeff_slipperiness, `user`.air_temp_pos, `user`.road_temp_pos, `user`.coating_condition_pos, `user`.visibility_pos, `user`.dot_dew_pos, `user`.coeff_slipperiness_pos FROM `user` INNER JOIN `stations` ON `user`.login='$userLogin' AND `stations`.id ='$id'");
            return $this->fetch($query);
        }
//          Задание позиции элементов в табло
        public function set_position($elem, $userLogin, $pos, $prev) {
            if ($prev == " ") {
                $query = $this->query("UPDATE user SET $elem = $pos WHERE login = '$userLogin'");
            }
            if ($prev == " " && $pos == " ") {
                $query = $this->query("UPDATE user SET $elem = 0 WHERE login = '$userLogin'");
            }
            $query = $this->query("UPDATE user SET $elem = $pos, $prev = 0 WHERE login = '$userLogin'");
            return $pos;
        }

//        Удаляем пользователя
        public function userDelete ($id) {
            $query = $this->query("DELETE FROM `user` WHERE id='$id'");
            return $query;
        }
	}
?>