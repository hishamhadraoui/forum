<?php
$prx = "f__";
define("prx" , $prx);

class Database
{   
private $host = "localhost";
private $username = "root";
private $password = "root";
private $db_name = "2223";
private $DB_CHARSET = "utf8";
public $conn;
     
	
	
	public function __construct()
	{
		$db = $this->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		global $conn,$db;
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function fetch_pdo($estmt)
	{
		return $estmt->fetch(PDO::FETCH_ASSOC);
		
	}
	
	public function rowCount(){
    return $this->stmt->rowCount();
	}

	
	public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8  			
        }
		catch(PDOException $exception)
		{
            echo "لا يوجد إتصال بالقاعدة والسبب <br>" . $exception->getMessage();
        }
         
        return $this->conn;
    }
	
	public function exec($q){
		
	$this->conn->exec($q);
	
	}

	
	
	
	
	public function ______getvar($var){
    echo $this->$var;
	}
	
}

$dbc = new Database();



?>

