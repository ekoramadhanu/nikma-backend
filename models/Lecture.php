<?php

// import autoload
require_once base_url. '/vendor/autoload.php';

// import datastore 
require_once base_url. '/config/datastore.php';

class Lecturer extends Datastore { 
     // attribute
     private $tableName= 'lecture';
     public $id ;
     public $name;
     public $email;
     public $password;
     public $is_delete;

     public function create() {
        // query
        $query = "insert into  ".$this->tableName." (id, name, email, password ) VALUES (
            '".$this->id."',
            '".$this->name."',
            '".$this->email."',
            '".$this->password."'
        )";
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;

        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }   
     }

    public function findByEmail() {
        // query to insert data role admin
        $query = "select id, name, email, password from ".$this->tableName.
            " where email = '".$this->email."' and is_delete = 0";
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            $stmt->execute();
            return $stmt;
        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }  
    }

    public function findByEmailExceptSelf() {
        // query to insert data role admin
        $query = "select id, name, email, password from ".$this->tableName.
            " where email = '".$this->email."' and id != '".$this->id."' and is_delete = 0";
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            $stmt->execute();
            return $stmt;
        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }  
    }

    public function findById() {
        // query to insert data role admin
        $query = "select id, name, email, password from ".$this->tableName.
        " where id = '".$this->id."' and is_delete = 0";
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            $stmt->execute();
            return $stmt;
        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }  
    }

    public function updatePassword(){
        // query update password admin
        $query = " update ".$this->tableName." 
        set password = '".$this->password."'
        where id = '".$this->id."' and is_delete = 0";
        
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;

        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }  
    }

    public function updateById () {
        // query update password admin
        $query = " update ".$this->tableName." 
        set name = '".$this->name."',
        email = '".$this->email."'
        where id = '".$this->id."' and is_delete = 0";
        
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;

        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }  
    }

    public function find() {
        // query to insert data role admin
        $query = "select id, name, email, password from ".$this->tableName." where is_delete = 0 order by name";
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            $stmt->execute();
            return $stmt;
        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }  
    }

    public function delete() {
        // query update password admin
        $query = " update ".$this->tableName." 
        set is_delete = 1
        where id = '".$this->id."'";
        
        try {
            //  prepare to execute query 
            $stmt = $this->db->prepare($query);

            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;

        } catch (exception  $e) {
            Flight::json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
            die();
        }  
    }
    
 }