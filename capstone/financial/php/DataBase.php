
<?php
class DataBase{

    private $db;
    private $acctPayQuery = "SELECT accounts_payable.account_payable_ID, accounts_payable.invoice_ID, accounts_payable.name, accounts_payable.description, accounts_payable.credit, accounts_payable.debit FROM accounts_payable;";
    private $invoiceQuery = "SELECT invoices.invoice_ID, invoices.invoice_date, invoices.bill_to, invoices.ship_to, detail.description, detail.total FROM invoices INNER JOIN detail on invoices.detail_ID = detail.detail_ID";


    public function __construct(){
      $this->db = new MysqliDb ('54.164.39.175', 'jake', 'cscccapstone', 'everhealth');
    }

    public function grabLocations(){
      return $this->db->get('location');
    }

    public function addInvoice(){
      //first create a detail row
      $detailRow = Array(
        'sku' => $_POST['sku'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity']
      );
      $result = $this->db->insert('detail', $detailRow);
      $detailID = $result;
      $invoiceRow = Array(
        'detail_ID' => $detailID,
        'invoice_date' => date("Y-m-d H:i:s"),
        'bill_to' => $_POST['bill_to'],
        'billing_address' => $_POST['bill_to_address'],
        'billing_city' => $_POST['bill_to_city'],
        'billing_state' => $_POST['bill_to_state'],
        'billing_zip' => $_POST['bill_to_zip'],
        'ship_to' => $_POST['ship_to'],
        'ship_to_address' => $_POST['ship_to_address'],
        'ship_to_city' => $_POST['ship_to_city'],
        'ship_to_state' => $_POST['ship_to_state'],
        'ship_to_zip' => $_POST['ship_to_zip']
      );
      $result = $this->db->insert('invoices', $invoiceRow);

      return $result;
    }

    public function addAcctPayable(){
      $acctRow = Array(
        'invoice_ID' => $_POST['invoice_ID'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'credit' => $_POST['credit'],
        'debit' => $_POST['debit']
      );
      $result = $this->db->insert('accounts_payable', $acctRow);
      return $result;
    }

    public function grab_invoices(){
      $invoices = $this->db->rawQuery($this->invoiceQuery);
      return $invoices;
    }

    public function grab_acctsPayable(){
      $accts = $this->db->rawQuery($this->acctPayQuery);
      return $accts;
    }
  }
?>
