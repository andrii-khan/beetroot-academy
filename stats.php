<?php
$users = [
    [
        'name' => 'Bob',
        'surname' => 'Martin',
        'age' => 75,
        'gender' => 'man',
        'avatar' => 'https://i.ytimg.com/vi/sDnPs_V8M-c/hqdefault.jpg',
        'animals' => ['dog']
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
        'animals' => []
    ],
    [
        'name' => 'Angela',
        'surname' => 'Merkel',
        'age' => 65,
        'gender' => 'woman',
        'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg/330px-Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg',
        'animals' => ['dog', 'parrot', 'horse']
    ]
];

if (!empty($_POST)) {
    $users[] = $_POST;
}

$ages = array_column($users, 'age');
$maxAge = max($ages);
$maxAgeId = array_search($maxAge, $ages);
$olderUser = $users[$maxAgeId];
$selectName = array_column($users, 'name');
$userID = array_search('Angela', $selectName);
$jack = $users[$userID];

$randomUserID = rand(0, count($users) - 1);
$randomUser = $users[$randomUserID];
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
        <li>Самый старый
            пользователь: <?php echo $olderUser['name'] . " " . $olderUser['surname'] . " " . $olderUser['age']; ?></li>
        <li>Общее количество Юзеров: <?php echo count($users); ?></li>
    </ul>
    <table class="table">
        <?php foreach ($jack as $item) : ?>

        <?php endforeach; ?>

        <thead>
        <tr>
            <?php foreach ($jack as $index => $item) : ?>
                <th scope="col"><?php echo $index ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $jack['name'] ?></td>
            <td><?php echo $jack['surname'] ?></td>
            <td><?php echo $jack['age'] ?></td>
            <td><?php echo $jack['gender'] ?></td>
            <td><img width="50px" src="<?php echo $jack['avatar'] ?>" alt="<?php echo $jack['name'] ?>"></td>
            <td>
                <?php foreach ($jack['animals'] as $item) : ?>
                    <?php echo $item ?>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $randomUser['name'] ?></td>
            <td><?php echo $randomUser['surname'] ?></td>
            <td><?php echo $randomUser['age'] ?></td>
            <td><?php echo $randomUser['gender'] ?></td>
            <td><img width="50px" src="<?php echo $randomUser['avatar'] ?>" alt="<?php echo $randomUser['name'] ?>"></td>
            <td>
                <?php foreach ($randomUser['animals'] as $item) : ?>
                    <?php echo $item ?>
                <?php endforeach; ?>
            </td>
        </tr>

        </tbody>
    </table>
    <a class="button" href="user.php">Регистрация</a>
</div>
</body>
</html>
