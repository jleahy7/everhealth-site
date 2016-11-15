<?php

  require_once('vendor/autoload.php');
  include "php/DataBase.php";

  $db = new DataBase();
  $accts = $db->grab_acctsPayable();
  // header("content-type:application/json");
  // echo json_encode($invoices);

 ?>

 <table>
   <tr><td>Account Payable ID</td><td>Name</td><td>Description</td><td>Credit</td><td>Debit</td></tr>
   <?php

   foreach ($accts as $key => $value) {
     # code...
     echo "<tr><td>" . $value['account_payable_ID'] . "</td><td>" . $value['name'] . "</td><td>" . $value['description'] . "</td><td>" . $value['credit'] . "</td><td>" . $value['debit'] . "</td></tr>";
   }

    ?>
 </table>
