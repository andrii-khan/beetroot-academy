<?php
$error = [];
if (!empty($_POST)) {
    if (empty($_POST['name'])) {
        $error['name'] = 'Имя не может пустым';
    }
    if (empty($_POST['surname'])) {
        $error['surname'] = 'Фамилия не может пустой';
    }
    if (empty($_POST['age']) || $_POST['age'] < 1) {
        $error['age'] = 'Возраст задан некорректно';
    }
    if (empty($_POST['email'])) {
        $error['email'] = 'Почта задана некорректно';
    }
}
$lang = (!empty($_GET['lang'])) ? $_GET['lang'] : 'ru';
$labels = [
        'ru' => ['name' => 'Имя:', 'surname' => 'Фамилия:', 'age' => 'Возраст:', 'email' => 'Почта:', 'gender' => 'Выберите Пол:', 'send' => 'Отправить', 'title' => 'Форма Регистрации'],
        'ua' => ['name' => "Ім'я", 'surname' => 'Призвіще:', 'age' => 'Вік:', 'email' => 'Пошта:', 'gender' => 'Оберіть Стать:', 'send' => 'Відправити','title' => 'Форма Реєстрації'],
        'en' => ['name' => 'Name:', 'surname' => 'Surname:', 'age' => 'Age:', 'email' => 'Email:', 'gender' => 'Select Gender:', 'send' => 'Send','title' => 'Registration Form'],
];

switch ($lang) {
    case 'ru';
        $translation = $labels['ru'];
        break;
    case 'ua';
        $translation = $labels['ua'];
        break;
    case 'en';
        $translation = $labels['en'];
        break;
}


//    $ages = array_column($users, 'age');
//    $key = array_search(75, $ages);

//    if($key !== false) {
//        echo "The age found";
//    } else {
//        echo "NOT FOUND";
//    }
//    var_dump($ages);
//    echo "<br>";
//    rsort($ages);
//    var_dump($ages);
//    echo "<br>";
//    var_dump(count($ages));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $translation['title']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<br/>
<div class="container">
    <h1><?php echo $translation['title']; ?></h1>
</div>
<div class="container">
    <div class="float-right">
        <a href="?lang=ru" class="badge badge-primary">Русский</a>
        <a href="?lang=ua" class="badge badge-secondary">Украинский</a>
        <a href="?lang=en" class="badge badge-success">Английский</a>
    </div>
    <form method="post" action="stats.php">
        <div class="form-group">
            <label for="name"><?php echo $translation['name']; ?></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите Имя"
                   <?php if ($_POST['name']): ?>value="<?php echo $_POST['name'] ?>"<?php endif; ?>>
            <?php if (!empty($error['name'])) : ?>
                <small class="text-danger">
                    <?php echo $error['name'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="surnme"><?php echo $translation['surname']; ?></label>
            <input type="text" class="form-control" id="surnme" name="surname"
                   placeholder="Введите Фамилию"
                   <?php if ($_POST['surname']): ?>value="<?php echo $_POST['surname'] ?>"<?php endif; ?>">
            <?php if (!empty($error['surname'])) : ?>
                <small class="text-danger">
                    <?php echo $error['surname'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="age"><?php echo $translation['age']; ?></label>
            <input type="number" class="form-control" id="age" name="age" placeholder="Введите Возраст"
                   <?php if ($_POST['age']): ?>value="<?php echo $_POST['age'] ?>"<?php endif; ?>>
            <?php if (!empty($error['age'])) : ?>
                <small class="text-danger">
                    <?php echo $error['age'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email"><?php echo $translation['email']; ?></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Введите Email"
                   <?php if ($_POST['email']): ?>value="<?php echo $_POST['email'] ?>" <?php endif; ?>>
            <?php if (!empty($error['email'])) : ?>
                <small class="text-danger">
                    <?php echo $error['email'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <?php $gender = empty($_POST['gender']) ? 'Other' : $_POST['gender']; ?>
            <label for="gender"><?php echo $translation['gender']; ?></label>
            <select class="form-control" id="gender" name="gender">
                <option disabled selected>Выберите пол</option>
                <option <?php echo $_POST['gender'] == 'Man' ? 'selected' : '' ?>>Man</option>
                <option <?php echo $_POST['gender'] == 'Woman' ? 'selected' : '' ?>>Woman</option>
                <option <?php echo $_POST['gender'] == 'Other' ? 'selected' : '' ?>>Others</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $translation['send']; ?></button>
    </form>
</div>
</body>
</html>