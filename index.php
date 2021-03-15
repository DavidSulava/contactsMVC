<?php
use inc\classes\Router;


require_once('./inc/web.php');

require_once './vendor/autoload.php';


$req = filter_var( strip_tags(  $_SERVER['REQUEST_URI'] ), FILTER_SANITIZE_URL, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) ;

Router::route( $req, $_SERVER['REQUEST_METHOD'], $_REQUEST );



