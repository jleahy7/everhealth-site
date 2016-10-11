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
    $db = MysqliDb::getInstance();
    $db->where('account_username', $this->cookie_value);
    $results = $db->get('customer');

    $inf['first_name'] = $results[0]['first_name'];
    $inf['last_name'] = $results[0]['last_name'];
    $inf['email'] = $results[0]['email'];
    $inf['phone'] = $results[0]['phone'];
    $inf['location_ID'] = $results[0]['location_ID'];
    $inf['membership_ID'] = $results[0]['membership_ID'];

    return $inf;
  }
}

 ?>
