<?php
    if( session_status() == PHP_SESSION_NONE )
        {session_start();}

?>
<!DOCTYPE html>
<html>
<head>

	<title>Contacts</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META HTTP-EQUIV="Expires" CONTENT="-1">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<link rel="stylesheet" href="inc/src/css/app.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</head>

<body class="d-flex vh-100">

    <nav id="nav" class= 'container-fluid row ' >

        <!-- Nav Bar -->

        <?php if ( isset($_SESSION['user']['id'] ) ):?>

            <div class="col s2 m1 l1 xl1 nav-link">
                <a  href="/">Главная</a>
            </div>

            <div class="col s2 m1 l1 xl1 nav-link">
                <a  href="/contacts">Контакты</a>
            </div>

            <div class="spacer col s0 m2 l5 xl5"> </div>

            <!-- LOGIN SISTEM -->
            <div class="loginContainer ">

                <form class="logged col s8 m8 l5 xl5" action='logout' method="POST" >

                        <span><?echo$_SESSION['user']["email"]?></span>

                        <button class="logout btn " type="submit" name="logout">Выйти</button>

                </form>
            </div>
        <?php endif;?>

    </nav>
