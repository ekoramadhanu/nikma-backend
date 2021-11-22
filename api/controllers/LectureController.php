<?php

// import autoload
require_once base_url. '/vendor/autoload.php';

// import helper random string
require_once base_url . '/api/helpers/RandomString.php';

// import models about us
require_once base_url . '/models/Lecture.php';
require_once base_url . '/models/MajorHead.php';
require_once base_url . '/models/Admin.php';

class LectureController { 

    // attribute
    private $lecture;
    private $headMajor;
    private $randomString;
    private $admin;

    // constructor
    public function __construct(){
        $this->lecture = new Lecturer();
        $this->randomString = new RandomString();
        $this->headMajor = new HeadMajor();
        $this->admin = new Admin();
    }

    public function create() {
        // get body 
        $request = Flight::request();
        
        if (!empty($request->data->name)
            && !empty($request->data->email)
        ) {
            // set data to class student
            $date_time = new DateTime();
            $id = md5($this->randomString->generateRandomString(3) . $date_time->getTimestamp());
            $this->lecture->id = $id;
            $this->lecture->name = $request->data->name;
            $this->lecture->email = $request->data->email;
            $this->lecture->password = password_hash('MON123456!', PASSWORD_DEFAULT);

            $this->admin->email = $request->data->email;
            $this->headMajor->email = $request->data->email;

            //  get data 
            $dataAdmin = $this->admin->findByEmail()->rowCount();
            $dataHeadMajor = $this->headMajor->findByEmail()->rowCount();
            $dataLecturer = $this->lecture->findByEmail()->rowCount();

            if ($dataAdmin == 0 && $dataHeadMajor == 0 && $dataLecturer == 0) {
                if ($this->lecture->create()) {
                    Flight::json(array(
                        'status' => 'Success',
                        'data' => array(
                            'message' => 'Data Lecture Is Successfully Create'
                        ),
                    ));
                    die();    
                } else {
                    Flight::json(array(
                        'status' => 'Fails',
                        'data' => array(
                            'message' => 'Data Cannot Created'
                        ),
                    ));
                    die();    
                }
            } else {
                Flight::json(array(
                    'status' => 'Fails',
                    'data' => array(
                        'message' => 'Email Has Been Used'
                    ),
                ));
                die();
            }
        } else {
            // initialization array message
            $arrayMessage  = array();

            //  check data required
             if (empty($request->data->name)) {
                $arrayMessage['name'] = 'name is required';
            }
             if (empty($request->data->email)) {
                $arrayMessage['email'] = 'email is required';
            }
            

            // send message fails
            Flight::json(array(
                'status' => 'Fails',
                'data' => $arrayMessage,
            ));
            die();
        }
    }

    public function login() {
        // get body 
        $request = Flight::request();

        if (
           !empty($request->data->email)
           && !empty($request->data->password)
        ) {

           // set data to class ADmin
           $this->lecture->email = $request->data->email;
           $this->lecture->password = $request->data->password;

           $data = $this->lecture->findByEmail();
           $result = $data->fetch(PDO::FETCH_ASSOC);

           if ($data->rowCount() > 0) {
               if (password_verify($request->data->password, $result['password'])) { 
                   Flight::json(array(
                       'status' => 'success',
                       'data' => array(
                           'id' => $result['id'],
                           'role' => 'Lecture'
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
        $this->lecture->id = $id;

        // get data head majors by id
        $data = $this->lecture->findById();

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
                    'lecture' => $finalArray
                ),
            ));
            die();
        } else {
            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'lecture' => [],
                ),
            ));
        }
    }

    public function find() {
        // get data admin by id
        $data = $this->lecture->find();

        if ($data->rowCount() > 0) {
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
                    'lecture' => $finalArray
                ),
            ));
            die();
        } else {
            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'lecture' => [],
                ),
            ));
        }
    }

    public function update($id) {
        // get body 
        $body = Flight::request()->getBody();
        $request = json_decode($body);

        if (!empty($request->name)
            && !empty($request->email)
        ) { 
             // set data to class student
             $date_time = new DateTime();
             $this->lecture->id = $id;
             $this->lecture->name = $request->name;
             $this->lecture->email = $request->email;
 
             $this->admin->email = $request->email;
             $this->headMajor->email = $request->email;
 
             //  get data 
             $dataAdmin = $this->admin->findByEmail()->rowCount();
             $dataHeadMajor = $this->headMajor->findByEmail()->rowCount();
             $dataLecturer = $this->lecture->findByEmail()->rowCount();

             //  get data 
             $dataAdmin = $this->admin->findByEmail()->rowCount();
             $dataHeadMajor = $this->headMajor->findByEmail()->rowCount();
             $dataLecturer = $this->lecture->findByEmailExceptSelf()->rowCount();

            if ($dataAdmin == 0 && $dataHeadMajor == 0 && $dataLecturer == 0) {
                if ($this->lecture->updateById()) {
                    Flight::json(array(
                        'status' => 'Success',
                        'data' => array(
                            'message' => 'Data Lecture Is Successfully Update'
                        ),
                    ));
                    die();    
                } else {
                    Flight::json(array(
                        'status' => 'Fails',
                        'data' => array(
                            'message' => 'Data Cannot Update'
                        ),
                    ));
                    die();    
                }
            } else {
                Flight::json(array(
                    'status' => 'Fails',
                    'data' => array(
                        'message' => 'Email Has Been Used'
                    ),
                ));
                die();
            }

        } else {
            // initialization array message
            $arrayMessage  = array();

            //  check data required
             if (empty($request->name)) {
                $arrayMessage['name'] = 'name is required';
            }
             if (empty($request->email)) {
                $arrayMessage['email'] = 'email is required';
            }
            

            // send message fails
            Flight::json(array(
                'status' => 'Fails',
                'data' => $arrayMessage,
            ));
            die();
        }
    }

    public function updatePassword($id) {
        // get body 
        $body = Flight::request()->getBody();
        $request = json_decode($body);

        if (!empty($request->oldPassword) 
        && !empty($request->newPassword)) { 

            // set data to class head majors
            $this->lecture->id = $id;
            $this->lecture->password = password_hash($request->newPassword, PASSWORD_DEFAULT);

            // get data head majors by id
            $getDataById = $this->lecture->findById();
            $result = $getDataById->fetch(PDO::FETCH_ASSOC);

            if ($getDataById->rowCount() > 0) {
                if(password_verify($request->oldPassword,$result['password'])) {
                    if ($this->lecture->updatePassword()) {
                        // send message success
                        Flight::json(array(
                            'status' => 'success',
                            'data' => array(
                                'message' => 'Data Lecture Is Successfully Update'
                            ),
                        )); 
                        die();
                    } else {
                        // send message fails
                        Flight::json(array(
                            'status' => 'Fails',
                            'data' => array(
                                'message' => 'Data Lecture Cannot Updated',
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

    public function delete($id) {
        $this->lecture->id = $id;

        if ($this->lecture->delete()) {
            Flight::json(array(
                'status' => 'Success',
                'data' => array(
                    'message' => 'Data Lecture Is Successfully Delete'
                ),
            ));
            die();  
        } else {
            Flight::json(array(
                'status' => 'Delete',
                'data' => array(
                    'message' => 'Data Lecture Cannot Delete'
                ),
            ));
            die();  
        }
    }

}