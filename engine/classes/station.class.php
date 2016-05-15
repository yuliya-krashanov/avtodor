<?php
    class Station {
        public $db;
        public $gps;
        public $air_temp;
        public $road_temp;
        public $region;
        public $error;
        public $meteo_error;
        public $address;


        public function DB() {
            return new DataBase();
        }
    // 			Auto
        public function __construct() {
            $this->db = $this->DB();
        }

        public function add(){

        }
        public function delete($id){

        }
        public function find($id){

        }

        public function selectAll(){
            return $this->db->getAllStations();
        }

        public function selectAllPointsForMap(){
            return $this->db->getPointsFromMap();

        }
        public function checkError(){

        }
        public function checkMeteoError(){

        }

        public function parseAddress(){
            $parseArr = json_decode($this->address, true);
            return $parseArr;
        }

        public function selectStationById($id){
            return $this->db->getStationById($id);
        }

        public function selectStationDevicesById(){

            require_once ROOT.'/engine/classes/device.class.php';

            $station = $this->selectStationById($_POST['id']);

            $device = new Device();

            $tablo_1 = ( $station[0]['tablo_1'] ) ? $device->selectDeviceById($station[0]['tablo_1']) : false;
            $tablo_2 = ( $station[0]['tablo_2'] ) ? $device->selectDeviceById($station[0]['tablo_2']) : false;

            $this->address = $station[0]['address'];
            $parseAddress = $this->parseAddress();

            $stationArr = array();
            $stationArr['station'] = $station;
            $stationArr['parse_address'] = $parseAddress;
            $stationArr['tablo1'] = $tablo_1;
            $stationArr['parse_tablo1'] = $device->parseTablo($tablo_1['tablo']);
            $stationArr['tablo2'] = $tablo_2;
            $stationArr['parse_tablo2'] = $device->parseTablo($tablo_2['tablo']);

            return $stationArr;
        }
    }