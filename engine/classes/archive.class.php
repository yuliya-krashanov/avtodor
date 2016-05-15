<?php
	class Archive
    {
        public function __construct()
        {
            session_start();
            $auth = $_SESSION['auth'];
            if (!isset($auth)) {
                header('Location: ?opt=auth');
            }
        }

        public function getBody()
        {
            require_once ROOT.'/engine/classes/station.class.php';
            require_once ROOT.'/engine/classes/device.class.php';





            require_once ROOT.'/engine/templates/archive/main.php';
        }

    }