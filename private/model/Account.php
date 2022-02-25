<?php
class Account extends DB
{
    public function is_email_exit($email)
    {
        $sql = "SELECT * FROM account WHERE email = ?";
        $rows = $this->conn->prepare($sql);
        $rows->bind_param('s', $email);
        $rows->execute();
        $result = $rows->fetch();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function is_phone_number_exit($phoneNumber)
    {
        $sql = "SELECT * FROM account WHERE phoneNumber = ?";
        $rows = $this->conn->prepare($sql);
        $rows->bind_param('s', $phoneNumber);
        $rows->execute();
        $result = $rows->fetch();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function login($phoneNumber, $password)
    {
        $sql = "SELECT * FROM account WHERE phoneNumber = ?";
        $rows = $this->conn->prepare($sql);
        $rows->bind_param('s', $phoneNumber);
        $rows->execute();
        $result = $rows->fetch();
        if ($password === $result['password']) {
            $_SESSION['authenticated'] = true;
            return true;
        } else {
            return false;
        }
    }
    public function add_Account($email, $phoneNumber, $password, $fullName, $address, $date, $idCard1, $idCard2)
    {
        $sql = "INSERT INTO account( email, phoneNumber, password, fullName, address, date, idCard1, idCard2) VALUES (?,?,?,?,?,?,?,?)";
        $rows = $this->conn->prepare($sql);
        $rows->bind_param('ssssssss', $email, $phoneNumber, $password, $fullName, $address, $date, $idCard1, $idCard2);
        // $rows->execute();
        try {
            if ($rows->execute()) {
                return array(
                    "status" => true,
                    "response" => "Create Successfully!! Please check your email to get your username and password.",
                );
            } else {
                return array(
                    "status" => false,
                    "response" => "Failed to register account!",
                );
            };
        } catch (Exception $e) {
            return array(
                "status" => false,
                "response" => $e,
            );
        };
    }
}
