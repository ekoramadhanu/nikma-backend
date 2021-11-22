<?php
if (!defined('base_url')){
    define('base_url', $_SERVER['DOCUMENT_ROOT'].'/monitoring_skripsi');
}

// import library from composer
require_once base_url.'/vendor/autoload.php';

// import cors
require_once base_url.'/config/cors.php';

// import controller
require_once base_url.'/api/controllers/AdminController.php';
require_once base_url.'/api/controllers/LectureController.php';
require_once base_url.'/api/controllers/MajorHeadController.php';
require_once base_url.'/api/controllers/ThesisController.php';

// set error log in server
Flight::set('flight.log_errors', true);

// initialization object
$cors = new CORS();
$admin = new AdminController();
$lecture = new LectureController();
$majorHead = new MajorHeadController();
$thesis = new ThesisController();

// set cors
Flight::before('start', array($cors, 'setCors'));

Flight::route('POST /admin/login', array($admin, 'login'));
Flight::route('GET /admin/find/@id', array($admin, 'findById'));
Flight::route('PATCH /admin/update-password/@id', array($admin, 'updatePassword'));

Flight::route('POST /major-head/login', array($majorHead, 'login'));
Flight::route('GET /major-head/find/@id', array($majorHead, 'findById'));
Flight::route('PATCH /major-head/update-password/@id', array($majorHead, 'updatePassword'));

Flight::route('POST /lecture/create', array($lecture, 'create'));
Flight::route('POST /lecture/login', array($lecture, 'login'));
Flight::route('GET /lecture/find-all', array($lecture, 'find'));
Flight::route('GET /lecture/find/@id', array($lecture, 'findById'));
Flight::route('PATCH /lecture/update/@id', array($lecture, 'update'));
Flight::route('PATCH /lecture/update-password/@id', array($lecture, 'updatePassword'));
Flight::route('DELETE /lecture/delete/@id', array($lecture, 'delete'));

Flight::route('POST /thesis/create', array($thesis, 'create'));
Flight::route('GET /thesis/find', array($thesis, 'find'));
Flight::route('GET /thesis/find-lecture/@id/@type', array($thesis, 'findByLecture'));
Flight::route('GET /thesis/find-type/@type', array($thesis, 'findByType'));
Flight::route('PATCH /thesis/update/@id', array($thesis, 'updateById'));
Flight::route('DELETE /thesis/delete/@id', array($thesis, 'delete'));

Flight::map('notFound', function(){
    Flight::json(array(
        'status' => 'Error',
        'code' => 404,
        'data' => 'Page Not Found',
    ));
    die();
});

Flight::start();