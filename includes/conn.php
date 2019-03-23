<?php
 class database {
 	private $host   = 'localhost';
 	private $user   = 'Ijuisnwb_root';
 	private $pass   = 'Bamigboye@1';
 	private $dbname = 'Ijuisnwb_root';

 	private $db;
 	private $error;
 	private $stmt;

 	public function __construct() {
 		// set dsn
 		$dsn = 'mysql:host='. $this->host .';dbname='. $this->dbname;

 		// set options
 		$options = array (
 			PDO::ATTR_PERSISTENT => true,
 			PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
 		);

 		// create new pdo
 		try {
 			$this->db = new PDO($dsn, $this->user, $this->pass, $options);
 		} catch (PDOEception $e) {
 			$this->error = $e->getMessage();
 		}
 	}

 	public function query($query) {
 		$this->stmt = $this->db->prepare($query);
 	}

 	public function bind($param, $value, $type = null) {
 		if (is_null($type)) {
 			switch (true) {
 				case is_int($value):
 					$type = PDO::PARAM_INT;
 					break;
 				case is_bool($value):
 					$type = PDO::PARAM_BOOL;
 					break;
 				case is_null($value):
 					$type = PDO::PARAM_NULL;
 					break;
 				
 				default:
 					$type = PDO::PARAM_STR;
 					break;
 			}
 		}
 		$this->stmt->bindValue($param, $value, $type);
 	}

 	public function execute() {
 		return $this->stmt->execute();
 	}

 	public function lastinsertid() {
 		$this->db->lastinsertid();
 	}

 	public function fetch_all() {
 		$this->execute();
 		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
 	}

 	public function fetch_one() {
 		$this->execute();
 		return $this->stmt->fetch(PDO::FETCH_ASSOC);
 	}

 	public function numrow() {
 		$this->execute();
 		return $this->stmt->rowcount();
 	}
 }


$conn = new database;
 
 /*$conn->query('SELECT * FROM trends');
 $rows = $conn->resultset();*/

 /*where clause*/
/* $conn->query('SELECT * FROM admin WHERE username = :username');
 $conn->bind(':username', 'chris');
 $num_row = $conn->numrow();
 $rows = $conn->fetch_one();


 if ($num_row > 0) {
 	echo $rows['email'];
 }*/

?>

