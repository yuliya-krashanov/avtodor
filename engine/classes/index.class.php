<?php
	class Index {
		public function __construct () {
			session_start();
			$auth = $_SESSION['auth'];
			if (!isset($auth)) {
				header('Location: ?opt=auth');
			}
		}
// 			Здесь происходит вывод всего контента на экран
		public function getBody () {

            require_once ROOT.'/engine/classes/station.class.php';
            require_once ROOT.'/engine/classes/device.class.php';


            $stationClass = new Station();

            $stationsInput = $stationClass->selectAll();

            $stations = array();
            foreach ($stationsInput as $station) {
                if ($station['air_temp'] != '' && $station['road_temp'] != ''){
                    $stationClass->address = $station['address'];
                    $address = $stationClass->parseAddress();
                    $address['id'] = $station['id'];
                    $address['air_temp'] = $station['air_temp'];
                    $address['road_temp'] = $station['road_temp'];
                    $address['error'] = $station['error'];
                    $address['meteo_error'] = $station['meteo_error'];
                    $stations[] = $address;
                }
            }

            // Получение списка столбцов
            foreach ($stations as $key => $row) {
                $road[$key]  = $row['road'];
                $km[$key] = $row['km'];
            }
            array_multisort($road, SORT_ASC, $km, SORT_ASC, $stations);

            $roads = array();
            foreach ( $stations as $station ){
                if ( ! in_array($station['road'], $roads) ){
                    $roads[] = $station['road'];
                }
                else continue;
            }

            require_once ROOT.'/engine/templates/default/main.php';
		}
	}
?>