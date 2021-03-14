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
        <h1>Курс PHP - Занятие №4</h1>
    </div>
    <div class="header_second_line">
        <h3>Функции</h3>
    </div>
</header>
<main>
    <section class="work">
        <?php
            echo '<h3>1. Область видимости функций</h3>';
            test('Привет! =)');
            function test(string $text)
            {
                echo $text;
            }
            echo '<br><br><hr><br>';
            echo '<h3>2. Область видимости функций, анонимная функция</h3>';
            //$closure('Привет! =)');
            echo 'Вариант с замыканием - не срабатывает';
            /*
            $closure = function ($test)
            {
                echo $test;
            };
            */
            echo '<br><br><hr><br>';
            echo '<h3>3. Область видимости функций, замыкание</h3>';
            $text = ' Сообщение';
            $closure = function ($test) use ($text)
            {
                echo $test . $text;
            };
            $closure('Привет! =)');
            echo '<br><br><hr><br>';
            echo '<h3>4. Статическая функция</h3>';
            function statt(int $a = 1)
            {
                static $var;
                $var += $a;
                echo $var . '<br>';
            }
            statt(10);
            statt(20);
            statt(30);
            statt(40);
            statt(50);
        echo '<br><br><hr><br>';
        ?>
    </section>
</main>
</body>
</html>