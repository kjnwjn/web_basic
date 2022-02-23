<?php
class Api extends Controller{

    function __construct(){
        header('Content-Type: application/json');
    }
    
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
            if(!isset($_POST['phoneNumber']) || empty($_POST['phoneNumber'])){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Phone number is required'
                ]);
            }else if(!isset($_POST['fullName']) || empty($_POST['fullName'])){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Full name is required'
                ]);
            }else if(!isset($_POST['address']) || empty($_POST['address'])){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Address is required'
                ]);
            } else if(!isset($_POST['date']) || empty($_POST['date'])){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Date is required'
                ]);
            }else if(!isset($_FILES['idCard1']) || $_FILES['idCard1']['size'] === 0){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Id card image is required'
                ]);
            }else if(!isset($_FILES['idCard2']) ||  $_FILES['idCard2']['size'] === 0){
                echo json_encode([
                    'status' => false,
                    'msg' => 'Id card image is required'
                ]);
            }else{
                $phoneNumber = $_POST['phoneNumber'];
                $email = $_POST['email'];
                $fullName = $_POST['fullName'];
                $address = $_POST['address'];
                $validDate = $this->utils()->checkTimeStamp($_POST['date']);
                if ( !$validDate) {
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Date is not allow'
                    ]);
                } else {
                    $date = $_POST['date'];
                    print_r($_FILES['idCard1']); 
                    $validImage = $this->utils()->checkValidImage($_FILES['idCard1']) && $this->utils()->checkValidImage($_FILES['idCard2']);
                    if($validImage) {
                        echo "dung vai lz";
                    }else{
                        echo 'sai';
                    }
                }

            }     
        }
    }
}