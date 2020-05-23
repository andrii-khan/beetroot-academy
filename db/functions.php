<?php

define('ITEMS_PER_PAGE', 8);

function getPDO()
{
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $pdo = new PDO("mysql:dbname=bookstore;host=127.0.0.1;charset=utf8mb4;", 'root', '', $options);

    return $pdo;
}

function getBooks() : array
{
    $page = getPageNumber();
    $offset = ($page - 1) * ITEMS_PER_PAGE;
    $query = "SELECT b.id book_id, b.title, a.name author, g.name genre FROM book b 
            left join author a ON a.id = b.author_id
            left join genre g On g.id = b.genre_id
            ORDER BY b.title
            LIMIT $offset,8";
    $pdo = getPDO();
    $result = $pdo->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    return $result->fetchAll();
}

function getBookById($bookId) : array {
    $query = "SELECT b.id book_id, b.title, a.name author, g.name genre, g.id genre_id FROM book b 
            LEFT JOIN author a ON a.id = b.author_id
            LEFT JOIN genre g ON g.id = b.genre_id
            WHERE b.id = ?
            ";

    $pdo = getPDO();
    $result = $pdo->prepare($query);
    $result->execute([$bookId]);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    return $result->fetch();
}

function getGenres() : array {
    $query = "SELECT id,name FROM genre";
    $pdo = getPDO();
    $result = $pdo->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    return $result->fetchAll();
}

function getComments($bookId) : array {
    $query = "SELECT * FROM comment WHERE book_id = ?";
    $pdo = getPDO();
    $result = $pdo->prepare($query);
    $result->execute([$bookId]);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function addComment($comment, $bookId){
    $sql = "INSERT INTO `comment` (message, book_id) VALUE (:comment, :book)";
    $pdo = getPDO();
    $stml = $pdo->prepare($sql);
    $stml->execute([
        'comment' => $comment,
        'book' => $bookId
    ]);
}
function formatCommentDate(string $date) : string {
    $time = strtotime($date);
    return date('m/j/y', $time);
}

function getPageNumber() : int {
    $page = $_GET['page'] ?? 1;
    $total = getTotalPage();
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $total) {
        $page = $total;
    }
    return $page;
}

function pagination(){
    $buttons = "";
    $page = getPageNumber();
    $pageCount = getTotalPage();
    $startPos = $page;
    $endPos = $page;
    for ($i = 0; $i < 2; $i++){
        if ($startPos === 1) {
            break;
        }
        $startPos--;
    }
    for ($i = 0; $i < 2; $i++){
        if ($endPos === $pageCount) {
            break;
        }
        $endPos++;
    }
    for ($i=$startPos; $i <= $endPos; $i++){
        $active = $page === $i ? 'active' : '';
        $buttons .= "<li class=\"page-item $active\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
    }
    return <<<PAGE
<nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            $buttons
            <li class="page-item">
                <a class="page-link" href="?page=$pageCount" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
PAGE;

}

function getTotalPage() : int {
    static $count;
    if ($count === null) {
        $sql = 'SELECT COUNT(1) FROM book';
        $pdo = getPDO();
        $stmp = $pdo->query($sql);
        $total = $stmp->fetch(PDO::FETCH_COLUMN);
        $count = ceil($total / ITEMS_PER_PAGE);
        return $count;
    }
    return $count;
}