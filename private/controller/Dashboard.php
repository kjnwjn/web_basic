<?php
require_once('./private/core/jwt/vendor/autoload.php');
require_once('./private/middlewares/Api.middleware.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Dashboard extends Controller
{
    protected $middleware;

<<<<<<< HEAD
    function __construct()
    {
        $this->middleware = new ApiMiddleware();
        $payload = $this->middleware->jwt_get_payload();
        !$payload ? header('Location: http://localhost/login') : null;
        if($payload && $payload->phoneNumber != 'admin') {   
            $this->view('Layout', array(
            'title' => '404 Not Found',
            'page' => '404'
            ));
            die();
        };
=======
    function __construct(){
        // $this->middleware = new ApiMiddleware();
        // $payload = $this->middleware->jwt_get_payload();
        // !($payload && $payload->phoneNumber == 'admin') ? 
        // $this->middleware->json_send_response(404, array(
        //     'status' => false,
        //     "header_status_code" => 404,
        //     'msg' => 'This endpoint cannot be found, please contact adminstrator for more information!'
        // )) : null;
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
    }

    function default()
    {
<<<<<<< HEAD
        $this->view('LayoutAdmin', array(
=======
        $this->view('Layout1', array(
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
            'title' => 'Dashboard',
            'page' => 'Dashboard'
        ));
    }
<<<<<<< HEAD
    function listAccount()
    {
        $this->view('LayoutAdmin', array(
=======
    function listAccount(){
        $this->view('Layout1', array(
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
            'title' => 'List Accounts',
            'page' => 'listAccount'
        ));
    }
<<<<<<< HEAD
    function listTransactions()
    {
        $this->view('LayoutAdmin', array(
=======
    function listTransactions(){
        $this->view('Layout1', array(
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
            'title' => 'List Transactions',
            'page' => 'listTransaction'
        ));
    }
<<<<<<< HEAD
    function listAllTransaction()
    {
        $this->view('LayoutAdmin', array(
            'title' => 'List All Transactions',
            'page' => 'listAllTransaction'
        ));
    }
=======
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22
}
