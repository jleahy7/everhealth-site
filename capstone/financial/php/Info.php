<?php

class Info{

  public $locations, $db, $states = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
);

  function __construct(){
    $this->db = new DataBase();
  }

  static function check(){
    echo "<script>console.log('Checkerooooo')</script>";
  }

  static function log($obj){
    echo "<script>console.debug('" . json_encode($obj) . "')</script>";
  }

  public function grabLocations(){
    try{
      $db = new DataBase();
      $results = $db->grabLocations();
    } catch (Exception $e){
      echo "There was an exception in the INFO class in the grab_info_from_db method.  Error was : " . $e;
    }
    return $results;
  }

  public function validateInvoice(){
    $valid = true;
    if(empty($_POST['bill_to'])){
      $valid = false;
    }
    if(empty($_POST['bill_to_address'])){
      $valid = false;
    }
    if(empty($_POST['bill_to_city'])){
      $valid = false;
    }
    if(empty($_POST['bill_to_state'])){
      $valid = false;
    }
    if(empty($_POST['bill_to_zip'])){
      $valid = false;
    }
    if(empty($_POST['ship_to'])){
      $valid = false;
    }
    if(empty($_POST['ship_to_address'])){
      $valid = false;
    }
    if(empty($_POST['ship_to_city'])){
      $valid = false;
    }
    if(empty($_POST['ship_to_state'])){
      $valid = false;
    }
    if(empty($_POST['ship_to_zip'])){
      $valid = false;
    }
    return $valid;
  }

  public function validateAcctPayable(){
    $valid = true;
    if(empty($_POST['invoice_ID'])){
      $valid = false;
    }
    if(empty($_POST['name'])){
      $valid = false;
    }
    if(empty($_POST['description'])){
      $valid = false;
    }
    return $valid;
  }
}

 ?>
