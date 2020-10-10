<?php

function view( $path, array $data=[])
{
    extract( $data );

    return require dirname(__DIR__)."/views/$path.view.php";

}