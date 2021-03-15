<?php
namespace inc\controllers;
use inc\classes\App;


class PageController
{

    public static function home( $request=[] ){

        if ( !isset( $_SESSION['user']['id'] ) )
            return view('index');

        $serchVar = $_SESSION['user']['id'];
        $page     = $_GET['page'] ? $_GET['page'] : 1;

        $request_str  = "SELECT * FROM User WHERE id != ? ";
        $reqOrder_str = "email DESC";	//dataUpdated DESC,year DESC,rating DESC

        $getSearch = 'search';
        $pageData  = paginate( App::db_connect(), '', $getSearch, $serchVar, $request_str, $page, $reqOrder_str );

        return view('index', ['pageData'=>$pageData]);
    }
    public static function registration( $request=[] ){
        return view('registration',  $request);
    }
    public static function contacts( $request=[] ){

        if ( !isset( $_SESSION['user']['id'] ) )
            return view('index');

        $serchVar = $_SESSION['user']['id'];
        $page     = $_GET['page'] ? $_GET['page'] : 1;


        $request_str  = "SELECT User.id, User.email  FROM User
                        INNER JOIN Contacts ON  Contacts.c_id == User.id
                        where Contacts.id = ?";
        $reqOrder_str = "email DESC";	//dataUpdated DESC,year DESC,rating DESC

        $getSearch = 'search';
        $pageData  = paginate( App::db_connect(), '', $getSearch, $serchVar, $request_str, $page, $reqOrder_str );

        return view('contacts',  ['pageData'=>$pageData] );
    }

}
