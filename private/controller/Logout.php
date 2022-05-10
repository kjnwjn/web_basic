<?php
class Logout extends Controller
{
<<<<<<< HEAD
    
=======
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
    public function __construct()
    {
        if (isset($_COOKIE['JWT_TOKEN'])) {
            unset($_COOKIE['JWT_TOKEN']);
            setcookie('JWT_TOKEN', null, -1, '/');
        }
        header('Location: ' . getenv('BASE_URL'));
        die();
    }
}
