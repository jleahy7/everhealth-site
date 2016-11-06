<?php
class MainContent{

  public $page, $info;

  public $theMonths;

  public function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;

    echo "<div id='main-content'>";

    switch ($this->page) {
      case 'create-acct':
        $this->createAcct();
        break;
      case 'create-acct-step2':
        $this->createAcct2();
        break;
      case 'create-acct-step3':
        $this->createAcct3();
        break;
      case 'sign-in':
        $this->signIn();
        break;
      case 'change-pass':
        $this->changePass();
        break;
      case 'change-profile-pic':
        $this->changeProfilePic();
        break;
      case 'my-acct':
        $this->myAcct();
        break;
      case 'forgot-password':
        $this->forgotPassword();
        break;
      case 'forgot-username':
        $this->forgotUsername();
        break;
      case 'change-plan':
        $this->changePlan();
        break;
      case 'update-billing-info':
        $this->updateBillingInfo();
        break;
      case 'update-profile':
        $this->updateProfile();
        break;
    }

    echo "</div>";
  }

  function createAcct(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='create-acct-form-title' class='main-content-title'>Create an account</h1>";
    if(isset($_GET['defaultsUsed']) && $_GET['defaultsUsed']){
      echo "<p id='signin-error-p'><srtong>Error: Cannot use the default 'Username'.</strong></p>";
    } else if(isset($_GET['passwordLengthError']) && $_GET['passwordLengthError']){
      echo "<p id='signin-error-p'><srtong>Error: Passwords must be at least 6 characters.  <br>Passwords must also contain only letters and numbers.</strong></p>";
    }else if(isset($_GET['passwordMistMatch']) && $_GET['passwordMistMatch']){
      echo "<p id='signin-error-p'><srtong>Error: Passwords did not match.</strong></p>";
    } else if(isset($_GET['usernameTaken']) && $_GET['usernameTaken']){
      echo "<p id='signin-error-p'><srtong>Error: That username is already taken.</strong></p>";
    } else if(isset($_GET['unkownError']) && $_GET['unkownError']){
      echo "<p id='signin-error-p'><srtong>Error: An unkown error occured.</strong></p>";
    }
    echo "<form id='create-acct-form' method='POST'>";
    echo "<input class='form-input-text text-input-large' type='text' id='username' name='username' value=' Username'>";
    echo "<input class='form-input-text text-input-large' type='text' id='password' name='password' value=' Password'>";
    echo "<input class='form-input-text text-input-large' type='text' id='verifyPassword' name='verifyPassword' value=' Verify Password'>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
  }

  function createAcct2(){
    $locations = DataBase::grab_locations();

    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='create-acct-form-title' class='main-content-title'>Create an account <br> Step 2<br>Additional Information</h1>";
    if(isset($_GET['needMoreInfo']) && $_GET['needMoreInfo']){
      echo "<p id='signin-error-p'><srtong>Error: Please fill out all fields.</strong></p>";
    }
    echo "<form id='create-acct-form' method='POST'>";
    echo "<select id='title-select' class='large-wide' name='title'>";
    echo "<option value='default'>Title</option>";
    echo "<option value='Mr.'>Mr.</option>";
    echo "<option value='Ms.'>Ms.</option>";
    echo "<option value='Mrs.'>Mrs.</option>";
    echo "<option value='Mx.'>Mx.</option>";
    echo "</select>";
    echo "<input class='form-input-text text-input-medium left' type='text' id='firstName' name='firstName' value=' First Name'>";
    echo "<input class='form-input-text text-input-medium right' type='text' id='lastName' name='lastName' value=' Last Name'>";
    echo "<select id='gender-select' class='large-wide' name='gender'>";
    echo "<option value='default'>Gender</option>";
    echo "<option value='M'>Male</option>";
    echo "<option value='F'>Female</option>";
    echo "<option value='Other'>Other</option>";
    echo "</select>";
    echo "<input class='form-input-text text-input-large left' type='tel' id='phone' name='phone' value=' Phone'>";
    echo "<input class='form-input-text text-input-large medium-margin-bottom right' type='text' id='email' name='email' value=' Email i.e. johndoe@gmail.com'>";
    echo "<select id='location-select' class='large-wide' name='location'>";
    echo "<option value='default'>Location</option>";
    foreach ($locations as $key => $value) {
      echo "<option value='" . $value['location_ID'] . "'>" . $value['city'] .", " . $value['state'] ."</option>";
    }
    echo '"hellow"';
    echo "</select>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
  }

  function createAcct3(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='create-acct-form-title' class='main-content-title'>Create an account <br> Step 3 <br> Billing Infomation</h1>";
    if(isset($_GET['needMoreInfo']) && $_GET['needMoreInfo']){
      echo "<p id='signin-error-p'><srtong>Error: Please fill out all fields.</strong></p>";
    }
    echo "<form id='create-acct-form' method='POST'>";
    echo "<input class='form-input-text text-input-large' type='text' id='cardHolder' name='cardHolder' value=' Card Holder'>";
    echo "<input class='form-input-text text-input-large' type='text' id='cardNumber' name='cardNumber' value=' Card Number'>";
    echo "<select  class='credit-info' name='expire-month' id='expire-month'>";
    echo "<option>Expire Month</option>";
    echo "<option value='01'>Jan (01)</option>";
    echo "<option value='02'>Feb (02)</option>";
    echo "<option value='03'>Mar (03)</option>";
    echo "<option value='04'>Apr (04)</option>";
    echo "<option value='05'>May (05)</option>";
    echo "<option value='06'>June (06)</option>";
    echo "<option value='07'>July (07)</option>";
    echo "<option value='08'>Aug (08)</option>";
    echo "<option value='09'>Sep (09)</option>";
    echo "<option value='10'>Oct (10)</option>";
    echo "<option value='11'>Nov (11)</option>";
    echo "<option value='12'>Dec (12)</option>";
    echo "</select>";
    echo "<select class='credit-info'name='expire-year' id='expire-year'>";
    echo "<option value='13'>2013</option>";
    echo "<option value='14'>2014</option>";
    echo "<option value='15'>2015</option>";
    echo "<option value='16'>2016</option>";
    echo "<option value='17'>2017</option>";
    echo "<option value='18'>2018</option>";
    echo "<option value='19'>2019</option>";
    echo "<option value='20'>2020</option>";
    echo "<option value='21'>2021</option>";
    echo "<option value='22'>2022</option>";
    echo "<option value='23'>2023</option>";
    echo "</select>";
    echo "<input class='form-input-text text-input-large' type='text' id='cvv' name='cvv' value=' Card CVV'>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
  }

  function signIn(){

    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='sign-in-form-title' class='main-content-title'>Member Sign In</h1>";
    if(isset($_GET['failed-login']) && $_GET['failed-login']){
      echo "<p id='signin-error-p'><srtong>Error: Username or password is incorrect.</strong></p>";
    }
    echo "<form id='create-acct-form' method='post'>";
    echo "<input class='form-input-text text-input-large' id='username' type='text' name='username' value=' Username'>";
    echo "<a href='forgot-username.php' class='forgot'>Forgot username?</a>";
    echo "<input class='form-input-text text-input-large' id='password' type='text' name='password' value=' Password'>";
    echo "<a href='forgot-password.php' class='forgot'>Forgot password?</a>";
    echo "<br><br>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
    echo "</div>";
  }

  function changePass(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='sign-in-form-title' class='main-content-title'>Change Password</h1>";
    if(isset($_GET['passwordLengthError']) && $_GET['passwordLengthError']){
      echo "<p id='signin-error-p'><srtong>Error: Passwords must be at least 6 characters.  <br>Passwords must also contain only letters and numbers.</strong></p>";
    }
    echo "<form id='create-acct-form' method='POST'>";
    echo "<input class='form-input-text text-input-large' type='text' name='currentPassword' value=' Current Password'>";
    echo "<input class='form-input-text text-input-large' type='password' name='newPassword' value=' New Password'>";
    echo "<input class='form-input-text text-input-large' type='password' name='verifyPassword' value=' Verify Password'>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
    echo "</div>";
  }

  function changeProfilePic(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='sign-in-form-title' class='main-content-title'>Change Profile Pic</h1>";
    echo "<div id='left-main'><img src='assets/profile-pic.png'></div>";
    echo "<div id='right-main'>";
    echo "<form id='create-acct-form'>";
    echo "<h1 id='browse' class='form-text medium'>Browse</h1>";
    echo "<input id='profilePicInput' class='form-input-text right file' type='file' name='profilePicInput' value=' Browse'>";
    echo "</div>";
    echo "<br>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
    echo "</div>";
  }

  function myAcct(){
    $plan = (is_null($this->info['plan'])) ? "bronze" : $this->info['plan'];

    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='my-acct-title' class='main-content-title my-acct'>My Account</h1>";
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='information-h1' class='my-acct'>Information</h1>";
    echo "<div id='left-main'><img src='assets/profile-pic.png'></div>";
    echo "<div id='right-main'>";
    echo "<table id='my-acct-information-table'>";
    echo "<tr>";
    echo "<td class='left-col'><p id='fullName-field' class='information-p'>" . $this->info['first_name'] . " " .$this->info['last_name'] . "</p></td>";
    echo "<td class='right-col information'><a href='update-profile.php'><img class='edit-icon' src='assets/edit-white.svg'></a></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td  class='left-col'><p id='email-field' class='information-p'>" . $this->info['email'] . "</p></td>";
    echo "<td class='right-col information'><a href='update-profile.php'><img class='edit-icon' src='assets/edit-white.svg'></a></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='left-col'><p id='phone-field' class='information-p'>" . Info::int_to_phone_fancy($this->info['phone']) . "</p></td>";
    echo "<td class='right-col information'><a href='update-profile.php'><img class='edit-icon' src='assets/edit-white.svg'></a></td>";
    echo "</tr>";
    echo "</table>";
    echo "<a href='update-profile.php'><h1 class='my-acct-change-pass same-line' id='changePass'>Update Information</h1></a>";
    echo "<h1 class='my-acct-billing-links same-line'>  |  </h1>";
    echo "<a href='change-pass.php'><h1 class='my-acct-change-pass same-line' id='changePass'>Change Password</h1></a>";
    echo "</div>";
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='information-h1' class='my-acct'>Membership and Billing</h1>";
    echo "<div id='left-main'><img id='mast-logo' src='assets/" . $plan . "-plan.svg'></div>";
    echo "<div id='right-main'>";
    echo "<table id='my-acct-billing-table'>";
    echo "<tr>";
    echo "<td><p class='billing-table'>Location :</p><td><td><p class='billing-table'>" . $this->info['city'] . ", " . $this->info['state'] . "</p><td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><p class='billing-table'>Plan :</p><td><td><p class='billing-table'>" . $plan . "</p><td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><p class='billing-table'>Payment :</p><td><td><p class='billing-table'>" . $this->info['payment_type'] . " " . Info::int_to_credit_card($this->info['card_number']) . "</p><td>";
    echo "</tr>";
    echo "</table>";
    echo "<a href='update-billing-info.php'><h1 class='my-acct-billing-links' id='updateBillingInfoLink'>Update Billing Info</h1></a>";
    echo "<a href='change-plan.php'><h1 class='my-acct-billing-links same-line' id='changePlanLink'>Change Plan</h1></a>";
    echo "<h1 class='my-acct-billing-links same-line'>  |  </h1>";
    echo "<a onclick='confirmAction(" . '"cancel-plan"' . ")'><h1 class='my-acct-billing-links same-line' id='cancelMembershipLink'>Cancel Membership</h1></a>";
    echo "</div>";
  }

  function forgotUsername(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='sign-in-form-title' class='main-content-title'>Forgot Username</h1>";
    if(isset($_GET['unkownEmail']) && $_GET['unkownEmail']){
      echo "<p id='signin-error-p'><srtong>Error: There was no account found with that username.</strong></p>";
    } else if(isset($_GET['errorOccurred']) && $_GET['errorOccurred']){
      echo "<p id='signin-error-p'><srtong>Error: An unknown error has occured. Please try again later.</p>";
    }
    echo "<p class='main-content-detail-p'>Please enter your account email and an email containing your account username will be sent to your email.</p>";
    echo "<form id='create-acct-form' method='POST'>";
    echo "<input class='form-input-text text-input-large' type='text' name='email' value=' Account Email'>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
    echo "</div>";
  }

  function forgotPassword(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='sign-in-form-title' class='main-content-title'>Forgot Password</h1>";
    if(isset($_GET['unkownEmail']) && $_GET['unkownEmail']){
      echo "<p id='signin-error-p'><srtong>Error: There was no account found with that username.</p>";
    } else if(isset($_GET['errorOccurred']) && $_GET['errorOccurred']){
      echo "<p id='signin-error-p'><srtong>Error: An unknown error has occured. Please try again later.</p>";
    }
    echo "<p class='main-content-detail-p'>Please enter your account email and an email containing your password will be sent to your email.</p>";
    echo "<form id='create-acct-form' method='POST'>";
    echo "<input class='form-input-text text-input-large' type='text' name='email' value=' Account Email'>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
    echo "</div>";
  }

  function changePlan(){
    $plan = (is_null($this->info['plan']))? "bronze" : $this->info['plan'];

      echo "<div id='main-content-br' class='break-div'></div>";
      echo "<h1 id='create-acct-form-title' class='main-content-title'>Change Membership Plan</h1>";
      echo "<br>";
      if($plan == "gold"){
        echo "<div id='gold' class='change-plan selected-plan'>";
      } else {
        echo "<div id='gold' class='change-plan'>";
      }
        echo "<div id='left-main'><img id='mast-logo' class='plan-medal' src='assets/gold-plan.svg'></div>";
        echo "<div id='right-main'>";
          echo "<table class='change-plan-table' id='gold-table'>";
            echo "<tr>";
              echo "<td class='table-left-col'><p class='plan-title'>Gold</p></td>";
              echo "<td class='table-right-col change-plan-table'></td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td class='table-left-col change-plan-table'>Benefits: </td>";
              echo "<td class='table-right-col change-plan-table'> - Unlimited gym access</td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td class='table-left-col change-plan-table'></td>";
              echo "<td class='table-right-col change-plan-table'>- Personal Training</td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td class='table-left-col change-plan-table'></td>";
              echo "<td class='table-right-col change-plan-table'>- Unlimited gym access</td>";
            echo "</tr>";
          echo "</table>";
        echo "</div>";
      echo "</div>";
      if($plan == "silver"){
        echo "<div id='silver' class='change-plan selected-plan'>";
      } else {
        echo "<div id='silver' class='change-plan'>";
      }
        echo "<div id='left-main'><img id='mast-logo' class='plan-medal' src='assets/silver-plan.svg'></div>";
        echo "<div id='right-main'>";
          echo "<table class='change-plan-table' id='silver-table'>";
            echo "<tr>";
              echo "<td class='table-left-col'><p class='plan-title'>Silver</p></td>";
              echo "<td class='table-right-col change-plan-table'></td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td class='table-left-col change-plan-table'>Benefits: </td>";
              echo "<td class='table-right-col change-plan-table'> - Unlimited gym access</td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td class='table-left-col change-plan-table'></td>";
              echo "<td class='table-right-col change-plan-table'>- Tanning bed access</td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td class='table-left-col change-plan-table'></td>";
              echo "<td class='table-right-col change-plan-table'>- 1 guest per visit</td>";
            echo "</tr>";
          echo "</table>";
        echo "</div>";
      echo "</div>";
      if($plan == "bronze"){
        echo "<div id='bronze' class='change-plan selected-plan'>";
      } else {
        echo "<div id='bronze' class='change-plan'>";
      }
        echo "<div id='left-main'><img id='mast-logo' class='plan-medal' src='assets/bronze-plan.svg'></div>";
        echo "<div id='right-main'>";
          echo "<table class='change-plan-table' id='bronze-table'>";
          echo "<tr>";
            echo "<td class='table-left-col'><p class='plan-title'>Bronze</p></td>";
            echo "<td class='table-right-col change-plan-table'></td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td class='table-left-col change-plan-table'>Benefits: </td>";
            echo "<td class='table-right-col change-plan-table'> - Unlimited gym access</td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td class='table-left-col change-plan-table'></td>";
            echo "<td class='table-right-col change-plan-table'></td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td class='table-left-col change-plan-table'></td>";
            echo "<td class='table-right-col change-plan-table'></td>";
          echo "</tr>";
        echo "</table>";
      echo "</div>";
      echo "</div>";
      echo "<form id='change-plan-form' method='POST'>";
        echo "<input type='hidden' name='chosen-plan' id='chosen-plan' value='bronze'>";
        echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
        echo "<input class='form-input-text text-input-medium right' id='reset-change-plan' type='reset' name='cancel' value=' Cancel'>";
      echo "</form>";
      echo "<br>";
    }

    function updateBillingInfo(){
      // echo 'info were werkin with : ' . var_dump($this->info);

      // echo var_dump(Info::get_months());
      $billInfo; $month; $year; $cvv;
      if(isset($this->info['payment_ID'])){
        $billInfo = DataBase::get_billing_info($this->info['payment_ID'])[0];
        if($billInfo){
          $cvv = $billInfo['cvv'];
          $month = date_parse_from_format("Y-m-d", $billInfo['expiration_date'])["month"];
          $year = date_parse_from_format("Y-m-d", $billInfo['expiration_date'])["year"];
        }
      }
      echo "<div id='main-content-br' class='break-div'></div>";
      echo "<h1 id='create-acct-form-title' class='main-content-title'>Update Billing Infomation</h1>";
      if(isset($_GET['needMoreInfo']) && $_GET['needMoreInfo']){
        echo "<p id='signin-error-p'><srtong>Error: Please fill out all fields.</strong></p>";
      } else if(isset($_GET['invalidCard']) && $_GET['invalidCard']){
        echo "<p id='signin-error-p'><srtong>Error: Please provide a valid credit card.</strong></p>";
      } else if(isset($_GET['databaseError']) && $_GET['databaseError']){
        echo "<p id='signin-error-p'><srtong>Error: An unknown database error has occured. Please try again later.</strong></p>";
      }
      echo "<form id='create-acct-form' method='POST'>";
      echo "<input class='form-input-text text-input-large' type='text' id='cardHolder' name='cardHolder' value='" . $billInfo['card_holder'] . "'>";
      echo "<input class='form-input-text text-input-large' type='text' id='cardNumber' name='cardNumber' value='" . $billInfo['card_number'] . "'>";
      echo "<select  class='credit-info' name='expire-month' id='expire-month'>";
      echo "<option>Expire Month</option>";
      foreach (Info::get_months() as $key => $value) {
        if($key != 0){
          if($key == $month){
            if($key == '011' || $key == '012' || $key == '010'){
              $tt = "<option value='" . $key . "' selected='selected'>" . $value . " (" . $key . ")</option>";
            } else {
              $tt = "<option value='0" . $key . "' selected='selected'>" . $value . " (0" . $key . ")</option>";
            }

          } else {
            if($key == '011' || $key == '012' || $key == '010'){
              $tt = "<option value='" . $key . "'>" . $value . " (" . $key . ")</option>";
            } else {
              $tt = "<option value='0" . $key . "'>" . $value . " (0" . $key . ")</option>";
            }

          }
          echo $tt;
        }
      }
      echo "</select>";
      echo "<select class='credit-info'name='expire-year' id='expire-year'>";
      foreach (Info::get_years() as $key => $value) {
        if($key != 0){
          if($key == $month){
            $tt = "<option value='" . $value . "' selected='selected'>" . $value . " (" . $key . ")</option>";
          } else {
            $tt = "<option value='" . $value . "'>" . $value . " (" . $key . ")</option>";
          }
          echo $tt;
        }
      }
      echo "</select>";
      echo "<input class='form-input-text text-input-large' type='text' id='cvv' name='cvv' value='" . $cvv . "'>";
      echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
      echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
      echo "</form>";
    }

    function updateProfile(){
      $locations = DataBase::grab_locations();
      $firstName; $lastName; $title; $gender; $phone; $email; $location;
      $INF = $this->info;

      echo "<div id='main-content-br' class='break-div'></div>";
      echo "<h1 id='create-acct-form-title' class='main-content-title'>Update Account Information</h1>";
      if(isset($_GET['needMoreInfo']) && $_GET['needMoreInfo']){
        echo "<p id='signin-error-p'><srtong>Error: Please fill out all fields.</strong></p>";
      }
      echo "<form id='create-acct-form' method='POST'>";
      echo "<select id='title-select' class='large-wide' name='title'>";
      echo "<option value='title'>Title</option>";
      if(!isset($INF['title'])){
        echo "<option value='default'>Title</option>";
      } else {
        echo "<option value='" . $INF['title'] . "' selected>" . $INF['title'] . "</option>";
      }
      echo "<option value='Mr.'>Mr.</option>";
      echo "<option value='Ms.'>Ms.</option>";
      echo "<option value='Mrs.'>Mrs.</option>";
      echo "<option value='Mx.'>Mx.</option>";
      echo "</select>";
      if(!isset($INF['first_name'])){
        echo "<input class='form-input-text text-input-medium left' type='text' id='firstName' name='firstName' value=' First Name'>";
      } else {
        echo "<input class='form-input-text text-input-medium left' type='text' id='firstName' name='firstName' value='" . $INF['first_name'] . "'>";
      }
      if(!isset($INF['first_name'])){
        echo "<input class='form-input-text text-input-medium right' type='text' id='lastName' name='lastName' value=' Last Name'>";
      } else {
        echo "<input class='form-input-text text-input-medium right' type='text' id='lastName' name='lastName' value='" . $INF['last_name'] . "'>";
      }

      echo "<select id='gender-select' class='large-wide' name='gender'>";
      echo "<option value='default'>Gender</option>";
      switch($INF['gender']){
        case 'M':
          echo "<option value='M' selected>Male</option>";
          echo "<option value='F'>Female</option>";
          echo "<option value='Other'>Other</option>";
          break;
        case 'F':
          echo "<option value='M'>Male</option>";
          echo "<option value='F' selected>Female</option>";
          echo "<option value='Other'>Other</option>";
          break;
        case 'Other':
          echo "<option value='M'>Male</option>";
          echo "<option value='F'>Female</option>";
          echo "<option value='Other' selected>Other</option>";
          break;
      }
      echo "</select>";
      if(!isset($INF['phone'])){
        echo "<input class='form-input-text text-input-large left' type='tel' id='phone' name='phone' value=' Phone'>";
      } else {
        echo "<input class='form-input-text text-input-large left' type='tel' id='phone' name='phone' value='" . Info::int_to_phone_fancy($INF['phone']) . "'>";
      }
      if(!isset($INF['email'])){
        echo "<input class='form-input-text text-input-large medium-margin-bottom right' type='text' id='email' name='email' value=' Email i.e. johndoe@gmail.com'>";
      } else {
        echo "<input class='form-input-text text-input-large medium-margin-bottom right' type='text' id='email' name='email' value='" . $INF['email'] . "'>";
      }
      echo "<select id='location-select' class='large-wide' name='location'>";
      echo "<option value='default'>Location</option>";
      foreach ($locations as $key => $value) {
        if($value['location_ID'] == $INF['location_ID']){
          echo "<option value='" . $value['location_ID'] . "' selected>" . $value['city'] .", " . $value['state'] ."</option>";
        } else {
          echo "<option value='" . $value['location_ID'] . "'>" . $value['city'] .", " . $value['state'] ."</option>";
        }

      }
      echo "</select>";
      echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
      echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
      echo "</form>";
    }
} ?>
