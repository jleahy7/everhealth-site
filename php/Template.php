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

  // need to refine


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
      // echo 'got the info : ' . var_dump($inf);
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
      case 'forgot-username':
        $this->forgotUsername_POST();
        break;
      case 'forgot-password':
        $this->forgotPassword_POST();
        break;
      case 'change-plan':
        $this->changePlan_POST();
        break;
      case 'update-billing-info':
        $this->updateBillingInfo_POST();
        break;
      case 'update-profile':
        $this->updateProfile_POST();
        break;
    }

  }

  function createAcct_POST(){
    //checking for actual values
    $username = null; $password = null; $verifyPassword = null; $planType = null;
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
      Info::check_plan();
      header("Location: create-acct.php?defaultsUsed=true&plan=" . $_POST['chosen-plan']);
      exit();
    }else if(!Info::validate_password($password)){
      Info::check_plan();
      header("Location: create-acct.php?passwordLengthError=true&plan=" . $_POST['chosen-plan']);
      exit();
    }else if($password != $verifyPassword){
      Info::check_plan();
      header("Location: create-acct.php?passwordMistMatch=true&plan=" . $_POST['chosen-plan']);
      exit();
    } else if($this->db->check_for_user($username)){
      Info::check_plan();
      header("Location: create-acct.php?usernameTaken=true&plan=" . $_POST['chosen-plan']);
      exit();
    } else {
      if($this->db->create_acct($username, $password)){
        Info::check_plan();
        setcookie('account_username', $username, time() + 63072000);
        header("Location: create-acct-step2.php?plan=" . $_POST['chosen-plan']);
        exit();
      } else {
        Info::check_plan();
        header("Location: create-acct.php?unkownError=true&plan=" . $_POST['chosen-plan']);
        exit();
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
    //phone validation here
     if($location =="default" || is_null($firstName) || is_null($lastName) || is_null($phone) || is_null($email) || is_null($location)){
      header('Location: create-acct-step2.php?needMoreInfo=true');
      // echo "Title : " . $title . " first : " . $firstName . " last : " .$lastName." gender : ".$gender." phone : ".$phone." email : ".$email." location : ".$location;
    } else if(!Info::validateEmail($email)){
      header('Location: create-acct-step2.php?invalidEmail=true');
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
        setcookie('chosen-plan', $_POST['chosen-plan'], time() + 63072000);
        header('Location: create-acct-step3.php?' . $_COOKIE['chosen-plan']);
      }
    }

  }

  function createAcct3_POST(){
    $cardHolder = null; $cardNumber = null; $expireMonth = null; $expireYear = null; $cvv = null; $account_type;
    if(isset($_POST['cardHolder'])){
      $cardHolder = $_POST['cardHolder'];
    }
    if(isset($_POST['cardNumber'])){
      $cardNumber = str_replace(' ', '', $_POST['cardNumber']);
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
    if(isset($_POST['account_type'])){
      $account_type = $_POST['account_type'];
    }
    //need more validation here
    if(is_null($cardNumber) || is_null($cardHolder) || is_null($expireMonth) || is_null($expireYear) || is_null($cvv) || $expireMonth == "Expire Month"){
      header('Location: create-acct-step3.php?needMoreInfo=true&plan=' . $_COOKIE['chosen-plan']);
    }
    if(!Info::validate_credit_card($_POST['cardNumber'])){
      header('Location: create-acct-step3.php?invalidCard=true&plan=' . $_COOKIE['chosen-plan']);
    } else if(!Info::validateCVV($cvv)){
      header('Location: create-acct-step3.php?invalidCvv=true&plan=' . $_COOKIE['chosen-plan']);
    }else {
      // check that we are getting the correct values from the select please!!!!!!!!!!!!1111 :D
      $expireDate = date("Y-m-d H:i:s", strtotime($expireMonth.$expireYear));
      $info = Array(
        "account_username" => $_COOKIE['account_username'],
        "account_type" => $_POST['account_type'],
        "card_number" => $cardNumber,
        "expiration_date" => $expireDate,
        "cvv" => $cvv,
        "card_holder" => $cardHolder
      );
      // add the payment information
      $addPaymentResult = $this->db::add_payment_info($info);
      if($addPaymentResult){
        // add a membership row
        $results = $this->db::add_membership($addPaymentResult);
        if($results){
          //here results represents if the membership was added successfully and the membership_ID
          //associate membership ID with the customer table
          $results = $this->db::tie_membership_to_customer($_COOKIE['account_username'], $results);
          // echo 'tie results were : ' . var_dump($results);
          if($results){
            $address = Array(
              "address" => $_POST['address'],
              "address2" => $_POST['address2'],
              "city" => $_POST['city'],
              "state" => $_POST['state'],
              "zip" => $_POST['zip'],
            );
            $results = $this->db::tie_address_to_customer($_COOKIE['account_username'], $address);
            if($results){
              header('Location: my-acct.php');
            }
          }
        }
      }
    }
  }

  function signIn_POST(){
    if(isset($_COOKIE["locked-sign-in"]) && $_COOKIE["locked-sign-in"] == true){
      header("Location: sign-in.php?locked-out=true");
    } else {
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
        if($this->db->check_user_creds($username, $password)){
          //set cookie
          setcookie('failed_attempts', '', time()-100);
          setcookie('chosen-plan', '', time()-100);
          setcookie('account_username', $_POST['username'], time() + 63072000);
          header('Location: my-acct.php');
        } else {

          if(!isset($_COOKIE["failed_attempts"])){
            setcookie("failed_attempts", 2);
            header('Location: sign-in.php?failed-login=true');
          } else {
            $val = $_COOKIE["failed_attempts"];
            $val++;
            echo "val = " . $val;
            echo "Max login attempts : " . $this->info->MAX_LOGIN_ATTEMPTS;
            if($val >= $this->info->MAX_LOGIN_ATTEMPTS){
              //set a minute timer
              $expireTime = time() + 60 * $this->info->LOGIN_LOCK_TIME;
              setcookie("lock-expire", $expireTime, $expireTime);
              setcookie("locked-sign-in", true, $expireTime);
              header("Location: sign-in.php?locked-out=true");
            }
            setcookie("failed_attempts", $val);

          }
          //redirect back to sign in with error message
          header('Location: sign-in.php?failed-login=true');
        }
      }
    }
  }

  function changePass_POST(){
    $username = null; $password = null; $newPass = null; $verifyNewPass = null;
    if(isset($_COOKIE['account_username'])){
      $username = $_COOKIE['account_username'];
    }
    if(isset($_POST['currentPassword'])){
      $password = $_POST['currentPassword'];
    }
    if(isset($_POST['newPassword'])){
      $newPass = $_POST['newPassword'];
    }
    if(isset($_POST['verifyPassword'])){
      $verifyNewPass = $_POST['verifyPassword'];
    }
    if(is_null($username) || is_null($password) || is_null($newPass) || is_null($verifyNewPass)){
      echo "Please check your log in credintials";
    } else if(!Info::validate_password($newPass)){
      header('Location: change-pass.php?passwordLengthError=true');
    } else if(!$this->db->check_user_creds($username, $password)){
      header('Location: change-pass.php?passwordMistMatch=true');
    } else {
      if(DataBase::change_acct_pass($username, $newPass)){
        //set cookie
        // setcookie('account_username', $_POST['username'], time() + 63072000);
        header('Location: my-acct.php?alert=change-pass-success');
      } else {
        //redirect back to sign in with error message
        header('Location: change-pass.php?errorOccurred=true');
      }
    }
  }

  function changeProfilePic_POST(){

  }

  function forgotUsername_POST(){
    $accountEmail = null;
    if(isset($_POST['email'])){
      $accountEmail = $_POST['email'];
    }
    if(is_null($accountEmail)){
      echo "Please enter a vaild email address";
    } else{
      $results = DataBase::check_for_email($accountEmail);
      if(!$results){
        header('Location: forgot-username.php?unkownEmail=true');
      } else {
        if(Info::send_forgot_username($results['account_username'], $accountEmail, $results['first_name'], $results['last_name'])){
          header('Location: sign-in.php');
        } else {
          header('Location: forgot-username.php?errorOccurred=true');
        }
      }
    }
  }

  function forgotPassword_POST(){
    $accountEmail = null;
    if(isset($_POST['email'])){
      $accountEmail = $_POST['email'];
    }
    if(is_null($accountEmail)){
      echo "Please enter a vaild email address";
    } else{
      $results = DataBase::check_for_email($accountEmail);
      if(!$results){
        header('Location: forgot-password.php?unkownEmail=true');
      } else {
        if(Info::send_forgot_password($results['account_username'], $accountEmail, $results['first_name'], $results['last_name'])){
          header('Location: sign-in.php');
        } else {
          header('Location: forgot-password.php?errorOccurred=true');
        }
      }
    }
  }

  function changePlan_POST(){
      if(DataBase::change_acct_plan($_COOKIE['account_username'], $_POST['chosen-plan'])){
        header('Location: my-acct.php?alert=change_plan_success');
      }
  }

  function updateBillingInfo_POST(){
    $ccCheck = Info::validate_credit_card($_POST['cardNumber']);
    echo 'cccheck : ' . var_dump($ccCheck);
    if($ccCheck){
      if(!Info::validateCVV($_POST['cvv'])){
        header('Location: update-billing-info.php?invalidCvv=true');
      } else if(DataBase::change_billing_info($_POST)){
        header('Location: my-acct.php?alert=change_billing_info_success');
      } else {
        header('Location: update-billing-info.php?databaseError=true');
      }
    } else {
      header('Location: update-billing-info.php?invalidCard=true');
    }

  }

  function updateProfile_POST(){
    echo var_dump($_POST);
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
    if($location =="default" || is_null($title) || is_null($firstName) || is_null($lastName) || is_null($gender) || is_null($phone) || is_null($email) || is_null($location)){
      header('Location: update-profile.php?needMoreInfo=true');
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
      if(DataBase::update_acct_info($info)){
        header('Location: my-acct.php?alert=update_profile_success');
      } else {
        header('Location: my-acct.php?alert=unkown_error');
      }
    }
  }

  function handle_POST(){
  }
}
?>
