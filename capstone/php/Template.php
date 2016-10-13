<?php
include 'php/DataBase.php';
include 'php/Header.php';
include 'php/Info.php';
include 'php/FloatingNav.php';
include 'php/Masthead.php';
include 'php/NavBar.php';
include 'php/MainContent.php';
include 'php/Footer.php';

class Template{



  public $header, $mast, $footer, $floatingNav, $navBar, $mainContent;
  private $db, $page, $cookie, $request_method, $info, $inf;

  function __construct($__page){

    require_once "vendor/autoload.php";

    error_reporting(0);

    $this->init_db();
    $this->page = $__page;
    $this->info = new Info();
    if(isset($_COOKIE['account_username'])){
      //grab whatever info we will need on the page
      $this->info->set_cookie_name("account_username");
      $this->info->set_cookie_value($_COOKIE['account_username']);
      $inf = $this->info->grab_info_from_db();
    } else {
      $inf = 'nothing';
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->on_POST();
    } else {

      $header = new Header($this->page, $inf);
      // echo the wrapper
      echo "<body>";
      echo "<div id='wrapper'>";
      $floatingNav = new FloatingNav($this->page, $inf);
      $mast = new Masthead($this->page, $inf);
      $navBar = new NavBar($this->page, $inf);
      $mainContent = new MainContent($this->page, $inf);
      echo "</div>";
      $footer = new Footer($this->page, $inf);
    }
  }

  function init_db(){
    $this->db = new DataBase();
  }

  function on_POST(){
    switch ($this->page) {
      case 'create-acct':
        $this->createAcct_POST();
        break;
      case 'create-acct-step2':
        $this->createAcct2_POST();
        break;
      case 'create-acct-step3':
        $this->createAcct3_POST();
        break;
      case 'sign-in':
        $this->signIn_POST();
        break;
      case 'change-pass':
        $this->changePass_POST();
        break;
      case 'change-profile-pic':
        $this->changeProfilePic_POST();
        break;
    }

  }

  function createAcct_POST(){
    //checking for actual values
    $username = null; $password = null; $verifyPassword = null;
    if(isset($_POST['username'])){
      $username = $_POST['username'];
    }
    if(isset($_POST['password'])){
      $password = $_POST['password'];
    }
    if(isset($_POST['verifyPassword'])){
      $verifyPassword = $_POST['verifyPassword'];
    }
    if(is_null($username)  || is_null($password) || is_null($verifyPassword)){
      header('Location: create-acct.php?check-creds=true');
    }
    //validation
    if($username == " Username" || $password == ' Password' || $verifyPassword == ' Verify Password'){
      header('Location: create-acct.php?defaultsUsed=true');
    }else if(!Info::validate_password($password)){
      header('Location: create-acct.php?passwordLengthError=true');
    }else if($password != $verifyPassword){
      header('Location: create-acct.php?passwordMistMatch=true');
    } else if($this->db->check_for_user($username)){
      header('Location: create-acct.php?usernameTaken=true');
    } else {
      if($this->db->create_acct($username, $password)){
        setcookie('account_username', $username, time() + 63072000);
        header('Location: create-acct-step2.php');
      } else {
        header('Location: create-acct.php?unkownError=true');
      }

    }
  }

  function createAcct2_POST(){
    $title = null; $firstName = null; $lastName = null; $gender = null; $phone = null; $email = null; $location = null;
    if(isset($_POST['title'])){
      $title = $_POST['title'];
    }
    if(isset($_POST['firstName'])){
      $firstName = $_POST['firstName'];
    }
    if(isset($_POST['lastName'])){
      $lastName = $_POST['lastName'];
    }
    if(isset($_POST['gender'])){
      $gender = $_POST['gender'];
    }
    if(isset($_POST['phone'])){
      $phone = $_POST['phone'];
    }
    if(isset($_POST['email'])){
      $email = $_POST['email'];
    }
    if(isset($_POST['location'])){
      $location = $_POST['location'];
    }
    if($title == "default" || $gender == "default" || $location =="default" || is_null($title) || is_null($firstName) || is_null($lastName) || is_null($gender) || is_null($phone) || is_null($email) || is_null($location)){
      header('Location: create-acct-step2.php?needMoreInfo=true');
      // echo "Title : " . $title . " first : " . $firstName . " last : " .$lastName." gender : ".$gender." phone : ".$phone." email : ".$email." location : ".$location;
    } else {
      $info = Array(
        "account_username" => $_COOKIE['account_username'],
        "title" => $title,
        "first_name" => $firstName,
        "last_name" => $lastName,
        "gender" => $gender,
        "phone" => $phone,
        "email" => $email,
        "location_ID" => $location
      );
      if($this->db::add_account_info($info)){
        header('Location: create-acct-step3.php');
      }
    }

  }

  function createAcct3_POST(){
    $cardHolder = null; $cardNumber = null; $expireMonth = null; $expireYear = null; $cvv = null;
    if(isset($_POST['cardHolder'])){
      $cardHolder = $_POST['cardHolder'];
    }
    if(isset($_POST['cardNumber'])){
      $cardNumber = $_POST['cardNumber'];
    }
    if(isset($_POST['expire-month'])){
      $expireMonth = $_POST['expire-month'];
    }
    if(isset($_POST['expire-year'])){
      $expireYear = $_POST['expire-year'];
    }
    if(isset($_POST['cvv'])){
      $cvv = $_POST['cvv'];
    }
    //need more validation here
    if(is_null($cardNumber) || is_null($cardHolder) || is_null($expireMonth) || is_null($expireYear) || is_null($cvv) || $expireMonth == "Expire Month"){
      header('Location: create-acct-step3.php?needMoreInfo=true');
    } else {
      //check that we are getting the correct values from the select please!!!!!!!!!!!!1111 :D
      $expireDate = date("Y-m-d H:i:s", strtotime($expireMonth.$expireYear));
      $info = Array(
        "account_username" => $_COOKIE['account_username'],
        "card_number" => $cardNumber,
        "expiration_date" => $expireDate,
        "cvv" => $cvv,
        "card_holder" => $cardHolder
      );
      if($this->db::add_payment_info($info)){
        header('Location: my-acct.php');
      }
    }
  }

  function signIn_POST(){
    $username;
    $password;
    if(isset($_POST['username'])){
    $username = $_POST['username'];
    }
    if(isset($_POST['password'])){
      $password = $_POST['password'];
    }
    if(is_null($username)  && is_null($password)){
      echo "Please check your log in credintials";
    } else {
      if($this->db->check_user_creds($username, $password)){\
        //set cookie
        setcookie('account_username', $_POST['username'], time() + 63072000);
        header('Location: my-acct.php');
      } else {
        //redirect back to sign in with error message
        header('Location: sign-in.php?failed-login=true');
      }
    }
  }

  function changePass_POST(){

  }

  function changeProfilePic_POST(){

  }

  function handle_POST(){
  }
}
?>
