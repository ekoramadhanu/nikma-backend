<?php

// import autoload
require_once base_url. '/vendor/autoload.php';

// import helper random string
require_once base_url . '/api/helpers/RandomString.php';

// import models about us
require_once base_url . '/models/MajorHead.php';

class MajorHeadController { 

    // attribute
    private $headMajor;

    // constructor
    public function __construct(){
        $this->headMajor = new HeadMajor();
    }

    public function login() {
        // get body 
        $request = Flight::request();

        if (
           !empty($request->data->email)
           && !empty($request->data->password)
        ) {

           // set data to class head majors
           $this->headMajor->email = $request->data->email;
           $this->headMajor->password = $request->data->password;

           $data = $this->headMajor->findByEmail();
           $result = $data->fetch(PDO::FETCH_ASSOC);

           if ($data->rowCount() > 0) {
               if (password_verify($request->data->password, $result['password'])) { 
                   Flight::json(array(
                       'status' => 'success',
                       'data' => array(
                           'id' => $result['id'],
                           'role' => 'Head Major'
                       ),
                   )); 
               } else {
                   Flight::json(array(
                       'status' => 'Fails',
                       'data' => array(
                           'message' => 'Password not Match'
                       ),
                   ));
                   die();
               }
           } else {
               Flight::json(array(
                   'status' => 'Fails',
                   'data' => array(
                       'message' => 'Data Not Found'
                   ),
               ));
               die();
           }

        } else {
            // initialization array message
           $arrayMessage  = array();

           //  check data required
            if (empty($request->data->email)) {
               $arrayMessage['email'] = 'email is required';
           }
            if (empty($request->data->password)) {
               $arrayMessage['password'] = 'password is required';
           }

           // send message fails
           Flight::json(array(
               'status' => 'Fails',
               'data' => $arrayMessage,
           ));
           die();
        }
    }

    public function findById($id) {
        // set data to class head majors
        $this->headMajor->id = $id;

        // get data head majors by id
        $data = $this->headMajor->findById();

        if ($data->rowCount()) {
            // initialization
            $finalArray=array();

            while ($row = $data->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
            
                $item=array(
                    "id" => $id,
                    "name" => $name,
                    "email" => $email,
                );
                array_push($finalArray, $item);
            }

            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'headMajor' => $finalArray
                ),
            ));
            die();
        } else {
            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'headMajor' => [],
                ),
            ));
        }
    }

    public function updatePassword($id) {
        // get body 
        $body = Flight::request()->getBody();
        $request = json_decode($body);

        if (!empty($request->oldPassword) 
        && !empty($request->newPassword)) { 

            // set data to class head majors
            $this->headMajor->id = $id;
            $this->headMajor->password = password_hash($request->newPassword, PASSWORD_DEFAULT);

            // get data head majors by id
            $getDataById = $this->headMajor->findById();
            $result = $getDataById->fetch(PDO::FETCH_ASSOC);

            if ($getDataById->rowCount() > 0) {
                if(password_verify($request->oldPassword,$result['password'])) {
                    if ($this->headMajor->updatePassword()) {
                        // send message success
                        Flight::json(array(
                            'status' => 'success',
                            'data' => array(
                                'message' => 'Data Head Majors Is Successfully Update'
                            ),
                        )); 
                        die();
                    } else {
                        // send message fails
                        Flight::json(array(
                            'status' => 'Fails',
                            'data' => array(
                                'message' => 'Data Head Majors Cannot Updated',
                            ),
                        )); 
                        die();
                    }
                } else {
                    // send message fails
                    Flight::json(array(
                        'status' => 'Fails',
                        'data' => array(
                            'message' => 'Password Not Match',
                        ),
                    )); 
                    die();
                }
            } else {
                // send message fails
                Flight::json(array(
                    'status' => 'Fails',
                    'data' => 'Data Not Found',
                )); 
                die();
            }
        } else {
            // initialization array message
            $arrayMessage  = array();

            // set message if every request required is null
            if (empty($request->oldPassword) ) {
                $arrayMessage['oldPassword'] = 'oldPassword is required';
            } 
            if (empty($request->newPassword)) {
                $arrayMessage['newPassword'] = 'newPassword is required';
            } 

            // send message fails
            Flight::json(array(
                'status' => 'Fails',
                'data' => $arrayMessage,
            ));
            die();
        }

    }

}