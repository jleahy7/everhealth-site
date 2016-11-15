<?php

  require_once('vendor/autoload.php');
  include "php/DataBase.php";

  $db = new DataBase();
  $invoices = $db->grab_invoices();
  // header("content-type:application/json");
  // echo json_encode($invoices);

 ?>

 <table>
   <tr><td>Invoice ID</td><td>Date</td><td>Bill To</td><td>Ship To</td><td>Description</td><td>Total</td></tr>
   <?php

   foreach ($invoices as $key => $value) {
     # code...
     echo "<tr><td>" . $value['invoice_ID'] . "</td><td>" . $value['invoice_date'] . "</td><td>" . $value['bill_to'] . "</td><td>" . $value['ship_to'] . "</td><td>" . $value['description'] . "</td><td>" . $value['total'] . "</td></tr>";
   }

    ?>
 </table>
