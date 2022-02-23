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
    public function is_phone_number_exit($phoneNumber){
        $sql = "SELECT * FROM account WHERE phoneNumber = ?";
        $rows = $this->conn->prepare($sql);
        $rows -> bind_param('s',$phoneNumber);
        $rows->execute();
        $result = $rows->fetch();
        if($result>0){
            return true;
        }else{
            return false;
        }
    }
    public function login($phoneNumber,$password){
        $sql = "SELECT * FROM account WHERE phoneNumber = ?";
        $rows = $this->conn->prepare($sql);
        $rows -> bind_param('s',$phoneNumber);
        $rows->execute();
        $result = $rows->fetch();
        if($password===$result['password']){
            $_SESSION['authenticated'] = true;
            return true;
        }else{
            return false;
        }
    }
    public function add_Account($email,$phoneNumber,$fullName,$date,$address,$idCard1,$idCard2,$password){
        $sql = "INSERT INTO account VALUES (?,?,?,?,?,?,?,?)";
        $rows = $this->conn->prepare($sql);
        $row -> bind_param('ssssssss',$email,$phoneNumber,$fullName,$date,$address,$idCard1,$idCard2,$password);
        $row->execute();
        if(mysqli_stmt_affected_rows($rows)){
            return true;
        }else{
            return false;
        }
    }
}