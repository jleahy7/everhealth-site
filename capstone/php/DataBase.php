<?php

class DataBase{

    private $db;

    public function __construct(){
      $this->db = new MysqliDb ('54.197.200.133', 'jake', 'cscccapstone', 'everhealth');
    }

    public function grab_db() {
        // obtain db object created in init  ()
        $db = MysqliDb::getInstance();

    }

    public static function grab_locations(){
      $db = MysqliDb::getInstance();
      return $db->get('location');
    }

    public function check_user_creds($username, $password){
      $successful_login = false;
      $this->db->where('account_username', $username);
      $results = $this->db->get('accounts');
      echo var_dump($results);
      if(isset($results[0]['account_password'])  && $results[0]['account_password'] == $password){
        $successful_login = true;
      }
      return $successful_login;
    }

    public function check_for_user($username){
      $userExists =  false;
      $this->db->where('account_username', $username);
      $results = $this->db->get('accounts');
      echo var_dump($results);
      if(isset($results[0])){
        $userExists = true;
        echo 'user exists';
      }
      return $userExists;
    }

    public static function create_acct($username, $password){
      $data = Array(
        "account_username" => $username,
        "account_password" => $password
      );
      $db = MysqliDb::getInstance();
      $result = $db->insert('accounts', $data);
      return $result;
    }

    public static function add_account_info($info){
      $db = MysqliDb::getInstance();
      return $db->insert('customer', $info);
    }

    public static function add_payment_info($info){
      // echo var_dump($info);
      $db = MysqliDb::getInstance();
      return $db->insert('payment', $info);
    }

    public static function add_membership($paymentID){
      $info = Array(
        "payment_ID" => $paymentID,
        "plan" => "bronze",
        "rate" => 10
      );
      $db = MysqliDb::getInstance();
      $results = $db->insert('membership', $info);
      return $results;
    }

    public static function tie_membership_to_customer($account_username, $membershipID){
      $db = MysqliDb::getInstance();
      $db->where('account_username', $account_username);
      $results = $db->get('customer');
      if(isset($results[0])){
        echo 'tie method results : ' . var_dump($results);
        $updateInfo = Array('membership_ID' => $membershipID);
        $db->where('account_username', $account_username);
        $db->update('customer', $updateInfo, 1);
      }
      return $results;
    }

    public static function change_acct_pass($username, $newPassword){
      $db = MysqliDb::getInstance();
      $db->where('account_username', $username);
      $results = $db->get('accounts');
      if(isset($results[0])){
        echo 'tie method results : ' . var_dump($results);
        $updateInfo = Array('account_password' => $newPassword);
        $db->where('account_username', $username);
        $results = $db->update('accounts', $updateInfo, 1);
      }
      return $results;
    }
}

?>
