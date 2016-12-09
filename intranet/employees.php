<?
  include 'php/DataBase.php';

  $db = new DataBase();
  //CREATE AN ABOUT PAGE INSTEADS
  if($_SERVER['REQUEST-METHOD'] == "POST"){
    echo '<script>console.log("got a post")</script>';
    if($db->logIn($_POST['username'], $_POST['password'])){
      header("Location: emp-home.php");
    } else {
      if(isset($_GET['failedLogin'])){
        $failedAttempts = $_GET['failedLogin'];
        $failedAttempts++;
        header("Location: employees.php?failedLogin=" . $failedAttempts);
      } else {
        header('Location: employees.php?failedLogin=0');
      }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Employees</title>
    <meta name="author" content="James Leahy">
    <meta name="description" content="sample page for Ever Health">
    <meta name="keywords" content="Ever Health, create account">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css"?>
    <script src='js/jquery-3.1.1.min.js'></script>
    <script src='js/emp-main.js'></script>
  </head>
  <body>
    <div id='wrapper'>
      <a href='index.php'>
        <div id='masthead'>
          <img id='mast-logo' src=assets/weightlifting.svg>
          <p id='mast-p'>Ever Health Intranet</p>
        </div>
      </a>
      <div id='navbar'>
        <a href='index.php'>
            <p class='nav-link'>Home</p>
        </a>
        <a href='employees.php'>
            <p class='nav-link'>Employees</p>
        </a>
        <a href='documents.php'>
            <p class='nav-link'>Documents</p>
        </a>
      </div>
      <div id='main-content'>
        <div id='main-content-br' class='break-div'></div>
        <form id='create-acct-form'>
            <input class='form-input-text text-input-large' type="text" id='username' name='username' value='Username'>
            <input class='form-input-text text-input-large' type="text" id='password' name='password' value='Password'>
            <input class='form-input-text text-input-medium left' type="submit" name='submit' value=' Submit'>
            <input class='form-input-text text-input-medium right' type="submit" name='cancel' value=' Cancel'>
        </form>
    </div>
    <div id='footer'>
        <p id='footer-p'>Ever Health - 550 East Spring St. Columbus, OH 43215 - (614)287-5353 - everhealth@everhealth.com</p>
    </div>
  </body>
</html>
