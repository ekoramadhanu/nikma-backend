<?php
// import autoload
require_once base_url. '/vendor/autoload.php';

// import helper random string
require_once base_url . '/api/helpers/RandomString.php';

// import models about us
require_once base_url . '/models/Thesis.php';
require_once base_url . '/models/Lecture.php';

class ThesisController {

    // attribute
    private $thesis;
    private $lecture;
    private $randomString;

    // constructor
    public function __construct(){
        $this->thesis = new Thesis();
        $this->randomString = new RandomString();
        $this->lecture = new Lecturer();
    }

    public function create() {
        // get body 
        $request = Flight::request();
        
        if (!empty($request->data->name)
            && !empty($request->data->nim)
            && !empty($request->data->title)
            && !empty($request->data->type)
            && !empty($request->data->date_start)
            && !empty($request->data->date_end)
            && !empty($request->data->semester)
            && !empty($request->data->year1)
            && !empty($request->data->year2)
            && !empty($request->data->lecture_one)
        )  {

           $count = $this->thesis->duplicate($request->data->name, $request->data->nim, $request->data->type)->rowCount();
           if($count == 0) {
               // set data to class head majors
               $date_time = new DateTime();
               $id = md5($this->randomString->generateRandomString(3) . $date_time->getTimestamp());
               $this->thesis->id = $id;
               $this->thesis->name = $request->data->name;
               $this->thesis->nim = $request->data->nim;
               $this->thesis->title = $request->data->title;
               $this->thesis->type = $request->data->type;
               $this->thesis->date_start = $request->data->date_start;
               $this->thesis->date_end = $request->data->date_end;
               $this->thesis->semester = $request->data->semester;
               $this->thesis->year = $request->data->year1 ." / ".$request->data->year2;
               $this->thesis->lecture_one = $request->data->lecture_one;
    
               if (!empty($request->data->graduate) &&  $request->data->graduate == 'lulus') {
                 $this->thesis->is_graduate = 1;
               } 
    
               if (!empty($request->data->lecture_two)) {
                 $this->thesis->lecture_two = $request->data->lecture_two;
               } 
    
               if ($this->thesis->created()) {
                Flight::json(array(
                    'status' => 'Success',
                    'data' => array(
                        'message' => 'Data Thesis Is Successfully Create'
                    ),
                ));
                die(); 
               } else {
                Flight::json(array(
                    'status' => 'Fails',
                    'data' => array(
                        'message' => 'Data Thesis Cannot Created'
                    ),
                ));
                die();
               }
           } else {
            Flight::json(array(
                'status' => 'Success',
                'data' => array(
                    'message' => 'Data Thesis Already Exist'
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
            if (empty($request->data->nim)) {
               $arrayMessage['nim'] = 'nim is required';
            }
            if (empty($request->data->title)) {
               $arrayMessage['title'] = 'title is required';
            }
            if (empty($request->data->type)) {
               $arrayMessage['type'] = 'type is required';
            }
            if (empty($request->data->date_start)) {
               $arrayMessage['date_start'] = 'date_start is required';
            }
            if (empty($request->data->date_end)) {
               $arrayMessage['date_end'] = 'date_end is required';
            }
            if (empty($request->data->semester)) {
               $arrayMessage['semester'] = 'semester is required';
            }
            if (empty($request->data->year1)) {
               $arrayMessage['year1'] = 'year1 is required';
            }
            if (empty($request->data->year2)) {
               $arrayMessage['year2'] = 'year2 is required';
            }
            if (empty($request->data->lecture_one)) {
               $arrayMessage['lecture_one'] = 'lecture_one is required';
            }

           // send message fails
           Flight::json(array(
               'status' => 'Fails',
               'data' => $arrayMessage,
           ));
           die();
        }
    }

    public function find () {
        // get data admin by id
        $data = $this->thesis->find();

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
                    "nim" => $nim,
                    "title" => $title,
                    "type" => $type,
                    "date_start" => $date_start,
                    "date_end" => $date_end,
                    "is_graduate" => $is_graduate,
                    "semester" => $semester,
                    "year" => $year,
                    "lecture1" => $lecture1,
                    "lecture2" => $lecture2,
                    "idLecture1" => $idLecture1,
                    "idLecture2" => $idLecture2,
                );
                array_push($finalArray, $item);
            }

            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'thesis' => $finalArray
                ),
            ));
            die();
        } else {
            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'thesis' => [],
                ),
            ));
        }

    }

    public function findByLecture($id, $type){

        $this->thesis->type = $type;

        // get data admin by id
        $data = $this->thesis->findByLecture($id);

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
                    "nim" => $nim,
                    "title" => $title,
                    "type" => $type,
                    "date_start" => $date_start,
                    "date_end" => $date_end,
                    "is_graduate" => $is_graduate,
                    "semester" => $semester,
                    "year" => $year,
                    "lecture1" => $lecture1,
                    "lecture2" => $lecture2,
                );
                array_push($finalArray, $item);
            }

            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'thesis' => $finalArray
                ),
            ));
            die();
        } else {
            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'thesis' => [],
                ),
            ));
        }
    }

    public function findByType($type){

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

                $this->thesis->type = $type;
                $this->thesis->lecture_one = $id;
                $this->thesis->lecture_two = $id;

            
                $item=array(
                    "id" => $id,
                    "name" => $name,
                    "complete" => $this->thesis->countStatusByType(1)->rowCount(),
                    "unComplete" => $this->thesis->countStatusByType(0)->rowCount(),
                );
                array_push($finalArray, $item);
            }

            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'thesis' => $finalArray
                ),
            ));
            die();
        } else {
            // send message success
            Flight::json(array(
                'status' => 'success',
                'data' => array(
                    'thesis' => [],
                ),
            ));
        }
    }

    public function updateById($id) {
        // get body 
        $body = Flight::request()->getBody();
        $request = json_decode($body);
        
        if (!empty($request->name)
            && !empty($request->nim)
            && !empty($request->title)
            && !empty($request->type)
            && !empty($request->date_start)
            && !empty($request->date_end)
            && !empty($request->semester)
            && !empty($request->year1)
            && !empty($request->year2)
            && !empty($request->lecture_one)
        )  {

            // set data to class head majors
           $this->thesis->id = $id;
           $this->thesis->name = $request->name;
           $this->thesis->nim = $request->nim;
           $this->thesis->title = $request->title;
           $this->thesis->type = $request->type;
           $this->thesis->date_start = $request->date_start;
           $this->thesis->date_end = $request->date_end;
           $this->thesis->semester = $request->semester;
           $this->thesis->year = $request->year1 ." / ".$request->year2;
           $this->thesis->lecture_one = $request->lecture_one;

           if (!empty($request->graduate) &&  $request->graduate == 'lulus') {
             $this->thesis->is_graduate = 1;
           } 

           if (!empty($request->lecture_two)) {
             $this->thesis->lecture_two = $request->lecture_two;
           } 

           if ($this->thesis->updateById()) {
            Flight::json(array(
                'status' => 'Success',
                'data' => array(
                    'message' => 'Data Thesis Is Successfully Update'
                ),
            ));
            die(); 
           } else {
            Flight::json(array(
                'status' => 'Fails',
                'data' => array(
                    'message' => 'Data Thesis Cannot Update'
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
            if (empty($request->nim)) {
               $arrayMessage['nim'] = 'nim is required';
            }
            if (empty($request->title)) {
               $arrayMessage['title'] = 'title is required';
            }
            if (empty($request->type)) {
               $arrayMessage['type'] = 'type is required';
            }
            if (empty($request->date_start)) {
               $arrayMessage['date_start'] = 'date_start is required';
            }
            if (empty($request->date_end)) {
               $arrayMessage['date_end'] = 'date_end is required';
            }
            if (empty($request->semester)) {
               $arrayMessage['semester'] = 'semester is required';
            }
            if (empty($request->year1)) {
               $arrayMessage['year1'] = 'year1 is required';
            }
            if (empty($request->year2)) {
               $arrayMessage['year2'] = 'year2 is required';
            }
            if (empty($request->lecture_one)) {
               $arrayMessage['lecture_one'] = 'lecture_one is required';
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
        $this->thesis->id = $id;

        if ($this->thesis->delete()) {
            Flight::json(array(
                'status' => 'Success',
                'data' => array(
                    'message' => 'Data Thesis Is Successfully Delete'
                ),
            ));
            die();  
        } else {
            Flight::json(array(
                'status' => 'Delete',
                'data' => array(
                    'message' => 'Data Thesis Cannot Delete'
                ),
            ));
            die();  
        }
    }

}