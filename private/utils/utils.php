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

    public function uploadImage($imageToUpload){

        // Được rồi
        // thêm cái hex gì à
        // thằng var_dum để show ra mà
        // giống vs print_r á
        $id_token = bin2hex(random_bytes(10));
        $target_dir = "./public/assest/img/uploads/";
        $target_file = $target_dir .$id_token . basename($imageToUpload["name"]); 

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        
        $check = getimagesize($imageToUpload["tmp_name"]);
        if($check == false) {
            return [
                'status' => false,
                'msg' => 'File is not an image.'
            ];
        }else if (file_exists($target_file)) {
            return [
                'status' => false,
                'msg' => 'Sorry, file already exists.'
            ];
        }else if($imageToUpload["size"] > 500000) {
            return [
                'status' => false,
                'msg' => 'Sorry, your file is too large.'
            ];
        }else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            return [
                'status' => false,
                'msg' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.'
            ];
        }else{

            if (move_uploaded_file($imageToUpload["tmp_name"], $target_file)) {
                return [
                    'status' => true,
                    'msg' => 'The file '. htmlspecialchars( basename( $imageToUpload['name'])). ' has been uploaded.'
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => "Sorry, there was an error uploading your file."
                ];
            }
        }

        // Check if $uploadOk is set to 0 by an error
    }
}