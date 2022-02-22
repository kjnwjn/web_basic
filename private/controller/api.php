<?php
class Api extends Controller{
    
    function default(){
        // khởi tạo đối tượng tèo sử dụng được những hàm từ đối tượng sinhvienmodel
      
        // khời tạo đối tượng sử dụng view của home load ra data là danh sách student 
        echo json_encode('quan dep trai');
    }

    function login(){
        if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
            echo json_encode([
                'status' => false,
                'msg' => 'Method not allowed'
            ]);
            exit();
        }else{
            if(isset($_POST['btnLoginSubmit'])){
                if(!isset($_POST['email']) || empty($_POST['email'])){
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Email is Required!'
                    ]);
                }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Invalid Format!'
                    ]);
                }else if(!isset($_POST['password']) || empty($_POST['password'])){
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Password is required'
                    ]);
                }else{
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    if($this->model('Account')->is_email_exit($email)){
                        if($this->model('Account')->login($email,$password)){
                            echo json_encode([
                                'status' => true,
                                'msg' => 'Login successfully!'
                            ]);

                        }else{
                            echo json_encode([
                                'status' => false,
                                'msg' => 'Invalid Password!'
                            ]);
                        }
                    }else{
                        echo json_encode([
                            'status' => false,
                            'msg' => 'Account is not exits!'
                        ]);
                    }
                }    
            }
           
        }
    }
    function login1(){
        if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
            echo json_encode([
                'status' => false,
                'msg' => 'Method not allowed'
            ]);
            exit();
        }else{
            if(!isset($_POST['username']) || empty($_POST['username'])){
                echo json_encode([
                    'status' => false,
                    'msg' => 'username is Required!'
                ]);
            }else if(!isset($_POST['password']) || empty($_POST['password'])){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Password is required'
                ]);
            }else if(strlen($_POST['password'])!=6){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Password must be 6 characters'
                ]);
            }else{
                $password = $_POST['password'];
                $username = $_POST['username'];
                if($this->model('Account')->is_phone_number_exit($username)){
                    if($this->model('Account')->login($username,$password)){
                        echo json_encode([
                            'status' => true,
                            'msg' => 'Login successfully!'
                        ]);

                    }else{
                        echo json_encode([
                            'status' => false,
                            'msg' => 'Invalid Password!'
                        ]);
                    }
                }else{
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Account is not exits!'
                    ]);
                }
            }    
            
           
        }
    }

    function register(){
        if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
            echo json_encode([
                'status' => false,
                'msg' => 'Method not allowed'
            ]);
            exit();
        }else{
            if(!isset($_POST['phone_number']) || empty($_POST['phone_number'])){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Phone number is required'
                ])
            }elseif(!isset($_POST['full_name']) || empty($_POST['full_name'])){

            }
        }
    }
}