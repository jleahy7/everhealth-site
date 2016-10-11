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
  private $db, $page, $cookie, $request_method, $info;

  function __construct($__page){

    require_once "vendor/autoload.php";
    $this->init_db();
    $this->page = $__page;
    $this->info = new Info();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $request_method = 'POST';
      if($this->handle_POST() == true){
        //set cookie
        $this->info->set_cookie_name('account_username');
        $this->info->set_cookie_value($_POST['username']);
        header('Location: my-acct.php');
      } else {
        //redirect to login with error message
        header('Location: sign-in.php?failed-login=true');
      }
    } else {


      $header = new Header($this->page);
      // echo the wrapper
      echo "<body>";
      echo "<div id='wrapper'>";
      $floatingNav = new FloatingNav($this->page);
      $mast = new Masthead($this->page);
      $navBar = new NavBar($this->page);
      $mainContent = new MainContent($this->page);
      echo "</div>";
      $footer = new Footer($this->page);
    }
  }

  function init_db(){
    $this->db = new DataBase();
  }

  function handle_POST(){
    $successful_login = false;
    if($this->page == 'sign-in'){
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
        $successful_login = $this->db->check_user_creds($username, $password);
      }
    }
    return $successful_login;
  }
}
?>
