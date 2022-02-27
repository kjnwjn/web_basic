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
        $sql = "SELECT * FROM account WHERE phoneNumber = $phoneNumber";
        $rows = $this->conn->query($sql);

        $result = mysqli_fetch_array($rows, MYSQLI_ASSOC);
        // echo $password;
        if (password_verify($password, $result['password'])) {
            $_SESSION['authenticated'] = true;
            return true;
        } else {
            return false;
        }
    }

    public function checkActive($phoneNumber)
    {
        $sql = "SELECT * FROM account WHERE phoneNumber = $phoneNumber";
        $rows = $this->conn->query($sql);

        $result = mysqli_fetch_array($rows, MYSQLI_ASSOC);
        if (!$result['active']) {
            return false;
        } else {
            return true;
        }
    }
    public function updateActive($active, $phoneNumber)
    {
        $sql = "UPDATE account SET active = ? WHERE phoneNumber = ?";
        $rows = $this->conn->prepare($sql);
        $rows->bind_param('ss', $active, $phoneNumber);
        try {
            if ($rows->execute()) {
                return array(
                    "status" => true,
                    "msg" => "",
                );
            } else {
                return array(
                    "status" => false,
                    "msg" => "",
                );
            };
        } catch (Exception $e) {
            return array(
                "status" => false,
                "msg" => "",
            );
        }
    }
    public function updatePassword($newPassword, $phoneNumber)
    {
        $sql = "UPDATE account SET password = ? WHERE phoneNumber = ?";
        $rows = $this->conn->prepare($sql);
        $rows->bind_param('ss', $newPassword, $phoneNumber);
        try {
            if ($rows->execute()) {
                return true;
            } else {
                return false;
            };
        } catch (Exception $e) {
            return false;
        }
    }
    public function checkWrongPassword($email)
    {
        $sql = "SELECT * FROM account WHERE email = ?";
        $rows = $this->conn->prepare($sql);
        $rows->bind_param('s', $email);
        $rows->execute();
        $result = $rows->fetch();
        if ($result['wrongPassword'] === 3) {

            return 0;
        } else if ($result['wrong'] === 1) {
            // đã đổi mật khẩu nhưng chưa check thông tin
            return 1;
        } else {
            // Hoàn tất tài khoản
            return 2;
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
                    "msg" => "Create Successfully!! Please check your email to get your username and password.",
                    "redirect" => "../login"
                );
            } else {
                return array(
                    "status" => false,
                    "msg" => "Failed to register account!",
                );
            };
        } catch (Exception $e) {
            return array(
                "status" => false,
                "msg" => $e,
            );
        };
    }
}
