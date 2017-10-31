<?php
    /**
     * Ruta Api Class
     */

     class Ruta {
         public $conn;
         protected $dbUser = "root";
         protected $dbName = "ruta-api-db-recome";
         protected $dbPassword = "";

         public $token = "0e23360ef2c65a77467d9ad9ccfd25ed";

         public function __construct() {
            $this->conn = new mysqli('localhost', $this->dbUser, $this->dbPassword, $this->dbName);
            if(!$this->conn) {
                die("Error is preparing Database");
            }
         }

        public function stdToObject($data) {
            if (is_object($data)) {
                $data = get_object_vars($data);
            }

            if (is_array($data)) {
                return array_map(__FUNCTION__, $data);
            }
            else {
                return $data;
            }
        }

         public function subscribe() {
            $array_values = array_values($array);
            $array_keys = array_keys($array);

            $implodeValues = implode(', ', $array_values);
            $implodeKeys = $this->conn->real_escape_string(implode(', ', $array_keys));

            $subscribe = $this->conn->query("INSERT INTO subscribers(".$implodeKeys.") VALUES (".$implodeValues.")");

            if($subscribe) {
                return true;
            } else {
                return false;
            }  
         }

         public function register($array) {
            $array_values = array_values((array)$array);
            $array_keys = array_keys((array)$array);

            $implodeValues = implode(', ', $this->stdToObject($array_values));
            /*$implodeKeys = $this->conn->real_escape_string(implode(', ', $array_keys));

            $register = $this->conn->query("INSERT INTO riders(".$implodeKeys.") VALUES (".$implodeValues.")");

            if($register) {
                return true;
            } else {
                return false;
            }
            */
         }

         public function response($status, $status_message, $data){
            header("HTTP/1.1 ".$status_message);
            $response['status'] = $status;
            $response['status_message'] = $status_message;
            $response['data'] = $data;
            $json_response = json_encode($response, JSON_PRETTY_PRINT);
            // return $json_response;
            echo $json_response;
            exit;
        }
     }
?>