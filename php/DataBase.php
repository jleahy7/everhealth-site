<?php

class DataBase{

    private $db;

    public function __construct(){
      $this->db = new MysqliDb ('54.164.39.175', 'jake', 'cscccapstone', 'everhealth');
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

    public static function check_for_email($email){
      //if email exists, return account_username
      $db = MysqliDb::getInstance();
      $db->where('email', $email);
      $results = $db->get('customer');
      if($results){
        echo 'customer with that email exists!';
        return $results[0];
      } else {
        echo 'no customer with the email ' . $email . ' exists.';
      }
    }

    public static function get_user_pass($username){
      $db = MysqliDb::getInstance();
      $db->where('account_username', $username);
      $results = $db->get('accounts');
      if($results){
        echo 'customer with that email exists!';
        return $results[0]['account_password'];
      }
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
      $plan = (isset($_COOKIE['chosen-plan']))? $_COOKIE['chosen-plan'] : $_POST['chosen-plan'];
      $info = Array(
        "payment_ID" => $paymentID,
        "plan" => $plan,
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
        // echo 'tie method results : ' . var_dump($results);
        $updateInfo = Array('membership_ID' => $membershipID);
        $db->where('account_username', $account_username);
        $db->update('customer', $updateInfo, 1);
      }
      return $results;
    }

    public static function tie_address_to_customer($account_username, $info){
      // echo "using address info : " . var_dump($info);
      $db = MysqliDb::getInstance();
      $results = $db->insert('address', $info);
      if(isset($results)){
        echo 'tying address to : ' . $account_username;
        $db->where('account_username', $account_username);
        $db->update('customer', Array("address_ID" => $results), 1);
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

    public static function change_acct_plan($acct, $newPlan){
      $db = MysqliDb::getInstance();
      $db->where('account_username', $_COOKIE['account_username']);
      $results = $db->get('customer');
      if(isset($results[0])){
        $membershipID = $results[0]['membership_ID'];
        $db->where('membership_ID', $membershipID);
        $results = $db->get('membership');
        if(isset($results[0])){
          echo "results : " . var_dump($results[0]);
          $updateInfo = Array('plan' => $newPlan);
          $db->where('membership_ID', $membershipID);
          echo "update infp : " . var_dump($updateInfo);
          $results = $db->update('membership', $updateInfo, 1);
        }
      }
      return $results;
    }

    public static function change_billing_info($info){
      $db = MysqliDb::getInstance();
      $updateInfo = Array('card_number' => $info['cardNumber'], 'card_holder' => $info['cardHolder'], 'cvv' => $info['cvv'], 'account_type' => $info['account_type']);
      $updateInfo['expiration_date'] = $info['expire-year'] . "-" . $info['expire-month'] . "-01";
      $db->where('account_username', $_COOKIE['account_username']);
      $results = $db->get('payment');
      if(isset($results[0])){
        $paymentID = $results[0]['payment_ID'];
        $db->where('payment_ID', $paymentID);
        $results = $db->update('payment', $updateInfo, 1);
        echo "results: " . var_dump($results);
      }
      return $results;
    }

    public static function update_acct_info($info){
      $db = MysqliDb::getInstance();
      $db->where('account_username', $_COOKIE['account_username']);
      $results = $db->get('customer');
      if(isset($results[0])){
        $db->where('account_username', $_COOKIE['account_username']);
        $results = $db->update('customer', $info, 1);
      }
      return $results;
    }

    public static function get_billing_info($paymentID){
      $db = MysqliDb::getInstance();
      $db->where('payment_ID', $paymentID);
      return $db->get('payment');
    }

}

?>
