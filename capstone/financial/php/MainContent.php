<?php

class MainContent{

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
    echo "<a href='add-invoice.php'><h1 class='gate-link'>Add Invoice</h1></a>";
    echo "<a href='excel/invoices.xlsm'><h1 class='gate-link'>View Invoices</h1></a>";
  }

  function acctPayGate(){
    echo "<a href='add-acct-payable.php'><h1 class='gate-link'>Add Account Payable</h1></a>";
    echo "<a href='excel/accounts_payable_table.xlsm'><h1 class='gate-link'>View Accounts Payable</h1></a>";
  }

  function invoiceacctRecGateGate(){
    echo "<a href='add-acct-recievable.php'><h1 class='gate-link'>Add Account Recievable</h1></a>";
    echo "<a href='view-acct-recievable.php'><h1 class='gate-link'>View Accounts Recievable</h1></a>";
  }
}

?>
