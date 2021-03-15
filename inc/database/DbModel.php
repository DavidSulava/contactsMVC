<?php
namespace inc\database;

use inc\database\migrations\CreateDataBase;

use PDO;
use PDOException;

class DbQuery extends CreateDataBase{

    private static $instance;
    protected $conn;
    protected $username;
    protected $password;

    protected  $server;

    private function __construct( $con ){
        $this->conn = $con;
    }
    public static function getInstance($con){
        if( static::$instance == null )
            static::$instance = new self($con);

        return static::$instance;
    }

    public function request($query='', $vars=[] ) {
        try{
            $qStore =$this->conn->prepare( $query );

            return $qStore->execute( $vars );
        }
        catch (PDOException $e){
            return "There is some problem in connection: " . $e->getMessage();;
        }
    }

    public function fetch($query='', $vars=[] ){
        try{

            $qStore =$this->conn->prepare( $query );
            $qStore->execute( $vars );

            return $qStore->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e){
            return "There is some problem in connection: " . $e->getMessage();;
        }
    }

    public function fetchAll($query='', $vars=[] ){
        try{
            $qStore =$this->conn->prepare( $query );
            $qStore->execute( $vars );

            return $qStore->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e){
            return "There is some problem in connection: " . $e->getMessage();;
        }
    }
    public function close(){
        $this->conn = null;
    }

    public  function createTables(  ){
        try{
            if(!$this->conn)
                return null;


            $qArray = $this->up();

            if( is_array($qArray) && count($qArray) > 0 ){

                $status = [];
                foreach ($qArray  as  $command){

                    $status[]= $this->request( $command );
                }
                return $status;
            }
        }
        catch ( PDOException $e ){
            return 'Table creation failed: '. $e->getMessage();
        }
    }
    public function dropTables(){
        try{
            if( !$this->conn )
                return null;


            $qArray = $this->down();

            if( is_array($qArray) && count($qArray) > 0 ){

                $status = [];
                foreach ($qArray  as  $command){

                    $status[]= $this->request( $command );
                }
                return $status;
            }
        }
        catch ( PDOException $e ){
            return 'Table creation failed: '. $e->getMessage();
        }
    }

    private function __clone(){}
    private function __wakeup(){}
}

