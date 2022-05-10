<?php
<<<<<<< HEAD
require_once('./private/core/jwt/vendor/autoload.php');
require_once('./private/middlewares/Api.middleware.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Home extends Controller
{

    function __construct()
    {
        $this->middleware = new ApiMiddleware();
        
    }
    function default()
    {
        $payload = $this->middleware->jwt_get_payload();
        if($payload) {   
            $this->view('Layout', array(
                'title' => 'Home',
                'page' => 'home',
                'respone' => $payload
            ));
            die();
        };
=======

class Home extends Controller
{
    function default()
    {
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
        $this->view('Layout', array(
            'title' => 'Home',
            'page' => 'home'
        ));
    }
}
