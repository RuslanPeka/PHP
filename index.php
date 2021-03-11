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
            head('1. Сумма вторых элементов массива произвольной вложенности:');
            // 1) Записываем массив:
            $test = [
                1,
                2,
                3,
                4 => [
                    1,
                    2,
                    3 => [
                        1,
                        2,
                        3,
                        4,
                        5,
                    ],
                ],
            ];

            // 2) Функция для суммирования всех 2-х элементов:
            function sum2($arr)
            {
                $result = 0;
                $count = 0;
                foreach($arr as $v) {
                    if(is_array($v)) {
                        $result += sum2($v);
                    } else {
                        $count++;
                        if($count == 2) {
                            if(!is_array($v)) $result += (int)$v;
                        }
                    }
                }
                return $result;
            }

            // 3) Вывод результатов:
            echo 'Рассматриваемый массив:<br>';
            arr($test);
            echo 'Сумма вторых элементов: <b>' . sum2($test) . '</b>';
            hr();

            head('2.1. Определение количества символов в строке (с учётом регистра):');
            // 1) Записываем строку:
            $str = 'My mistery StringgGG';

            // 2) Превращаем строку в массив с учётом лишь уникальных символов:
            $array = array_unique(mb_str_split($str));

            // 3) Выполняим поиск количества их вхождений (пробелы - не учитываются, с помощью условия if() ):
            $result = [];
            foreach($array as $v) {
                if($v != ' ') {
                    $kk = $v;
                    $vv = mb_substr_count($str, $v);
                    $result += [$kk => $vv];
                }
            }

            // 4) Отсортируем массив результатов для удобства чтения:
            ksort($result);

            // 5) Вывод результатов:
            echo 'Строка: <b>' . $str . '</b><br>';
            echo 'Массив результатов:<br>';
            arr($result);
            hr();

            head('2.2. Определение количества символов в строке (БЕЗ учёта регистра):');
            // 1) Записываем строку:
            $str_first = 'My mistery StringgGG';

            // 2) Переводим всё в нижний регистр:
            $str = mb_strtolower($str_first);

            // 3) Превращаем строку в массив с учётом лишь уникальных символов:
            $array = array_unique(mb_str_split($str));

            // 4) Выполняим поиск количества их вхождений (пробелы - не учитываются, с помощью условия if() ):
            $result = [];
            foreach($array as $v) {
                if($v != ' ') {
                    $kk = $v;
                    $vv = mb_substr_count($str, $v);
                    $result += [$kk => $vv];
                }
            }

            // 5) Отсортируем массив результатов для удобства чтения:
            ksort($result);

            // 6) Вывод результатов:
            echo 'Строка: <b>' . $str_first . '</b><br>';
            echo 'Массив результатов:<br>';
            arr($result);
            hr();
            ?>
    </section>
</main>
</body>
</html>