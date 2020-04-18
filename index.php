<?php
$name = "Andrii";
$surname = "Khan";
$age = 28;
$year = 2020;
$milenium = ceil($year/1000);
$daysLive = $age * 365;
echo "My name is $name $surname. Days lived $daysLive";
echo "<br>";
echo "The year is: $milenium";

define('DOLAR_COST', 27.2);
$dollar = 100;
$grivna = 100;
$grivnaToDollar = round($grivna / DOLAR_COST, 2);
$dollarToGrivna = round($dollar * DOLAR_COST, 2);
echo "<br>";
echo "100$ сегодня стоят $dollarToGrivna гривен";
echo "<br>";
echo "100грн сегодня стоят $grivnaToDollar долларов";
echo "<br>";

$user = [
    'name' => $name,
    'surname' => $surname,
    'age' => $age,
    'days_live' => $daysLive,
    'milenium' => $milenium,
];

echo "<pre>";
print_r($user);
echo "</pre>";

echo "My name is {$user['name']} {$user['surname']}. I'm {$user['age']}. Days lived {$user['days_live']}. Milenium {$user['milenium']}";
?>