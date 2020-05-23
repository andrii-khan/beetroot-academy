<?php
require 'functions.php';
if (!empty($_POST) && $_POST['comment'] && $_POST['book_id']){
    $bookID = $_POST['book_id'];
    addComment($_POST['comment'], $bookID);
}
header("Location: /page.php?book_id=$bookID");
?>



