<?php

// import autoload
require_once base_url. '/vendor/autoload.php';

// import datastore 
require_once base_url. '/config/datastore.php';

class Thesis extends Datastore { 

    // attribute
    private $tableName= 'thesis';
    private $tableName1= 'lecture';
    public $id ;
    public $name;
    public $nim;
    public $title;
    public $type;
    public $date_start;
    public $date_end;
    public $is_graduate = 0;
    public $semester;
    public $year;
    public $lecture_one;
    public $lecture_two = null;
    public $is_delete;

    public function created() {
        // query
        $query = null;

        if ($this->lecture_two !== null) {
            $query = "insert into  ".$this->tableName." 
                (id, name, nim, title, type, date_start, date_end, is_graduate, semester,
                year, lecture_one, lecture_two) VALUES (
                '".$this->id."',
                '".$this->name."',
                '".$this->nim."',
                '".$this->title."',
                '".$this->type."',
                '".$this->date_start."',
                '".$this->date_end."',
                ".$this->is_graduate.",
                '".$this->semester."',
                '".$this->year."',
                '".$this->lecture_one."',
                '".$this->lecture_two."'
            )";
        } else {
            $query = "insert into  ".$this->tableName." 
                (id, name, nim, title, type, date_start, date_end, is_graduate, semester,
                year, lecture_one) VALUES (
                '".$this->id."',
                '".$this->name."',
                '".$this->nim."',
                '".$this->title."',
                '".$this->type."',
                '".$this->date_start."',
                '".$this->date_end."',
                ".$this->is_graduate.",
                '".$this->semester."',
                '".$this->year."',
                '".$this->lecture_one."'
            )";
        }

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
        $query = "select 
            ".$this->tableName. ".id, 
            ".$this->tableName. ".name, 
            ".$this->tableName. ".nim, 
            ".$this->tableName. ".title, 
            ".$this->tableName. ".type, 
            ".$this->tableName. ".date_start, 
            ".$this->tableName. ".date_end, 
            ".$this->tableName. ".is_graduate, 
            ".$this->tableName. ".semester,
            ".$this->tableName. ".year, 
            lecture1.name as lecture1,
            lecture1.id as idLecture1,
            lecture2.id as idLecture2,
            lecture2.name as lecture2 from ".$this->tableName. "
        join ".$this->tableName1." lecture1 on lecture1.id  = ".$this->tableName.".lecture_one 
        left join ".$this->tableName1." lecture2 on lecture2.id  = ".$this->tableName.".lecture_two 
        where ".$this->tableName. ".is_delete = 0 
        order by ".$this->tableName. ".create_at desc"  
        ;
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

    public function findByType($type) {
        // query to insert data role admin
        $query = "select 
            ".$this->tableName. ".id, 
            ".$this->tableName. ".name, 
            ".$this->tableName. ".nim, 
            ".$this->tableName. ".title, 
            ".$this->tableName. ".type, 
            ".$this->tableName. ".date_start, 
            ".$this->tableName. ".date_end, 
            ".$this->tableName. ".is_graduate, 
            ".$this->tableName. ".semester,
            ".$this->tableName. ".year, 
            lecture1.name as lecture1,
            lecture2.name as lecture2 from ".$this->tableName. "
        join ".$this->tableName1." lecture1 on lecture1.id  = ".$this->tableName.".lecture_one 
        left join ".$this->tableName1." lecture2 on lecture2.id  = ".$this->tableName.".lecture_two 
        where ".$this->tableName. ".type = '".$type."' and ".$this->tableName. ".is_delete = 0"  
        ;

        echo $query;
        die();
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

    public function countStatusByType($status){
        // query to insert data role admin
        $query = "select 
            ".$this->tableName. ".id from ".$this->tableName. "
            where ".$this->tableName. ".type = '".$this->type."' and ".$this->tableName. ".is_graduate = ".$status." and ".$this->tableName. ".is_delete = 0
            and (".$this->tableName.".lecture_one  = '".$this->lecture_two."' or ".$this->tableName.".lecture_two  = '".$this->lecture_two."')" ;

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
    public function duplicate($name,$nim,$type) {
        // query to insert data role admin
        $query = "select 
            ".$this->tableName. ".id from ".$this->tableName. "
            where ".$this->tableName. ".name = '".$name."' and ".$this->tableName. ".nim = ".$nim." and ".$this->tableName. ".is_delete = 0
            and ".$this->tableName. ".type = '".$type."'" ;

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

    public function findByLecture($id) {
         // query to insert data role admin
         $query = "select 
            ".$this->tableName. ".id, 
            ".$this->tableName. ".name, 
            ".$this->tableName. ".nim, 
            ".$this->tableName. ".title, 
            ".$this->tableName. ".type, 
            ".$this->tableName. ".date_start, 
            ".$this->tableName. ".date_end, 
            ".$this->tableName. ".is_graduate, 
            ".$this->tableName. ".semester,
            ".$this->tableName. ".year, 
            lecture1.name as lecture1,
            lecture2.name as lecture2 from ".$this->tableName. "
        join ".$this->tableName1." lecture1 on lecture1.id  = ".$this->tableName.".lecture_one 
        left join ".$this->tableName1." lecture2 on lecture2.id  = ".$this->tableName.".lecture_two 
        where (".$this->tableName.".lecture_one  = '".$id."' or ".$this->tableName.".lecture_two  = '".$id."')
        and ".$this->tableName. ".type = '".$this->type."' and ".$this->tableName. ".is_delete = 0
        "  
        ;

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

    public function updateById () {
        // query update password admin
        $query = null;
        if ($this->lecture_two !== null) {
            $query = " update ".$this->tableName." 
            set name = '".$this->name."',
            nim = '".$this->nim."', 
            title = '".$this->title."',
            type = '".$this->type."', 
            date_start = '".$this->date_start."', 
            date_end = '".$this->date_end."',
            is_graduate = '".$this->is_graduate."', 
            semester = '".$this->semester."',
            year = '".$this->year."', 
            lecture_one = '".$this->lecture_one."', 
            lecture_two = '".$this->lecture_two."'
            where id = '".$this->id."' and ".$this->tableName. ".is_delete = 0";
        } else {
            $query = " update ".$this->tableName." 
            set name = '".$this->name."',
            nim = '".$this->nim."', 
            title = '".$this->title."',
            type = '".$this->type."', 
            date_start = '".$this->date_start."', 
            date_end = '".$this->date_end."',
            is_graduate = '".$this->is_graduate."', 
            semester = '".$this->semester."',
            year = '".$this->year."', 
            lecture_one = '".$this->lecture_one."',
            lecture_two = null
            where id = '".$this->id."' and ".$this->tableName. ".is_delete = 0";
        }
        
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