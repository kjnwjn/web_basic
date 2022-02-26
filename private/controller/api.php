<?php
class Api extends Controller
{

    function __construct()
    {
        header('Content-Type: application/json');
    }

    function default()
    {
        // khởi tạo đối tượng tèo sử dụng được những hàm từ đối tượng sinhvienmodel

        // khời tạo đối tượng sử dụng view của home load ra data là danh sách student 
        echo json_encode('quan dep trai');
    }


    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'status' => false,
                'msg' => 'Method not allowed!'
            ]);
            exit();
        } else {
            if (!isset($_POST['username']) || empty(trim($_POST['username']))) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Username is required!'
                ]);
            } else if (!isset($_POST['password']) || empty(trim($_POST['password']))) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Password is required!'
                ]);
            } else if (strlen($_POST['password']) != 6) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Password must be 6 characters!'
                ]);
            } else {
                $password = trim($_POST['password']);
                $username = trim($_POST['username']);
                if ($this->model('Account')->is_phone_number_exit($username)) {
                    if ($this->model('Account')->login($username, $password)) {
                        echo json_encode([
                            'status' => true,
                            'msg' => 'Login successfully!'
                        ]);
                    } else {
                        echo json_encode([
                            'status' => false,
                            'msg' => 'Invalid Password!'
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Account is not exits!'
                    ]);
                }
            }
        }
    }

    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'status' => false,
                'msg' => 'Method not allowed!'
            ]);
            exit();
        } else {
            if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Email is required!'
                ]);
            } else if (!$this->utils()->checkEmail($_POST['email'])) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Invalid email format!'
                ]);
            } else  if ($this->model('Account')->is_email_exit($_POST['email'])) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Email was used by another account!'
                ]);
            } else if (!isset($_POST['phoneNumber']) || empty(trim($_POST['phoneNumber']))) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Phone number is required!'
                ]);
            } else if (!$this->utils()->checkPhoneNumber($_POST['phoneNumber'])) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Invalid phone format!'
                ]);
            } else if ($this->model('Account')->is_phone_number_exit($_POST['phoneNumber'])) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Phone number was used by another account!'
                ]);
            } else if (!isset($_POST['fullName']) || empty(trim($_POST['fullName']))) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Full name is required!'
                ]);
            } else if (!$this->utils()->checkName($_POST['fullName'])) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Only letters and white space allowed!'
                ]);
            } else if (!isset($_POST['address']) || empty(trim($_POST['address']))) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Address is required!'
                ]);
            } else if (!isset($_POST['date']) || empty(trim($_POST['date']))) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Date is required!'
                ]);
            } else if (!$this->utils()->checkTimeStamp($_POST['date'])) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Date is not allow!'
                ]);
            } else if (!isset($_FILES['idCard1']) || $_FILES['idCard1']['size'] === 0) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Id card image is required!'
                ]);
            } else if (!isset($_FILES['idCard2']) ||  $_FILES['idCard2']['size'] === 0) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Id card image is required!'
                ]);
            } else {
                $address = $_POST['address'];
                $fullName = $_POST['fullName'];
                $date = date('d/m/y', $_POST['date']);
                // echo date('m/d/Y',$_POST['date']);
                $phoneNumber = $_POST['phoneNumber'];
                $email = $_POST['email'];
                $passwordDefault = $this->utils()->generateRandomString();
                $password = password_hash($passwordDefault, PASSWORD_DEFAULT);
                $imageValidate1 = $this->utils()->uploadImage($_FILES['idCard1']);
                $imageValidate2 = $this->utils()->uploadImage($_FILES['idCard2']);
                if (!$imageValidate1['status']) {
                    echo json_encode($imageValidate1);
                } else if (!$imageValidate2['status']) {
                    echo json_encode($imageValidate2);
                } else {
                    $idCard1 = $imageValidate1['path'];
                    $idCard2 = $imageValidate2['path'];
                    $result = $this->model('Account')->add_Account($email, $phoneNumber, $password, $fullName, $address, $date, $idCard1, $idCard2);
                    echo json_encode($result);
                    $this->utils()->sendMail($phoneNumber, $passwordDefault);
                };
            }
        }
    }
}
