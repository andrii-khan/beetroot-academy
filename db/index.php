<?php
require 'functions.php';
$books = getBooks();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Bookstore</title>
</head>
<body>
<div class="container">
    <h1>Bookstore</h1>
    <header class="jumbotron my-4">
        <h1 class="display-3">A Warm Welcome!</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
    </header>

    <div class="row text-center">
        <?php foreach ($books as $item) : ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $item['title'] ?></h4>
                    <p class="card-text mb-0">Автор : <?php echo $item['author'] ?></p>
                    <p class="card-text">Жанр : <?php echo $item['genre'] ?></p>
                </div>
                <div class="card-footer">
                    <a href="./page.php?book_id=<?php echo $item['book_id']; ?>" class="btn btn-primary">Подробней</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php echo pagination() ?>
    <!-- /.row -->
</div>

</body>
</html>
