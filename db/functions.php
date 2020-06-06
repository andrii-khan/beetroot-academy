<?php
require 'vendor/autoload.php';
define('ITEMS_PER_PAGE', 8);
define('PUBLIC_KEY','sandbox_i14061653891');
define('PRIVATE_KEY','sandbox_nwaFaewa2Ptsu5euRLvZvGht5tJMBp6g3fZq30Ww');

function getPDO()
{
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $pdo = new PDO("mysql:dbname=bookstore;host=127.0.0.1;charset=utf8mb4;", 'root', '', $options);

    return $pdo;
}

function getBooks(array $ids = []): array
{
    require_once 'classes/productService.php';
    $class = new productService();
    return $class->getProductList($ids);
}

function getBookById($bookId): array
{
	require_once 'classes/productService.php';
	$class = new productService();
	return $class->getBookById($bookId);
}

function getGenres(): array
{
    $query = "SELECT id,name FROM genre";
    $pdo = getPDO();
    $result = $pdo->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    return $result->fetchAll();
}

function getComments($bookId): array
{
    $query = "SELECT * FROM comment WHERE book_id = ?";
    $pdo = getPDO();
    $result = $pdo->prepare($query);
    $result->execute([$bookId]);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function addComment($comment, $bookId)
{
    $sql = "INSERT INTO `comment` (message, book_id) VALUE (:comment, :book)";
    $pdo = getPDO();
    $stml = $pdo->prepare($sql);
    $stml->execute([
        'comment' => $comment,
        'book' => $bookId
    ]);
}

function formatCommentDate(string $date): string
{
    $time = strtotime($date);
    return date('m/j/y', $time);
}

function getPageNumber(): int
{
    $page = $_GET['page'] ?? 1;
    $total = getTotalPage();
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $total) {
        $page = $total;
    }
    return $page;
}

function pagination()
{
    $buttons = "";
    $page = getPageNumber();
    $pageCount = getTotalPage();
    $startPos = $page;
    $endPos = $page;
    for ($i = 0; $i < 2; $i++) {
        if ($startPos === 1) {
            break;
        }
        $startPos--;
    }
    for ($i = 0; $i < 2; $i++) {
        if ($endPos === $pageCount) {
            break;
        }
        $endPos++;
    }
    for ($i = $startPos; $i <= $endPos; $i++) {
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

function getTotalPage(): int
{
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

function addToCart($bookId, int $count = 1)
{
    $cart = [];
    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
    }
    if (!isset($cart[$bookId])) {
        $cart[$bookId] = 0;
    }
//    $cart[$bookId] = $cart[$bookId] + $count;
    $cart[$bookId] += $count;
    setcookie('cart', json_encode($cart), time() + 60 * 60 * 24 * 365);
}

function getItemsCount(): int
{
    $count = 0;
    if (!empty($_COOKIE['cart'])) {
        $arr = json_decode($_COOKIE['cart'], true);
        foreach ($arr as $item) {
            $count += $item;
        }
    }
    return $count;
}

function getCartItem(): array
{
    $arr = json_decode($_COOKIE['cart'], true);
    $ids = array_keys($arr);
    $books = getBooks($ids);

    foreach ($books as &$book){
        $book['count'] = $arr[$book['book_id']];
    }
    return $books;
}

/**
 * Create order with books
 *
 * @return int
 */
function createOrder() : int {
    $items = getCartItem();
    $sql = 'INSERT INTO `order` VALUES()';
    $pdo = getPDO();
    $pdo->query($sql);
    $orderId = $pdo->lastInsertId();
//    print_r($items);
    $sql = "INSERT INTO order_book VALUES(?,?,?)";
    $stmp = $pdo->prepare($sql);
    foreach ($items as $item){
        $stmp->execute([
            $orderId,
            $item['book_id'],
            $item['count'],
        ]);
    }

	return $orderId;

}

/**
 * Get total price to cart
 * @return float
 */
function getOrderTotal() : float {
    $total = 0.0;
    $items = getCartItem();
    foreach ($items as $item) {
        $total += $item['cost'] * $item['count'];
    }
    return $total;
}

function getData($orderId){
    $data = sprintf(
        '{"public_key":"%s","version":"3","action":"pay","amount":"%.2f","currency":"UAH","description":"test","order_id":"%s", "result_url" : "http://localhost:8080/callback.php"}',
        PUBLIC_KEY,
        getOrderTotal(),
        $orderId
    );
    return base64_encode($data);
}
function getSignature($orderId) {
    return base64_encode(sha1(PRIVATE_KEY . getData($orderId) . PRIVATE_KEY, true));
}

function updateOrder(string $data){
    $paymentData = json_decode(base64_decode($data), true);
    $orderId = $paymentData['order_id'];
    $amount = $paymentData['amount'];
    $status = $paymentData['status'];
    if ($status == 'failure') {
        $status = 'failed';
    }
    $pdo = getPDO();
    $sql = 'UPDATE `order` SET `status` = :status, amount = :amount WHERE order_id = :order_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'status' => $status,
        'order_id' => $orderId,
        'amount' => $amount,
    ]);


	// Create the Transport
	$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
		->setUsername('iquach92@gmail.com')
		->setPassword('Andrey1992Khan')
	;

// Create the Mailer using your created Transport
	$mailer = new Swift_Mailer($transport);
	ob_start();
	require './templates/mail.php';
	$email = ob_get_clean();
// Create a message
	$message = (new Swift_Message('Заказа на сайте'))
		->setFrom(['iquach92@gmail.com' => 'Книжный Магазин'])
		->setTo(['iquach@icloud.com'])
		->setBody($email ,'text/html')
	;

// Send the message
	$result = $mailer->send($message);

    return [$orderId, $status];
}

function getPaymentStatusMessage(){
    if(!empty($_SESSION['order_id'])){
        $sql = 'SELECT * FROM `order` WHERE order_id = ?';
        $pdo = getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['order_id']]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($order['status'] == 'success') {
            $message = sprintf("Заказа на сумму %s успешно оплачен", $order['amount']);
        } else {
            $message = sprintf("При заказае произошла ошибка. Заказа на сумму %s не оплачен", $order['amount']);
        }
        $message .= " <script>$('#exampleModalCenter').modal('show')</script>";
        unset($_SESSION['order_id']);
        return $message;
    }
}