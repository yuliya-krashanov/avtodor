<?php
	class Auth {
		public $db; 		// DataBase
		public $logout;		// Exit
		private $login;		// Login
		private $password;	// Password

// 			Connect to DataBase
		public function db () {
			return new DataBase();
		}

		public function __construct() {
			session_start();
			$this->db = $this->db();
//			$auth = $_SESSION ['auth'];
//			if (! isset ( $auth )) { header ( 'Location: ?opt=auth' ); }
			$this->logout = $_GET['out'];
		}

// 			Check write login and password
     	public function checkAuth () {
			$login = $_POST['login'];
			$password = md5($_POST['password'].'password');
// 				Check autorization
			if (empty($_SESSION['auth'])) {
// 					Query database if the user is not logget in
				$result = $this->db->getUser($login, $password);
// 						Сheck admin
					if ($result[0][type] != 'none') {
						if (!empty($result)) {
							$_SESSION['auth'] = $login;
							$_SESSION['name'] = $result[0]['name'];
							$_SESSION['lastname'] = $result[0]['lastname'];
							$_SESSION['user_id'] = $result[0]['id'];
							$_SESSION['region'] = $result[0]['last_region'];
							$return = true;
						}
					}
					else {
						$return = false;
					}
			}
			else {
				$return = true;
			}

			return $return;
		}

//			Получение активных регионов
		public function checkAllRegions () {
			return $this->db->checkRegion();
		}
		
// 			The function to log out
		public function logout () {
			session_destroy();
		}
//			Language
		public function setLanguage () {
			$_SESSION['lang'] = $_POST["lang"];
		}

// 			Main started function
		public function getBody () {
			if ($this->logout == 'exit') {
				$this->logout();
			}

			$lnp = $this->checkAuth();
			$activeRegion = $this->checkAllRegions(); // Активные регионы
			require_once ROOT.'/engine/templates/login/main.php';
		}
	}
?>