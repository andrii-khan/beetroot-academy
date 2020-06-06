<?php
declare(strict_types=1);

/**
 * Class OrderService
 */
class OrderService
{
	/**
	 * @return array
	 */
	public function getOrder()
	{
		$sql = "SELECT o.order_id id, group_concat(b.title separator '</li><li>') books, o.amount amount, o.added_at date, o.status status FROM book b
				join order_book ob ON ob.book_id = b.id
				join `order` o ON o.order_id = ob.order_id
				group by o.order_id";
		$pdo = getPDO();
		$stmt = $pdo->query($sql);

		$resultArr = $stmt->fetchAll();
		$colorizeFunc = function ($status, $color) {
			if ($status == 'failed') {
				return "<span style='color: $color'>$status</span>";
			}
			return $status;
		};

		$result = array_map(function ($order) use ($colorizeFunc){
			$order['status'] = $colorizeFunc($order['status'], 'green');
			return $order;
		}, $resultArr);

		return $result;
	}
}