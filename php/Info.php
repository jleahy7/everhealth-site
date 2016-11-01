<?php

class Info{

  private $cookie_name, $cooki_value;
  public $theMonths = Array("0", "Jan", "Feb", "Mar", "Apr", "May", "June", "Aug", "Sep", "Oct", "Nov", "Dec");
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
      $inf['title'] = $results['title'];
      $inf['gender'] = $results['gender'];
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

  public static function int_to_phone_fancy($phone){
    return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone). "\n";;
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

  public static function validate_credit_card($cc, $extra_check = false){
    $cards = array(
        "visa" => "(4\d{12}(?:\d{3})?)",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
    );
    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
    $matches = array();
    $pattern = "#^(?:".implode("|", $cards).")$#";
    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
    if($extra_check && $result > 0){
        $result = (validatecard($cc))?1:0;
    }
    return ($result>0)?$names[sizeof($matches)-2]:false;
  }

  public static function get_months(){
    return Array("0", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec");
  }

  public static function get_years(){
    return Array(
    16 => 2016,
    17 => 2017,
    18 => 2018,
    19 => 2019,
    20 => 2020,
    21 => 2021,
    22 => 2022,
    23 => 2023,
    24 => 2024,
    25 => 2025,
    26 => 2026);
  }
}

 ?>
