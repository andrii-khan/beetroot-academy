<?php
    $value = 'Hello form PHP 7.2';
    $name = 'Andrii';
    $surname = 'Khan';
    $age = 28;
    $email = 'iquach@icloud.com';
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Форма</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<br />
<?php if ($_POST['name'] && $_POST['city']) : ?>
    <h1>Ваше Имя: <?php echo $_POST['name'] ?>. Ваш город: <?php echo $_POST['city'][0]; ?></h1>
<?php endif; ?>

<div class="container">
    <form method="post" action="user.php">
        <div class="form-group">
            <label for="name">Имя и Фамилия</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Your Name" value="<?php echo $_POST['name'] ?? 'Андрей'; ?>">
        </div>
        <div class="form-group">
            <label for="surname">Фамилия</label>
            <input name="surname" type="text" class="form-control" id="surname" placeholder="Your Surname" value="<?php echo $_POST['surname'] ?? 'Хан'; ?>">
        </div>
        <div class="form-group">
            <label for="age">Возраст</label>
            <input name="age" type="number" class="form-control" id="age" placeholder="Your Age" value="<?php echo $_POST['age']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Почта</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Your Email" value="<?php echo $_POST['email']; ?>">
        </div>
        <div class="form-group">
            <label for="gender">Выбирите пол:</label>
            <select class="form-control" id="gender" name="gender">
                <option>Мужчина</option>
                <option>Женшина</option>
                <option>Другое</option>
            </select>
        </div>
        <div class="form-group">
            <label for="city">Город</label>
            <select class="form-control" id="city" name="city[]" multiple>
                <option>Полтава</option>
                <option>Киев</option>
                <option>Одесса</option>
                <option>Львов</option>
                <option>Чернигов</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
</body>
</html>
