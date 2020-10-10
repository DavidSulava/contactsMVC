<?php

$sql_Location = dirname( dirname(__DIR__)).'/inc/db_handle/sqlite/root_SQLite.sqlite';

$host   = 'localhost';
$bdName = 'myDB';
$dbUser = '';
$dbPass = '';

return  [

    'dbusername'    => $dbUser,
    'dbpassword'    => $dbPass,
    'tableUser'     => 'User',
    'tableContacts' => 'Contacts',
    'connections'   =>
        [
            'sqlite' =>
                [
                    'con_str'  => 'sqlite:'.$sql_Location,
                    'driver'   => 'sqlite',
                    'url'      => '',
                    'database' => $sql_Location,
                ],
            'mysql' =>
                [
                    'driver'   => 'mysql',
                    'host'     => $host,
                    'dbname'   => $bdName,
                    'username' => $dbUser,
                    'password' => $dbPass,
                ],
            'options' => [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true ]
            ],
    'fileStore'=> $_SERVER['DOCUMENT_ROOT'].'/inc/uploads/'

];



