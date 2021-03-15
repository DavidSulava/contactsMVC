<?php
// use inc\classes\App;
use inc\classes\Router;

session_start();

require_once dirname(__DIR__).'/vendor/autoload.php';

// App::db_create(); \\-------- creates Database tables. The actual script locates in the create table controller.

Router::get(""            , 'PageController@home');
Router::get('home'        , 'PageController@home');
Router::get('registration', 'PageController@registration');
Router::get('contacts'    , 'PageController@contacts');


Router::post("signin"      ,  'UserController@signin');
Router::post("logout"      ,  'UserController@logout');
Router::post("registerUser",  'UserController@register');

Router::post("addContact",  'DataCrude@addContact');
Router::post("dataDelete",  'DataCrude@delete');
Router::post("dataDelAll",  'DataCrude@deleteAll');


Router::get("z_db_ceed/forRoutine",  'Cedd_db@forRoutine');










