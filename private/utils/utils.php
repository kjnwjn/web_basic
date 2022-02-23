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
}