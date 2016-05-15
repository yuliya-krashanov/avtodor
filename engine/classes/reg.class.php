<?php
    class Reg {
    	private $db;		// DataBase
    	private $login;		// login
    	private $password;	// Passwod
    	private $type;		// User type (grandmather, master, none)
    	private $region;	// Number region (1-25, all);
		private $phone;		// User phone number
    	
// 			Auto
    	public function __construct() {
    		session_start();
//  			Time zone
    		ini_set('date.timezone', 'Europe/Kiev');
//     			Other var
    		$this->db = $this->DB();
    		$this->logout = $_GET['out'];
//     			Registration
    		$this->name = $_POST['name'];
    		$this->lastname = $_POST['lastname'];
    		$this->login = $_POST['login'];
    		$this->password = md5($_POST['password'].'password');
			$this->phone = $_POST['phone'];
    		$this->type = 'none';
    		$this->region = $_POST['region'];
    	}
    	
// 			Connect to DataBase
    	public function DB() {
    		return new DataBase();
    	}
    	
//    		Registration new user
        function checkReg () {
			$allUsers = $this->db->checkUsers($this->login);

			if ($allUsers == false) {
				$result = $this->db->addNewUser($this->name,
												$this->lastname,
												$this->login,
												$this->password,
												$this->phone,
												$this->type,
												$this->region );
            	if ( ! $result) { return false; } else { return true; }
			}
			else {
				return 'check';
			}
//

        }
//         	Main function
        public function getBody () {
        	require_once ROOT.'/engine/templates/register/main.php';
        }
    }
?>