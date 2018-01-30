<?php
  require_once '../debug.php';

  // create a connection to the database
  // and create-read-update-delete data
  // all using this class

  class DAL {
      private $conn;
      private static $instance; //singleton

      // this function is private to constrain
      // creating more than one connection to the database
      private function __construct($params) {
          // create a connection
          try {
              $this->conn = new PDO("mysql:host=".$params['servername'].";dbname=".$params['dbname'], $params['username'], $params['password']);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
          catch (PDOException $e) {
              debug($e->getMessage());
              return $e->getMessage();
          }
      }

      function __destruct() {
          // kill the connection
          $this->conn = null;
      }

      // singleton
      public static function getInstance($params) {
          //debug('get instance');
          if(!isset(self::$instance))
              self::$instance = new DAL($params);
          return self::$instance;
      }


      function fetch($sql) {
          try {
              $resultsArray = $this->conn->query($sql);
              return $resultsArray;
          }
          catch(PDOException $e) {
              return $e->getMessage();
          }
      }

      function insertData($sql) {
          try {
              $result = $this->conn->query($sql);
              $lastId = $this->conn->lastInsertId();

              return [
                  'recordId' => $lastId,
                  'insertResult' => $result,
                  'errorMassage' => 'success'
              ];
          }
          catch(PDOException $e) {
              return [
              'recordId' => -1,
              'insertResult' => false,
              'errorMassage' => $e->getMessage(),
              'errorCode' => $e->getCode()
              ];
          }
      }
  }

  $dbDetails = [
      'servername' => 'localhost',
      'username' => 'root',
      'password' => '',
      'dbname' => 'theschool'
  ];

  // *** test singleton ***
  // $data = DAL::getInstance($dbDetails);
  // $data = DAL::getInstance($dbDetails);
  // $data = DAL::getInstance($dbDetails);
  //
  // *** testing connection ***
  // foreach ($data->fetch('select * from roles') as $role) {
  //   debug($role);
  // }

?>
