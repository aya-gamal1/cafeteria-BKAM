<?php
require 'appconf.php';

class ORM {

    static $conn;
    private $dbconn;
    protected $table;

    static function getInstance(){
        if(self::$conn == null){
            self::$conn = new ORM();
        }
        return self::$conn;
    }
    
    protected function __construct(){    
        extract($GLOBALS['conf']);
        $this->dbconn = new mysqli($host, $username, $password, $database);
    }
    
    function getConnection(){
        return $this->dbconn;
    }
    
    function setTable($table){
        $this->table = $table;
    }

     function insert($data){
        $query = "insert into $this->table set ";
        foreach ($data as $col => $value) {
            $query .= $col."= '".$value."', ";   
        }
        $query[strlen($query)-2]=" ";
        $state = $this->dbconn->query($query);
        if(! $state){
            return $this->dbconn->error;
        }
        
        return $this->dbconn->affected_rows;   
    }

    function delete($data){
        $query = "delete from $this->table where ";
        foreach($data as $col =>$value){
            $query .= $col."= '".$value."'and "; 

        }
         $query[strlen($query)-4]=" ";
         $query[strlen($query)-3]=" ";
         $query[strlen($query)-2]=" ";
         
        $state = $this->dbconn->query($query);
        if(! $state){
            return $this->dbconn->error;
        }
        
        return $this->dbconn->affected_rows;


    }

    function update($data){
        $query="update $this->table set ";
//var_dump($data);
        foreach($data as $col =>$value){
            if($col!="where"){
//echo $col;
                $query .= $col."= '".$value."', ";
//echo $query;
            }
            else{
//echo "here";
                //$query[strlen($query)-4]=" ";
                
                $query[strlen($query)-2]=" ";
                $query.="where ";
//echo $query;



            } 

        }

        
            
        $query[strlen($query)-2]=" ";
//var_dump($query);
        $state = $this->dbconn->query($query);
//	echo $query;
        if(! $state){
            return $this->dbconn->error;
        }
        
        return $this->dbconn->affected_rows;

    }

    function select($data){
        $a=array();

        $query="select * from $this->table ";
        if(count($data)>=1){
            $query.="where ";
         foreach($data as $col =>$value){
            $query .= $col."= '".$value."'and "; 

        }
         $query[strlen($query)-4]=" ";
         $query[strlen($query)-3]=" ";
         $query[strlen($query)-2]=" ";
     }
     

         $state = $this->dbconn->query($query);
        if(! $state){
           
         return $this->dbconn->error;
        }
        else{
            for ($row_no = $state->num_rows - 1; $row_no >= 0; $row_no--) { 
            $state->data_seek($row_no);
             $row = $state->fetch_assoc();
             array_push($a,$row); 
            
         }
        }
        
        return $a;


    }
    
  
 }


