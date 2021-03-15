<?php
namespace inc\controllers;
use inc\classes\App;

if( !session_id() ){
    session_cache_limiter('public');
    session_start();
}



class Cedd_db{

    public static function forRoutine( $request=[] ){

        $emails=[
            'admin@gmail.com',
            'hero@gmail.com',
            'green@gmail.com',
            'red@gmail.com',
            'blue@gmail.com',
            'bob@gmail.com',
            'ferrus@gmail.com',
            'robot@gmail.com',
            'tor@gmail.com',
            'booster@gmail.com',
        ];

        $tableUser = config('tableUser');
        $model   = App::db_model( );
        $cUser = $model->fetchAll("SELECT id, email FROM User ");

        //--[ Create dummy data ]---

        $cUser = App::db_create();

        foreach ( $emails as $key => $value) {

            $pasConfirm =  ($key + 1).'2345678';
            $respR = $model->request("INSERT INTO User  (email, `password`) VALUES ( ?, ? ) ", [ $value, $pasConfirm ]);
        }

        print_r( json_encode( $cUser ) );

        $model->close();
        exit();
    }
}