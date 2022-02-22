<?php
class App{
    protected $Controller = "home";
    protected $Action = "default";
    protected $Params = [];
    function __construct(){
        $arr = $this->urlProcess();
        if(file_exists('./private/controller/'.$arr[0].'.php')){
            $this->Controller = $arr[0];
            unset($arr[0]);
        };

        require_once './private/controller/'.$this->Controller.'.php';
        $this->Controller = new $this->Controller;

        // Xử lí url element Action 
        if(isset($arr[1])){
            if(method_exists($this->Controller,$arr[1])){
                $this->Action = $arr[1]; 
            }
            unset($arr[1]);
        }
        // Xử lí url element Params
        $this->Params = $arr?array_values($arr):[];
        call_user_func_array([$this->Controller, $this->Action],$this->Params);
    }

    function urlProcess(){
        if(isset($_GET['url'])){
            $tmp_arr = trim($_GET["url"]);
            // $check_arr = filter_var( $tmp_arr,"/");
            // echo $check_arr;
            return $arr = explode("/",$tmp_arr);
        };
        
    }
}