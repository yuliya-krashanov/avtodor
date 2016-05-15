<?php
    class Road {
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
        public function selectRoadById($id){
            // return $this->db->getDeviceById($id);
        }
        public function selectRoadByRegionId($id){
            return $this->db->getRoadsByRegion($id);
        }
    }