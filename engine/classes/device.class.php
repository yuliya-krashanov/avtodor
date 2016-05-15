<?php
    class Device {
        public $db;

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
        public function selectDeviceById($id){
            return $this->db->getDeviceById($id);
        }
        public function parseTablo($tablo){
            $parseArr = json_decode($tablo, true);
            return $parseArr;
        }
    }
?>