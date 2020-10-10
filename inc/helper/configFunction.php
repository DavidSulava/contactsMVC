<?php


function config( $kay_str='' )
    {
        $conf = require( dirname(dirname(__DIR__)).'/inc/config/config.php' );


        $arSearch = function( $array, $keys ) use (&$arSearch)
            {

                foreach ( $array  as $k => $value )
                    {
                        if ( count($keys) == 1 && in_array($k, $keys) )
                            {
                                return  $value;
                            }
                        else if ( count( $keys ) > 1 && in_array($k, $keys) )
                            {
                                $index = array_search( $k , $keys );
                                unset($keys[$index]);
                                //--go dipper
                                return $arSearch( $value, $keys );

                            }

                    }
                return null;
            };



        $keys = !$kay_str ? null : explode(".", $kay_str);

        if( $keys &&  count($keys) >= 1 )
            return $arSearch( $conf, $keys );



        return $conf;
    }

