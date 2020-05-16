<?php
$users = require 'db.php';
foreach ($users as $user) {
    if ($user['email'] === $_POST['email'] && $user['password'] === $_POST['password']) {
        session_start();
//        setcookie('my-cookie', ++$_COOKIE['my-cookie'] ?? 1, time() + 180);
        $_SESSION['user'] = $user;
        $_SESSION['created_at'] = time();
        header('Location: /stats.php');
        exit;
    }
}

?>
<?php require 'header.php'; ?>

<div class="container ba-container">
    <div class="ba-form-wrap">
        <form method="post" class="form" id="login">
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-icon">
                            <i class="fa fa-at"></i>
                        </div>
                    </div>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-icon">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </div>
                    </div>
                    <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required>
                    <div class="show-pass">
                        <i class="fa fa-eye"></i>
                    </div>
                </div>
            </div>
            <a href="" class="toggle">Register</a>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <form method="post" action="stats.php" id="register" class="form hide">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="surnme">Surname</label>
                <input type="text" class="form-control" id="surnme" name="surname" placeholder="Surname" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option disabled selected>Select gender</option>
                    <option>Man</option>
                    <option>Woman</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <a href="#" class="toggle">Log In</a>
            <button type="submit" class="btn btn-primary">Registration</button>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>