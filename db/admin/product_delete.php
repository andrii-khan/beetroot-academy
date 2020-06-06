<?php
require 'admin-function.php';
require '../classes/productService.php';

$bookService = new productService();
$book = $bookService->deleteBook($_GET['book_id']);

header('Location:/admin/product.php');
//print_r($book);