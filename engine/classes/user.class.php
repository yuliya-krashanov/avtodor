<?php

class User
{
    public $db;

    public function DB()
    {
        return new DataBase();
    }

    // 			Auto
    public function __construct()
    {
        session_start();
        $this->db = $this->DB();
    }

    public function changeLastRegion()
    {
        $region = $_POST['region'];
        if ($id = $_SESSION['user_id']){
            $region = $this->db->setUserLastRegion($region, $id);
            if ($region){
                $_SESSION['region'] = $region;
                return true;
            }
            else return false;
        }
        else return false;
    }

}