<?php

class Info{

  private $cookie_name, $cooki_value;

  public $firstName, $lastName, $email, $phone, $locationID, $membershipID, $plan, $payment_type, $payment_ID;
  //since php is weird and is running into persistence issues, we will return the inf
  //variable with all the information we need
  public $inf;
  public function __construct(){

  }

  public function get_cookie_name(){
    return $cookie_name;
  }

  public function set_cookie_name($val){
    $this->cookie_name = $val;
  }

  public function get_cookie_value(){
    return $cookie_value;
  }

  public function set_cookie_value($val){
    $this->cookie_value = $val;
  }

  public function getFirstName(){
    return $firstName;
  }

  public function grab_info_from_db(){
    try{
      $db = MysqliDb::getInstance();
      $db->where('account_username', $this->cookie_value);
      $results = $db->get('customer')[0];

      $inf['first_name'] = $results['first_name'];
      $inf['last_name'] = $results['last_name'];
      $inf['email'] = $results['email'];
      $inf['phone'] = $results['phone'];
      $inf['location_ID'] = $results['location_ID'];
      $inf['membership_ID'] = $results['membership_ID'];

      $db->where('membership_ID', $inf['membership_ID']);
      $results = $db->get('membership')[0];

      $inf['payment_ID'] = $results['payment_ID'];
      $inf['plan'] = $results['plan'];

      $db->where('payment_ID', $inf['payment_ID']);
      $results = $db->get('payment')[0];

      $inf['payment_type'] = $results['payment_type'];
      $inf['card_number'] = $results['card_number'];

      $db->where('location_ID', $inf['location_ID']);
      $results = $db->get('location')[0];

      $inf['city'] = $results['city'];
      $inf['state'] = $results['state'];

      // echo 'results : ' . var_dump($results);
    } catch (Exception $e){
      echo "There was an exception in the INFO class in the grab_info_from_db method.  Error was : " . $e;
    }

    return $inf;
  }

  public static function send_forgot_username($username, $email, $firstName, $lastName){
    $mailTo = $email;
    $subject = "Forgotten Username - Ever Health";
    $message = "Dear " . $firstName . ' ' . $lastName . ",\r\n\r\nThe username associated with this email is : " . $username . "\r\n\r\nThis is an automated message.\r\nThank you for choosing Ever Health.";

    $headers = 'From: everhealth@everhealth.com' . "\r\n";

    // $subject = "?UTF-8?B?".base64_encode($subject)."?=";

    if(mail($mailTo, $subject, $message, $headers)){
      echo "message sent successfully!";
      return true;
    } else {
      echo "Well your shit out of luck!";
      return false;
    }
  }

  public static function send_forgot_password($username, $email, $firstName, $lastName){

    $password = Database::get_user_pass($username);

    $mailTo = $email;
    $subject = "Forgotten Password - Ever Health";
    $message = "Dear " . $firstName . ' ' . $lastName . ",\r\n\r\nThe password associated with this email is : " . $password . "\r\n\r\nThis is an automated message.\r\nThank you for choosing Ever Health.";

    $headers = 'From: everhealth@everhealth.com' . "\r\n";

    // $subject = "?UTF-8?B?".base64_encode($subject)."?=";

    if(mail($mailTo, $subject, $message, $headers)){
      echo "message sent successfully!";
      return true;
    } else {
      echo "Well your shit out of luck!";
      return false;
    }
  }

  // helper functions
  public static function int_to_phone($data){
    return "(".substr($data, 0, 3).") ".substr($data, 3, 3)."-".substr($data,6);
  }

  public static function int_to_credit_card($data){
    return "**** **** ****" . substr($data, 12, 14);
  }

  public static function validate_password($password){
    $valid = false;
    $digitCharacterLengthCheck = '((?=.*\d)(?=.*[a-zA-Z]).{6,20})';
    $specialCharCheck = '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/';
    $matches = preg_match($digitCharacterLengthCheck, $password);
    if($matches > 0){
      $matches = preg_match($specialCharCheck, $password);
      if($matches == 0){
        $valid = true;
      }
    }
    return $valid;
  }
}

 ?>
