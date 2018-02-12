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

      function getAsArray() {
        return [
          'name' => $this->name,
          'role' => $this->role,
          'phone' => $this->phone,
          'email' => $this->email,
          'id' => $this->getId(),
          'image' => $this->image,
          'password' => ''
        ];
      }

      function getRole() {
        return $this->role;
      }

      function getRoleName() {
        switch ($this->role) {
          case 1:
            return 'Owner';
            break;
          case 2:
            return 'Manager';
            break;
          case 3:
            return 'Sales';
            break;
          default:
            return 'Guest';
            break;
        }
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



      function getImageURL () {
        return '../images-uploading/users-profile/' . $this->image;
      }



    }


 ?>
