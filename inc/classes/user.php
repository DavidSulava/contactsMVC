<?php
namespace inc\classes;


session_start();


class User{

    protected $_email;
    protected $_password;

    protected $con;       // stores the database handler
    protected $_user;     // stores the user data

    public function __construct(  $con, $email, $password){
        $this->con       = $con;
        $this->_email    = $email;
        $this->_password = $password;
    }

    public function login(){

        $user = $this->_checkCredentials();

        if( !$user )
            return 0;

        $this->_user      = [ 'id'=>$user['id'], 'email'=>$user['email'], 'created_at'=>$user['created_at'] ]; // store it, so it can be accessed later
        $_SESSION['user'] = $this->_user ;

        return $this->_user;
    }

    public function update( $email ){
        $r_user = $this->_checkCredentials();

        if(!$r_user)
            return false;

        $this->_user      = $user;
        $_SESSION['user']['id']    = $r_user['id'] ;
        $_SESSION['user']['email'] = $email ;

        return $this->_user;
    }

    public function delete( $email ){

        $r_user = $this->_checkCredentials();

        if ( $r_user ){
            $stmt = $this->con->request("DELETE FROM User WHERE id=?", [ $r_user['id'] ]);

            $this->_user  = null;
            unset( $_SESSION['user'] );

            return 1;
        }

        return false;
    }

    public function logOut(){

        unset( $_SESSION['user'] );

        return $this->_user;
    }
    protected function _checkCredentials(){

        try{

            $stmt = $this->con->fetch("SELECT * FROM User WHERE email=?", [$this->_email] );

            if ( $stmt['email'] == $this->_email ){

                if ( $this->_password == $stmt['password'])
                    return $stmt;
                else
                    return 0;
            }
            return 0;

        }
        catch (PDOException $e){
            return "There is some problem in user connection: " . $e->getMessage();
        }


    }

    public function getUser(){
        return $this->_user;
    }
}