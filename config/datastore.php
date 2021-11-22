<?php
// import autoload
require_once base_url. '/vendor/autoload.php';

class Datastore{
    public $db;

    function  __construct() {
        // load .env library
        $dotenv = Dotenv\Dotenv::createImmutable(base_url);
        $dotenv->load();

        // define variable from environment
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        try {
            // connect to database
            $this->db = new PDO("mysql:host=$host:$port;dbname=$dbname", $user, $password);

            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException  $th) {
            Flight::json(array(
                'status' => 'Error',
                'message' => 'Database cannot access'
            ));
            die();
        }        
    }
}