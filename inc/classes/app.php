<?php

namespace inc\classes;


use inc\db_handle\DbQuery;
use inc\classes\User;

// use ReflectionClass;
use PDO;
use PDOException;
use Exception;


class App
    {
        protected static $register = [];


        public static function user( string $email='', string $password='' )
            {
                if( !array_key_exists( 'user', static::$register ) )
                    {
                        if( !array_key_exists( 'db', static::$register ) )
                            {
                                static::db() ;
                            }

                        static::$register['user'] =  new User( static::$register['db'], $email, $password);
                    }

                return static::$register['user'];
            }
        public static function db()
            {
                if( !array_key_exists( 'db', static::$register ) )
                    {
                        try{
                            static::$register['db'] = DbQuery::getInstance( static::db_connect() );
                        }
                        catch(PDOException $e){
                            return $e->getMessage();
                        }
                    }

                return static::$register['db'];
            }
        public static function db_connect()
            {

                if( !array_key_exists( 'connection', static::$register ) )
                    {
                        try{
                            $err_mode = config('connections.options');
                            $bsUser   = config('dbusername');
                            $bspass   = config('dbpassword');

                            static::$register['connection']  = new PDO( config('connections.sqlite.con_str'), $bsUser , $bspass, $err_mode );

                            return static::$register['connection'];
                        }
                        catch(PDOException $e)
                        { echo  $e->getMessage(); }

                    }

                return static::$register['connection'];

            }
        public static function db_create( )
            {
                $con = static::db();

                return $con->createTables();
            }
        public static function add( $key, $val )
            {
                static::$register[$key]=$val;
            }
        public static function get( $key )
            {
                if( !array_key_exists( $key, static::$register ) )
                    {
                        throw new Exception("No {$key} exists in the App container !", 1);
                    }

                return static::register[$key];
            }
    }