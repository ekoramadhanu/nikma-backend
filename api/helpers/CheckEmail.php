<?php

// create class check email
class CheckEmail{

    /**
     * this function is use for check valid email 
     *
     * @param string $email name E-mail 
     * 
     * @author EKA
     * @return boolean true or false about format email
     */ 
    public function checkValidEmail($email) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }   

}