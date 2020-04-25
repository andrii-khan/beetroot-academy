<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chess Desk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1 class="text-center">Chess Desk</h1>
    <div class="desk-wrap">
        <div class="desk">
            <?php $i = 0; $b = 0; ?>
            <?php for ($row = 0; $row < 8; $row++): $b++;?>

                <?php if ($b === 1 || $b === 8): ?>
                    <div class="letter <?php echo $b === 1 ? 'top' : 'bottom' ?>">
                        <?php for ($letter = 0; $letter < 8; $letter++) : ?>
                            <span><?php echo chr(65 + $letter); ?></span>
                        <?php endfor; ?>
                    </div>
                    <div class="number <?php echo $b === 1 ? 'left' : 'right' ?>">
                        <?php for ($number = 0; $number < 8; $number++) : ?>
                            <span><?php echo 8 - $number ?></span>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <div class="row-chess <?php echo ($b % 2 === 0) ? 'even' : 'odd'; ?>">
                    <?php for ($cell = 0; $cell < 8; $cell++) : ?>
                        <div class="cell <?php echo $cell % 2 === 0 ? 'odd' : 'even' ?>"></div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
</body>
</html>