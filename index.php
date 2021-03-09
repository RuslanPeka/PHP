<?php
    require_once "func/func.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="line">
    <p>ЛУЧШИЙ В МИРЕ САЙТ</p>
</div>
<header>
    <div class="header_main_line">
        <h1>Курс PHP - Занятие №3</h1>
    </div>
    <div class="header_second_line">
        <h3>Операции с типами данных</h3>
    </div>
</header>
<main>
    <section class="work">
        <?php
            head('1. Вывод массива:');
            $test = [
                1,
                2,
                'three' => 3,
                3 => [
                    1,
                    2,
                    3,
                    4,
                ],
                [
                    1,
                    2,
                    3,
                    4,
                ],
            ];
            arr($test);
            hr();
            head('2. Работа с ключами массива:');
            $result = [];
            foreach($test as $k => $v) {
                if(is_array($v)) {
                    foreach($v as $k1 => $v1) {
                        $result[$k1] += $v1;
                    }
                } else {
                    $result[$k] += $v;
                }
            }
            arr($result);
            hr();
        ?>
    </section>
</main>
</body>
</html>