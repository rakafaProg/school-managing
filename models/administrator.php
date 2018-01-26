<?php

    include_once 'person.php';

    class Administrator extends Person {
      private $role;
      private $password;

      function __construct($params) {
        parent::__construct($params);

        $this->setRole($params['role']);
        $this->setPassword($params['password']);
      }

      function getRole() {
        return $this->role;
      }

      function setRole ($role) {
        $this->role = $role;
      }

      function getPassword() {
        return $this->password;
      }

      function setPassword ($password) {
        $this->password = $password;
      }

    }


 ?>
