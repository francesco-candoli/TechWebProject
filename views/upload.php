<?php

$uploadPath = 'images/';      // directory to store the uploaded files
$maxWidth = 900;            // maximum allowed width, in pixels
$maxHeight = 800;           // maximum allowed height, in pixels
$allowedType = array('jpg', 'jpeg', 'png');        // allowed extensions

if(isset($_FILES['fileup'])) {
  $uploadPath = $uploadPath . basename( $_FILES['fileup']['name']);
  $sepext = explode('.', strtolower($_FILES['fileup']['name']));
  $type = end($sepext);
  list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);
  $err = '';

  // Checks if the file has allowed type, size, width and height
  if(!in_array($type, $allowtype)) $err .= "Il file non possiede un estensione consentita";
  if(isset($width) && isset($height) && ($width > $maxWidth || $height > $maxHeight)) $err .= "La grandezza massima consentita è ". $maxWidth. " x ". $maxHeight;

  // If no errors, upload the image, else, output the errors
  if($err == '') {
    move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath);
  }
}

$titolo = "Upload Recensione";
$form='
<div class="text-center">
    <h2>Recensione</h2>
</div>
<hr>
<div class="text-start">
    <form action="#" method="POST">
        <label for="Ristorante" class="form-label mt-2 mb-0">Nome Ristorante</label>
        <input type="text" class="form-control" id="ristorante" name="ristorante">

        <label for="vote">Voto</label>
        <input type="number" class="from-control my-2" id="vote" name="vote" min="0" max="5" /><br>

        <label for="fileup">Upload File:</label> <input type="file" name="fileup"/>

        <div class="text-center">
            <button type="submit" class="btn btn-outline-primary my-2">Carica</button>
        </div>
    </form>
</div>';

require 'template/base.php';
?>
