<?php
//phpinfo(); exit;
require 'function.php';

$items = loadAll();
//$xml = loadRss('https://dumskaya.net/rssnews/');
?>
<?php require 'header.php';?>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <a href="" class="navbar-brand">Navbar</a>
            <form class="form-inline my-2 my-lg-0">
                <input type="hidden" name="limit" value="<?php echo $_GET['limit'] ?? '' ?>">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <h1><?php echo getExchanges() ?></h1>
    <h3>Новости Украины</h3>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="?limit=5">5</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?limit=10">10</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/">Все</a>
        </li>
    </ul>
    <ol>
        <?php foreach ($items as $key => $article) : ?>
            <div class="card" style="width: 16rem;float:left">
                <img class="card-img-top" src="<?=$article->image ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$article->title ?></h5>
                    <p class="card-text"><?=$article->description ?></p>
                    <a href="<?=$article->title ?>" class="btn btn-primary"><?=$article->title ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </ol>
</div>
<?php require 'footer.php';?>
