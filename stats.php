<?php
$users = [
    [
        'name' => 'Bob',
        'surname' => 'Martin',
        'age' => 75,
        'gender' => 'man',
        'avatar' => 'https://i.ytimg.com/vi/sDnPs_V8M-c/hqdefault.jpg',
        'animals' => ['dog', 'horse']
    ],
    [
        'name' => 'Alice',
        'surname' => 'Merton',
        'age' => 25,
        'gender' => 'woman',
        'avatar' => 'https://i.scdn.co/image/d44a5d71596b03b5dc6f5bbcc789458700038951',
        'animals' => ['dog', 'cat']
    ],
    [
        'name' => 'Jack',
        'surname' => 'Sparrow',
        'age' => 45,
        'gender' => 'man',
        'avatar' => 'https://pbs.twimg.com/profile_images/427547618600710144/wCeLVpBa_400x400.jpeg',
        'animals' => ['cat', 'dog', 'parrot']
    ],
    [
        'name' => 'Angela',
        'surname' => 'Merkel',
        'age' => 60,
        'gender' => 'woman',
        'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg/330px-Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg',
        'animals' => ['alligator', 'horse', 'dog']
    ]
];
if (!empty($_POST)) {
    $users[] = $_POST;
}
// Search Max Ages in Users
$ages = array_column($users, 'age');
$maxAge = array_keys($ages, max($ages));
$olderUser = [];
foreach ($maxAge as $index) {
    $olderUser[] = $users[$index];
}

if (!empty($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'id':
            if (!empty($_GET['order']) && $_GET['order'] == 'desc') {
                krsort($users);
            } else {
                ksort($users);
            }
            $users = array_values($users);
            break;
    }
}
$animals = [];
foreach ($users as $user) {
    $animals = array_merge($animals, $user['animals']);
}

$animalsFilter = array_unique($animals);

if (!empty($_GET['filter'])) {
    switch ($_GET['filter']) {
        case 'man':
            foreach ($users as $key => $user) {
                if ($user['gender'] !== 'man') {
                    unset($users[$key]);
                }
            }
            break;
        case 'woman':
            foreach ($users as $key => $user) {
                if ($user['gender'] !== 'woman') {
                    unset($users[$key]);
                }
            }
            break;
        case 'covid':
            foreach ($users as $key => $user) {
                if ($user['age'] < 60) {
                    unset($users[$key]);
                }
            }
            break;
        case 'dog':
        case 'cat':
        case 'horse':
        case 'parrot':
        case 'alligator':
            foreach ($users as $key => $user) {
                $index = array_search($_GET['filter'], $user['animals']);
                if (false === $index) {
                    unset($users[$key]);
                }
            }
            break;
        default:
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Статистика</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Статистика</h1>
    <ul>
        <?php foreach ($olderUser as $item) : ?>
            <li>Самый старый
                пользователь: <?php echo $item['name'] . ' ' . $item['surname'] . ' Возраст: ' . $item['age']; ?></li>
        <?php endforeach; ?>
        <li>Общее количество Юзеров: <?php echo count($users); ?></li>
    </ul>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th>
                <a class="text-light"
                   href="?sort=id&order=<?php echo(!empty($_GET['order'] && $_GET['order'] == 'desc') ? 'asc' : 'desc') ?>">#</a>
            </th>
            <th><a class="text-light" href="?sort=name">Name:</a></th>
            <th><a class="text-light" href="?sort=surname">Surname:</a></th>
            <th><a class="text-light" href="?sort=age">Age:</a></th>
            <th><a class="text-light" href="?sort=genedr">Gender:</a></th>
            <th><a class="text-light" href="?sort=avatar">Avatar:</a></th>
            <th><a class="text-light" href="?sort=animals">Animals:</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $key => $user) : ?>
            <?php $id = (!empty($_GET['sort']) && $_GET['sort'] == 'id' && $_GET['order'] == 'desc') ? count($users) - $key : $key + 1; ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['surname'] ?></td>
                <td><?php echo $user['age'] ?></td>
                <td><?php echo $user['gender'] ?></td>
                <td><img style="border-radius: 50%;object-fit: cover;width: 80px;height: 80px;"
                         src="<?php echo $user['avatar'] ?>" alt="<?php echo $user['name']; ?>"></td>
                <td>
                    <?php $userAnimals = $user['animals'] ?>
                    <ul>
                        <?php foreach ($userAnimals as $animal) : ?>
                            <li><?php echo $animal; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <form method="get">
        <div class="form-group">
            <select name="filter" class="form-control">
                <option selected disabled>Выбирите фильтр</option>
                <option value="man">Только мужчины</option>
                <option value="woman">Только женщины</option>
                <option value="covid">Риск COVID</option>
                <?php foreach ($animalsFilter as $animal) : ?>
                    <option value="<?php echo $animal ?>"><?php echo $animal; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn btn-primary">
            Фильтровать
        </button>
        <a href="stats.php" class="btn btn-success">Сбросить</a>
    </form>
    <a class="btn btn-warning mt-3" href="user.php">Перейти на страницу регистрации</a>
</div>


<?php
//$newLine = 0;
//for ($i = ord('a'); $i <= ord('z'); $i++){
//    $newLine = $i - 97 + 1;
//    echo chr($i);
//    if($newLine % 5 === 0) {
//         echo '<br>';
//    }
//}

//for ($i = 0; $i < count($users); $i++){
//    echo $users[$i]['name'] . ' ' . 'index: ' . $i;
//    echo '<br>';
//}

?>
</body>
</html>
