<?php
    $lang = [
        'ru' => 'Русский',
        'ua' => 'Український',
        'eng' => 'English',
        'fr' => 'French',
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Форма Регистрации</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<br />
<?php if (!empty($_POST)) : ?>
   <div class="container">
       <h1>Данные о регистрации</h1>
       <ul class="list-group mb-3">
           <li class="list-group-item">Имя: <?php echo $_POST['name'] ?></li>
           <li class="list-group-item">Фамилия: <?php echo $_POST['surname'] ?></li>
           <li class="list-group-item">Логин: <?php echo $_POST['login'] ?></li>
           <li class="list-group-item">Пароль: <?php echo $_POST['password'] ?></li>
           <li class="list-group-item">Почта: <?php echo $_POST['email'] ?></li>
           <?php if ($_POST['gender']) : ?>
               <li class="list-group-item">Пол: <?php echo $_POST['gender'] ?></li>
           <?php endif; ?>
           <?php if ($_POST['city']) : ?>
               <li class="list-group-item">Город: <?php echo $_POST['city'] ?></li>
           <?php endif; ?>
           <?php if ($_POST['lang']) : ?>
               <li class="list-group-item">Язык:
                   <?php foreach ($_POST['lang'] as $item) : ?>
                        <?php echo $item ?>
                   <?php endforeach; ?>
               </li>
           <?php endif; ?>
       </ul>
   </div>
<?php endif; ?>

<div class="container">
    <form method="post" action="register.php">
        <h1>Форма Регистрации</h1>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="name">Имя</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Your Name" value="<?php echo $_POST['name']; ?>" required>
                </div>
                <div class="col">
                    <label for="surname">Фамилия</label>
                    <input name="surname" type="text" class="form-control" id="surname" placeholder="Your Surname" value="<?php echo $_POST['surname']; ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group is-valid">
            <label for="login">Логин</label>
            <input name="login" type="text" class="form-control" id="login" placeholder="Your Login" value="<?php echo $_POST['login']; ?>" required>
        </div>
        <div class="form-group is-valid">
            <label for="password">Пароль</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Your Password" value="<?php echo $_POST['password']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Почта</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Your Email" value="<?php echo $_POST['email']; ?>" required>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="gender">Выбирите пол:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option selected disabled>Выбирите пол</option>
                        <option>Мужчина</option>
                        <option>Женшина</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="city">Город</label>
                    <select class="form-control" id="city" name="city">
                        <option selected disabled>Выбирите город проживания</option>
                        <option>Полтава</option>
                        <option>Киев</option>
                        <option>Одесса</option>
                        <option>Львов</option>
                        <option>Чернигов</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="lang">Язык:</label>
            <select class="form-control" id="lang" name="lang[]" size="5" multiple>
                <option selected disabled>Выбирите язык</option>
                <?php foreach ($lang as $item) : ?>
                    <option><?php echo $item; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
</body>
</html>
