<?php

class Header{

  public $page;

  function __construct($_page){
    $this->page = $_page;

    switch($this->page){
      case "invoice-gate":
        $this->invoiceGate();
        break;
      case "acct-payable-gate":
        $this->acctPayGate();
        break;
      case "add-acct-recievable-gate":
        $this->acctRecGate();
        break;
      case "view-invoice":
        break;
      case "view-acct-payable":
          break;
      case "view-acct-recievable":
            break;
      case "add-invoice":
        break;
      case "add-acct-payable":
          break;
      case "add-acct-recievable":
            break;
    }
  }

  function invoiceGate(){
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    echo "<title>Invoice Gate</title>";
    echo "<link rel='stylesheet' type='text/css' href='css/gate-styles.css' media='all'>";
    echo "<script type='text/javascript' src=view.js'></script>";
    echo "<script type='text/javascript' src='calendar.js'></script>";
    echo "</head>";
  }

  function acctPayGate(){
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    echo "<title>Accounts Payable</title>";
    echo "<link rel='stylesheet' type='text/css' href='css/gate-styles.css' media='all'>";
    echo "<script type='text/javascript' src=view.js'></script>";
    echo "<script type='text/javascript' src='calendar.js'></script>";
    echo "</head>";
  }

  function acctRecGate(){
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    echo "<title>Accounts Recievable</title>";
    echo "<link rel='stylesheet' type='text/css' href='css/gate-styles.css' media='all'>";
    echo "<script type='text/javascript' src=view.js'></script>";
    echo "<script type='text/javascript' src='calendar.js'></script>";
    echo "</head>";
  }
}

 ?>
