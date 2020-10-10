<?php
    require_once (__DIR__."./header.view.php");



    if($_SESSION['user']['id'])
        {
            session_start();
            $_SESSION=[];
            session_destroy();
            echo "<meta http-equiv='Refresh' content='0; url=index.php'>";
            exit();
        }

    $_SESSION['sender'] = basename(__FILE__);

    $emailPreserve = !$_SESSION['remail'] ? '' : $_SESSION['remail'];

?>
<link rel="stylesheet" href="/inc/src/css/app.css">



<form  method = "POST" class="regForm text-center" action='registerUser'>

    <div class="Registration">

        <input type="hidden" name='sender'   value=<? echo basename(__FILE__) ?> ><br>

        <label for="regEmail">Эл.Почта</label>
        <input id='regEmail' type="text"   name='email'  class="form-control"  placeholder="E-mail"   value= "<? echo htmlspecialchars($emailPreserve) ?>" >

        <?php
            !$_GET['errMail']?:
                print_r('<label  class="alert alert-danger">'.htmlspecialchars($_GET['errMail']).'</label>');
        ?>
        <br>

        <label for="regPass">Пароль</label>
        <input  id='regPass' type="password" class="password form-control"  placeholder="Пароль" name='password' >
        <?php
            !$_GET['errPass']?:
                print_r('<label  class="alert alert-danger">'.htmlspecialchars($_GET['errPass']).'</label>');
        ?>
        <br>

        <label for="regPassConf">Поддтверждение Пароля</label>
        <input id='regPassConf' type="password"  placeholder="Поддтверждение Пароля" name='pasConfirm' class="pasConfirm form-control">

        <?php
            !$_GET['errPassConf']?:
                print_r('<label  class="alert alert-danger">'.htmlspecialchars($_GET['errPassConf']).'</label> <br/>');
        ?>
        <br>

        <a href="/" class='btn btn-primary' style='color:white'> Вурнуться </a>
        <button type="submit" name="submitReg" class="btn btn-success" >Подтвердить</button>




    </div>

</form>

<?php if ( isset( $_GET['reg_ok']) ):?>
    <script>
            alert("<?=$_GET['reg_ok']?>");
            location.replace("<?=$_SERVER['HTTP_ORIGIN']?>");
    </script>
<?php endif;?>