<?php

class Info{

  private $cookie_name, $cooki_value;
  public $MAX_LOGIN_ATTEMPTS = 5, $LOGIN_LOCK_TIME = 10;
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
      echo "Message sent successfully!";
      return true;
    } else {
      echo "Message failed to send.";
      return false;
    }
  }

  public static function send_contact_us($name, $email, $message){
    $CONTACT_US_EMAIL = "cscc.capstone.2016@gmail.com";
    $subject = $name . " - Contact Us Message";
    $message = "Message sent via Contact Us page on website: \r\n\r\n Name: " . $name . " \r\n Email: " . $email . " \r\n Message:  " . $message;

    $headers = 'From: ' . $email . "\r\n";

    // $subject = "?UTF-8?B?".base64_encode($subject)."?=";

    // echo "mailto: " . $CONTACT_US_EMAIL;
    // echo "\nheaders: " . $headers;
    // echo "\nsubject: " . $subject;
    // echo "\nmessage: " . $message;

    if(mail($CONTACT_US_EMAIL, $subject, $message, $headers)){
      echo "Message sent successfully!";
      return true;
    } else {
      echo "Message failed to send.";
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
        "discover" => "(6011\d{12}(?:\d{3})?)",
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

  public static function validateEmail($email){
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }

    return true;
  }

  public static function validateCVV($number){
    return preg_match('/^[0-9]{3,4}$/', $number);
  }
  public static function check_plan(){
    if(isset($_POST['chosen-plan'])){
      $planType = $_POST['plan-type'];
      setcookie("chosen-plan", $planType, time() + 63072000);
    }
  }

  public static function get_plans(){
    return Array("gold" => "Gold", "silver" => "Silver", "bronze" => "Bronze", "canceled" => "None");
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

  public static function get_states(){
    return Array(
      'AL'=>'Alabama',
      'AK'=>'Alaska',
      'AZ'=>'Arizona',
      'AR'=>'Arkansas',
      'CA'=>'California',
      'CO'=>'Colorado',
      'CT'=>'Connecticut',
      'DE'=>'Delaware',
      'DC'=>'District of Columbia',
      'FL'=>'Florida',
      'GA'=>'Georgia',
      'HI'=>'Hawaii',
      'ID'=>'Idaho',
      'IL'=>'Illinois',
      'IN'=>'Indiana',
      'IA'=>'Iowa',
      'KS'=>'Kansas',
      'KY'=>'Kentucky',
      'LA'=>'Louisiana',
      'ME'=>'Maine',
      'MD'=>'Maryland',
      'MA'=>'Massachusetts',
      'MI'=>'Michigan',
      'MN'=>'Minnesota',
      'MS'=>'Mississippi',
      'MO'=>'Missouri',
      'MT'=>'Montana',
      'NE'=>'Nebraska',
      'NV'=>'Nevada',
      'NH'=>'New Hampshire',
      'NJ'=>'New Jersey',
      'NM'=>'New Mexico',
      'NY'=>'New York',
      'NC'=>'North Carolina',
      'ND'=>'North Dakota',
      'OH'=>'Ohio',
      'OK'=>'Oklahoma',
      'OR'=>'Oregon',
      'PA'=>'Pennsylvania',
      'RI'=>'Rhode Island',
      'SC'=>'South Carolina',
      'SD'=>'South Dakota',
      'TN'=>'Tennessee',
      'TX'=>'Texas',
      'UT'=>'Utah',
      'VT'=>'Vermont',
      'VA'=>'Virginia',
      'WA'=>'Washington',
      'WV'=>'West Virginia',
      'WI'=>'Wisconsin',
      'WY'=>'Wyoming',
    );
  }
}

 ?>
