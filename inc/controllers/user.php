<?php
namespace inc\controllers;

use inc\classes\App;


class UserController
{

    public static function signin($req = [] )
        {

            if (isset($_POST['singin']))
                {

                    $_GET = [];

                    if (empty($_POST['email']))
                        {
                            $_GET['erEmail'] = 'Необходимо ввести e-mail';
                        }

                    if (empty($_POST['pass']))
                        {
                            $_GET['email']  = $_POST['email'];
                            $_GET['erPass'] = "Необходимо ввести пароль";

                        }

                    if (count($_GET) > 0)
                        {
                            return view('index');
                        }


                    if ( ! empty($_POST['email']) &&  ! empty($_POST['pass']))
                        {
                            try
                                {

                                    $email    = $_POST['email'];
                                    $password = $_POST['pass'];

                                    //--Execute conection to BD
                                    $data = App::user($email, $password);

                                    if ( !$data->login() )
                                        {
                                            $_GET['email']        = $_POST['email'];
                                            $_GET['erNotcorrect'] = "Такого пользователя не существует !";
                                        }
                                    else
                                        {
                                            header("Location: home");
                                            exit();
                                        }
                                }
                            catch(PDOException $e)
                                {
                                    echo "Connection failed: " . $e->getMessage();
                                }
                        }

                }

            header("Location: home");
            exit();
        }
    public static function logout($request = [])
        {
            if (isset($_POST['logout']))
                {
                    App::user()->logOut();
                }

            return view('index');
        }
    public static function register($request = [])
        {
            if (isset($_POST['submitReg']))
                {
                    $_GET = [];

                    try
                        {

                            $_SESSION['remail'] = $_POST['email'];


                            if (empty($_POST['email']))
                                {$_GET['errMail'] = 'поле E-mail не может быть пустым'; }

                            if (empty($_POST['password']))
                                {$_GET['errPass'] = 'Введите пароль'; }

                            if (empty($_POST['pasConfirm']))
                                {$_GET['errPassConf'] = 'Введите подтверждение пароля'; }

                            if ($_POST['password'] != $_POST['pasConfirm'])
                                {$_GET['errPassConf'] = "Пароли не совпадают"; }

                            if (count($_GET) > 0)
                                {return view('registration'); }

                            if ( ! empty($_POST['email']) &&  ! empty($_POST['password']) &&  ! empty($_POST['pasConfirm']) && $_POST['password'] == $_POST['pasConfirm'])
                                {

                                    $emS = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                                    $em  = filter_var($emS, FILTER_VALIDATE_EMAIL);

                                    //---Assigning variables----
                                    $email = null;  ! $em?$_GET['errMail'] = "Не правильный формат почты":$email = $em;

                                    if (count($_GET) > 0)
                                        return view('registration');

                                    $pas        = $_POST['password'];
                                    $pasConfirm = $_POST['pasConfirm'];

                                    $con = App::db();


                                    $data = $con->fetch("SELECT email FROM User WHERE email=? ", [ $email ]);

                                    if ($data){
                                        $_GET['errMail'] = "Пользователь : {$data['email']} уже существует! Пожалуйста измените указанный e-mail";
                                        $con->close();

                                        return view('registration');
                                    }

                                    $respR = $con->request("INSERT INTO User  (email, `password`) VALUES ( ?, ? ) ", [ $email, $pasConfirm ]);
                                    $con->close();

                                    if ($respR){

                                        $_GET['reg_ok'] = 'Registration succesfully complited!';
                                        return view('registration');
                                    }

                                    $_GET['regError'] = "registration failed";
                                    return view('registration');

                                }

                        }
                    catch(PDOException $e){
                        echo "Connection failed: " . $e->getMessage();
                    }
                }

            header("Location: home");
            exit();
        }

}