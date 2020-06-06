<?php

require '../functions.php';

function getTotalEarning(){
    $sql = "SELECT SUM(amount) FROM `order` WHERE status = 'success'";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_COLUMN);
}

function getPendingOrders(){
    $sql = "SELECT COUNT(1) FROM `order` WHERE status = 'pending'";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_COLUMN);
}

function getEarningLastMonth(){
    $sql = "SELECT month(added_at) mnth, sum(amount) total FROM `order` group by mnth order by mnth desc limit 1";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    return $arr['total'];
}

function getTopEarningMonth() {
    $sql = "SELECT month(added_at) mnth, sum(amount) total FROM `order` WHERE status='success' group by mnth ORDER BY total desc limit 1";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    $mounthes = [
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь',
    ];
    return [$mounthes[$arr['mnth'] - 1], $arr['total']];
}