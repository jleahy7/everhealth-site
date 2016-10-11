<?php
class MainContent{

  public $page;

  public function __construct($_page){
    $this->page = $_page;

    echo "<div id='main-content'>";

    switch ($this->page) {
      case 'create-acct':
        $this->createAcct();
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
    }

    echo "</div>";
  }

  function createAcct(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='create-acct-form-title' class='main-content-title'>Create an account</h1>";
    echo "<form id='create-acct-form'>";
    echo "<input class='form-input-text text-input-medium left' type='text' id='firstName' name='firstName' value=' First Name'>";
    echo "<input class='form-input-text text-input-medium right' type='text' id='lastName' name='lastName' value=' Last Name'>";
    echo "<input class='form-input-text text-input-large' type='text' id='phone' name='phone' value=' Phone'>";
    echo "<input class='form-input-text text-input-large' type='text' id='email' name='email' value=' Email'>";
    echo "<input class='form-input-text text-input-large' type='password' id='password' name='password' value=' Password'>";
    echo "<input class='form-input-text text-input-large' type='password' id='verifyPassword' name='verifyPassword' value=' Verify Password'>";
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
    echo "<input class='form-input-text text-input-large' type='text' name='username' value=' Username'>";
    echo "<input class='form-input-text text-input-large' type='password' name='password' value=' Password'>";
    echo "<input class='form-input-text text-input-medium left' type='submit' name='submit' value=' Submit'>";
    echo "<input class='form-input-text text-input-medium right' type='submit' name='cancel' value=' Cancel'>";
    echo "</form>";
    echo "</div>";
  }

  function changePass(){
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='sign-in-form-title' class='main-content-title'>Change Password</h1>";
    echo "<form id='create-acct-form'>";
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
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='my-acct-title' class='main-content-title my-acct'>My Account</h1>";
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='information-h1' class='my-acct'>Information</h1>";
    echo "<div id='left-main'><img src='assets/profile-pic.png'></div>";
    echo "<div id='right-main'>";
    echo "<table id='my-acct-information-table'>";
    echo "<tr>";
    echo "<td class='left-col'><p id='fullName-field' class='information-p'>John Doe</p></td>";
    echo "<td class='right-col information'><a href='update-profile.php'><img class='edit-icon' src='assets/edit-white.svg'></a></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td  class='left-col'><p id='email-field' class='information-p'>johndoe@gmail.com</p></td>";
    echo "<td class='right-col information'><a href='update-profile.php'><img class='edit-icon' src='assets/edit-white.svg'></a></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='left-col'><p id='phone-field' class='information-p'>(614)123-2342)</p></td>";
    echo "<td class='right-col information'><a href='update-profile.php'><img class='edit-icon' src='assets/edit-white.svg'></a></td>";
    echo "</tr>";
    echo "</table>";
    echo "<a href='change-pass.php'><h1 class='my-acct-change-pass' id='changePass'>Change Password</h1></a>";
    echo "</div>";
    echo "<div id='main-content-br' class='break-div'></div>";
    echo "<h1 id='information-h1' class='my-acct'>Membership and Billing</h1>";
    echo "<div id='left-main'><img id='mast-logo' src='assets/bronze-plan.svg'></div>";
    echo "<div id='right-main'>";
    echo "<table id='my-acct-billing-table'>";
    echo "<tr>";
    echo "<td><p class='billing-table'>Location :</p><td><td><p class='billing-table'>Columbus, OH</p><td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><p class='billing-table'>Plan :</p><td><td><p class='billing-table'>Silver</p><td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><p class='billing-table'>Payment :</p><td><td><p class='billing-table'>VISA **** **** **** 4264</p><td>";
    echo "</tr>";
    echo "</table>";
    echo "<a href='update-billing-info.php'><h1 class='my-acct-billing-links' id='updateBillingInfoLink'>Update Billing Info</h1></a>";
    echo "<a href='change-plan.php'><h1 class='my-acct-billing-links' id='changePlanLink'>Change Plan</h1></a>";
    echo "</div>";
  }
} ?>
