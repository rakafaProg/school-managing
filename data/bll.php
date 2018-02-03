<?php
    include_once 'dal.php';
    include_once '../models/administrator.php';

    /*
      This class converts MySQL data into the project models (classes)
    */

    class BLL {

        public static function createAdmin($admin) {
          debug($admin);
          $sql =
            'INSERT INTO
            `administrators`
            (`id`, `name`, `role`, `phone`, `email`, `password`, `image`)
            VALUES
            (NULL,
              "'.$admin->getName().'",
              '.$admin->getRole().',
              "'.$admin->getPhone().'",
              "'.$admin->getEmail().'",
              "'.$admin->getPassword().'",
              "'.$admin->getImage().'"
            )';
          debug($sql);

          $result = DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);
          debug('============  Result: =====================');
          debug($result);

          debug('============ End Result: ==================');

        }

        public static function getAllAdmins () {
          $whereSql = "";
          return self::getAdminWhere($whereSql);
        }

        public static function getAdminsByRole ($role) {
          $whereSql = " WHERE `role`>=".$role;
          return self::getAdminWhere($whereSql);
        }

        public static function getAdmin ($email, $password) {
          $whereSql = " WHERE `email`='".$email."' AND `password`='".$password."'";
          return self::getAdminWhere($whereSql);
        }

        private static function getAdminWhere ($whereSql) {
          $sql = 'SELECT * FROM `administrators`'.$whereSql;

          $adminsArray = [];
          foreach (DAL::getInstance($GLOBALS['dbDetails'])->fetch($sql) as $admin) {
            $adminsArray[$admin['id']] = new Administrator($admin);
          }

          return $adminsArray;
        }
    }

    // // test get admin
    // BLL::getAdmin('rakkafa.prog@gmail.com', 'e19d5cd5af0378da05f63f891c7467af');


 ?>
