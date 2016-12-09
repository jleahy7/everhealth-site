<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ever Health Intranet - Documents</title>
    <meta name="author" content="James Leahy">
    <meta name="description" content="sample page for Ever Health">
    <meta name="keywords" content="Ever Health, create account">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css" ?>
    <script src='js/jquery-3.1.1.min.js'></script>
    <script src='js/main.js'></script>
</head>

<body>
  <div id='docs-dialog-training' class='hide-dialog docs-dialog'>
    <a onClick='closeDocs();return false'>
      <img class='close-icon' src='assets/close.svg'>
    </a>
    <br>
    <h1 class='docs-dialog-title'>Click a file to view it.</h1>
    <div id='docs-dialog-content'>
      <h1 class='docs-dialog-title'>Training files: </h1>
      <ul 'doc-file-list'>
          <li><a class='file-link' href='assets/docs/Ever Health Employee Training.pdf'>Employee Training Material</a></li>
      </ul>
    </div>
  </div>
  <div id='docs-dialog-office' class='hide-dialog docs-dialog'>
    <a onClick='closeDocs();return false'>
      <img class='close-icon' src='assets/close.svg'>
    </a>
    <br>
    <h1 class='docs-dialog-title'>Click a file to view it.</h1>
    <div id='docs-dialog-content'>
      <h1 class='docs-dialog-title'>Office files: </h1>
      <ul 'doc-file-list'>
          <li><a class='file-link' href='assets/docs/GENERAL JOURNAL.xlsx'>General Journal</a></li>
          <li><a class='file-link' href='assets/docs/flyer.pdf'>Flyer</a></li>
          <li><a class='file-link' href='assets/docs/Ever Health Leave of Absence.pdf'>Leave of Absence Policy</a></li>
          <li><a class='file-link' href='assets/docs/Ever Health Overtime Form.pdf'>Overtime Policy</a></li>
      </ul>
    </div>
  </div>
  <div id='docs-dialog-gym' class='hide-dialog docs-dialog'>
    <a onClick='closeDocs();return false'>
      <img class='close-icon' src='assets/close.svg'>
    </a>
    <br>
    <h1 class='docs-dialog-title'>Click a file to view it.</h1>
    <div id='docs-dialog-content'>
      <h1 class='docs-dialog-title'>Gym files: </h1>
      <ul 'doc-file-list'>
          <li><a class='file-link' href='assets/docs/Inventory.xlsx'>Inventory</a></li>
      </ul>
    </div>
  </div>
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
        <a href='documents.php'>
            <p class='nav-link'>Documents</p>
        </a>
        <a href='../index.php' target="blank">
            <p class='nav-link'>Ever Health Website</p>
        </a>
      </div>
        <div id='main-content'>
            <div id='main-content-br' class='break-div'></div>
            <br><br>
              <h1 class='center'>Find the documents you need.</h1>
                <a  class='doc-option' onClick="showDocs('training');return false;">
                <div class="doc-option">
                  <h1 class="desc">Training Documents</h1>
                      <img class='doc-icon' src="assets/stretch.svg" alt="Training Icon">
                </div></a>
                <br>
                <a  class='doc-option' onClick="showDocs('office');return false;">
                <div class="doc-option">
                        <img class='doc-icon' src="assets/document.svg" alt="Office Documents Icon">
                    <h1 class="desc">Office Documents</h1>
                </div></a>
                <br>
                <a  class='doc-option' onClick="showDocs('gym');return false;">
                <div class="doc-option">
                        <img class='doc-icon' src="assets/arm.svg" alt="Gym Documents Icon">
                    <h1 class="desc">Gym Documents</h1>
                </div></a>

            <div id='footer'>
                <p id='footer-p'>Ever Health - 550 East Spring St. Columbus, OH 43215 - (614)287-5353 - everhealth@everhealth.com</p>
            </div>
</body>
