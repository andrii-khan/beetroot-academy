<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require './functions.php';

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
    <h1><?php echo helloWorld('Mike') ?></h1>
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
                   href="?sort=id&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc' : 'desc') ?>">#</a>
            </th>
            <th><a class="text-light" href="?sort=name&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc' : 'desc') ?>">Name:</a></th>
            <th><a class="text-light" href="?sort=surname&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc' : 'desc') ?>">Surname:</a></th>
            <th><a class="text-light" href="?sort=age&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc' : 'desc') ?>">Age:</a></th>
            <th><a class="text-light" href="?sort=gender&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc' : 'desc') ?>">Gender:</a></th>
            <th><a class="text-light" href="?sort=avatar&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc' : 'desc') ?>">Avatar:</a></th>
            <th><a class="text-light" href="?sort=animals&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc' : 'desc') ?>">Animals:</th>
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

</body>
</html>
