<?php
class Util {
    public function checkTimeStamp($timeStamp=null) {
        return ((string) (int) $timeStamp === $timeStamp) 
        && ($timeStamp <= PHP_INT_MAX)
        && ($timeStamp >= ~PHP_INT_MAX);
    }
    public function checkValidImage($image=null) {
        return ($image['type'] ==='image/jpeg' || $image['type'] ==='image/png' || $image['type'] ==='image/jpg');
    }
    public function checkName($name) {
        return preg_match("/^[a-zA-Z-' ]*$/",$name);
    }
    public function checkEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function checkPhoneNumber($phoneNumber){
        return preg_match("/^[0-9]{10}$/", $phoneNumber);
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}