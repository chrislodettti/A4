<?php
  namespace App\Sys;
  require 'Helper.php';
    use PDO;
    use App\Sys\Helper;
    use App\Sys\DB;
    //connection gdb
   $gdb=DB::getInstance(); 
    //connection gdb
    
   class DB extends PDO{
       private $stmt;
        private static $instance;
        
          public static function  getInstance(){
        if(!self::$instance instanceof self) {
            self::$instance=new self();
        }
        return self::$instance;
    } 
       public function __construct() {
       //recuperar configuracion de config.json
    $dbconf=Helper::getConfig();
     $dsn = $dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
     $usr = $dbconf['dbuser'];
    $pass = $dbconf['dbpass'];
     
     parent::__construct($dsn, $usr, $pass);
   }
    public function query(string $query){
        
        $this->stmt = parent::prepare($query);
    }
    
    public function bind($param, $value, $type = null){
        
        $this->stmt->bindValue($param,$value, $type);
    }
    
    public function execute(): bool {
        return $this->stmt->execute();
    }
    
    public function resultSet(){
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      //PDO::FETCH_ASSOC: devuelve un array indexado por los nombres de las columnas del conjunto de resultados.
    }
    
    public function single() {
     //PDO::FETCH_ASSOC: devuelve un array indexado por los nombres de las columnas del conjunto de resultados. 
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function rowCount(){
        return $this->stmt->rowCount();
    }
    
    public function lastInsertId($seqname = null) {
        return parent::lastInsertId($seqname);
    }
    
    public function beginTransaction() {
        return parent::beginTransaction();
    }
    
    public function endTransaction() {
        return parent::commit();
    }
    
    public function cancelTransaction(){
        return parent::rollBack();
    }
    
    public function debugDumpParams(){
        $this->stmt->debugDumpParams();
    }		
			
  
   
   
   
       }
               