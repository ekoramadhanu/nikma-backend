<?php

class CORS{

    public function setCors(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE");
    }   

}