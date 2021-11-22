<?php

//  make class RandomString
class RandomString{

    /**
     * this function is use for generate random string with alphabet 
     *
     * @param integer length string generate string alphabet
     * 
     * @author EKA
     * @return string random string
     */ 
    public function generateRandomString($length){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $random_string .= $characters[$index];
        }

        return $random_string;
    }
}