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
        'animals' => ['cat', 'dog', 'alligator']
    ],
    [
        'name' => 'Angela',
        'surname' => 'Merkel',
        'age' => 65,
        'gender' => 'woman',
        'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg/330px-Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg',
        'animals' => ['parrot', 'horse', 'dog']
    ]
];
if (!empty($_POST)) {
    $users[] = $_POST;
}
// Search Max Ages in Users
$ages = array_column($users, 'age');
$maxAge = array_keys($ages, max($ages));
$olderUser = [];
foreach ($maxAge as $index){
    $olderUser[] = $users[$index];
}
// Search Jack
$selectJack = array_column($users, 'name');
$jackID = array_search('Jack', $selectJack);
$jack = $users[$jackID];
// Select Random
$randomUserID = rand(0, count($users) - 1);
$randomUser = $users[$randomUserID];
// Search Merkel
$selectMerkel = array_column($users, 'surname');
$merkelID = array_search('Merkel', $selectMerkel);
$merkel = $users[$merkelID];
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
            <li>Самый старый пользователь: <?php echo $item['name'] .' '. $item['surname'] .' Возраст: '. $item['age']; ?></li>
        <?php endforeach; ?>

        <li>Общее количество Юзеров: <?php echo count($users); ?></li>
    </ul>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <td>index</td>
            <td>Name:</td>
            <td>Surname</td>
            <td>Age:</td>
            <td>Gender:</td>
            <td>Avatar:</td>
            <td>Animals:</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $jackID; ?></td>
            <td><?php echo $jack['name']; ?></td>
            <td><?php echo $jack['surname']; ?></td>
            <td><?php echo $jack['age'] ?></td>
            <td><?php echo $jack['gender']; ?></td>
            <td><img width="50px" src="<?php echo $jack['avatar']; ?>" alt="<?php echo $jack['name']; ?>"></td>
            <td>
                <ul>
                    <?php foreach ($jack['animals'] as $item) : ?>
                        <li>
                            <?php echo $item; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td><?php echo $randomUserID; ?></td>
            <td><?php echo $randomUser['name']; ?></td>
            <td><?php echo $randomUser['surname']; ?></td>
            <td><?php echo $randomUser['age']; ?></td>
            <td><?php echo $randomUser['gender']; ?></td>
            <td><img width="50px" src="<?php echo $randomUser['avatar'] ?>" alt="<?php echo $randomUser['name'] ?>">
            </td>
            <td>
                <ul>
                    <?php foreach ($randomUser['animals'] as $item) : ?>
                        <li>
                            <?php echo $item ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td><?php echo $merkelID; ?></td>
            <td><?php echo $merkel['name']; ?></td>
            <td><?php echo $merkel['surname']; ?></td>
            <td><?php echo $merkel['age']; ?></td>
            <td><?php echo $merkel['gender']; ?></td>
            <td><img width="50px" src="<?php echo $merkel['avatar'] ?>" alt="<?php echo $merkel['name'] ?>">
            </td>
            <td>
                <ul>
                    <?php sort($merkel['animals']) ?>
                    <?php foreach ($merkel['animals'] as $item) : ?>
                        <li>
                            <?php echo $item ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
    <a class="button" href="user.php">Перейти на страницу регистрации</a>
</div>
</body>
</html>
