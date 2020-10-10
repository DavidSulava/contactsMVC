<?php
namespace inc\controllers;
use inc\classes\App;

class DataCrude
{

    public static function addContact( $request=[] )
        {

            if ( !isset( $_SESSION['user']['id'] ) || !isset( $_POST['add'] )  )
                return header("Location: home");

            $msgErr     = 'err=такой контакт уже существует' ;
            $msgSuccess = 'msgSuccesss=контакт добавлен' ;

            $getParameters = isset($_SERVER['HTTP_REFERER']) ?  explode('?', $_SERVER['HTTP_REFERER'])[1]: '';
            $getParameters = preg_replace( "/&msgSuccesss.*|&err=.*/i", '', $getParameters );

            $user_id    = $_SESSION['user']['id'];
            $contact_id = $_POST['contact_id'];

            $con      = App::db();
            $contact = $con->fetch("SELECT * FROM Contacts WHERE id=? AND c_id=?", [ $user_id ,  $contact_id ]);

            if( $contact )
                return  header("Location: home?$getParameters&$msgErr");

            $respR = $con->request("INSERT INTO Contacts  (id, c_id) VALUES ( ?, ? ) ", [ $user_id, $contact_id ]);

            return  header("Location: home?$getParameters&$msgSuccess");
        }

    public static function delete( $request=[] )
        {
            if ( !isset( $_SESSION['user']['id'] )  )
                return view('index');

            else if( !isset( $_POST['delContact_id'] ) )
                return header("Location: home");

            $getPar     = isset($_SERVER['HTTP_REFERER']) ?  explode('?', $_SERVER['HTTP_REFERER'])[1]: '';

            $user_id    = $_SESSION['user']['id'];
            $contact_id = $_POST['delContact_id'];

            $con      = App::db();
            $contact  = $con->fetch("SELECT * FROM Contacts WHERE id=? AND c_id=?", [ $user_id ,  $contact_id ]);

            if($contact)
                {
                    $qStore = $con->request("DELETE FROM Contacts WHERE id=? AND c_id=? ", [ $user_id, $contact_id ] );
                }

            return header("Location: contacts?$getPar");
        }
    public static function deleteAll( $request=[] )
        {
            $user_id  = isset( $_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

            if ( !$user_id )
                return view('contacts');

            $getParameters  = isset($_SERVER['HTTP_REFERER']) ?  explode('?', $_SERVER['HTTP_REFERER'])[1]: '';

            $con      = App::db( );
            $contacts = $con->fetchAll("SELECT * FROM Contacts WHERE id=?", [ $user_id ] );

            if( $contacts && count( $contacts ) > 0 )
                {
                    $contacts = $con->fetchAll("DELETE FROM Contacts WHERE id=?", [ $user_id ] );
                }

            return view('contacts');
        }

}
