<?php
var_dump($_FILES);
if (!empty($_FILES)) {
    $source = $_FILES['import']['tmp_name'];
    $fileName = $_FILES['import']['name'];
    $dest = './tmp/' . $fileName;
    move_uploaded_file($source, $dest);

    // Start writting to database
    $users = require 'db.php';
    require 'functions.php';
    $handle = fopen($dest, 'r');
    $headers = fgetcsv($handle);

    while(!feof($handle)){
        $row = fgetcsv($handle);
        if (!empty($row)) {
            $user = array_combine($headers, $row);
            createUser($user);
        }
    }
}

