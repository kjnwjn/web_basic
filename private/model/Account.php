<?php
class Account extends DB{
    public function is_email_exit($email){
        $sql = "SELECT * FROM account WHERE email = ?";
        $rows = $this->conn->prepare($sql);
        $rows -> bind_param('s',$email);
        $rows->execute();
        $result = $rows->fetch();
        if($result>0){
            return true;
        }else{
            return false;
        }
    }
    public function is_phone_number_exit($phone_number){
        $sql = "SELECT * FROM account WHERE phone_number = '$phone_number'";
        $rows = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($rows)>0){
            return true;
        }else{
            return false;
        }
    }
    public function login($phone_number,$password){
        $sql = "SELECT * FROM account WHERE phone_number = '$phone_number'";
        $rows = mysqli_query($this->conn,$sql);
        $data = $rows->fetch_assoc();
        if($password===$data['password']){
            $_SESSION['authenticated'] = true;
            return true;
        }else{
            return false;
        }
    }
}