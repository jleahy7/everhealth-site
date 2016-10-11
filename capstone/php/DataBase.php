<?php

class DataBase{

    private $db;

    public function __construct(){
      $this->db = new MysqliDb ('54.175.138.79', 'jimmy-2', 'cscccapstone', 'everhealth');
    }

    public function grab_db() {
        // obtain db object created in init  ()
        $db = MysqliDb::getInstance();

    }

    public function check_user_creds($username, $password){
      $successful_login = false;
      $this->db->where('account_username', $username);
      $results = $this->db->get('accounts');
      if(isset($results[0]['account_password'])  && $results[0]['account_password'] == $password){
        $successful_login = true;
      }
      return $successful_login;
    }
}

?>
