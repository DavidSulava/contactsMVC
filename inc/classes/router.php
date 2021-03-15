<?php
namespace inc\classes;

use inc\controllers\PageController;

use Exception;
// use ReflectionClass;

class Router{

    public static $routes =
        [
            "POST"=>[],
            "GET" =>[]
        ];

    public static function get(  $rout , $controller ){
        if( ! array_key_exists( $rout, static::$routes['GET'] ) )
            static::$routes['GET'][$rout] =  $controller;

    }
    public static function post(  $rout , $controller ){

        if( ! array_key_exists( $rout, static::$routes['POST'] ) )
            static::$routes['POST'][$rout] =  $controller;

    }

    public static function route(  $rout , $type, $request ){

        $rout = explode('?', trim( $rout, '/') )[0];


        if( !array_key_exists( $rout, static::$routes[$type] ) ){

            header("HTTP/1.0 404 Not Found");
            exit();
        }

        $arrData = explode('@', static::$routes[$type][$rout] );

        return static::run( $arrData[0], $arrData[1], $request  );

    }

    protected static function run( $controller, $method, $request, $namespace = 'inc\\controllers\\' ){

        if( !method_exists( $namespace.$controller, $method ) ){

            throw new Exception("Method: $method does not exists !");
            exit();
        }

        return ( $namespace.$controller)::$method($request);
    }

}
