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
            echo '<h3>1. Сумма вторых элементов массива произвольной вложенности:</h3>';
            // 1) Записываем массив:
            $testArray = [
                1,
                2,
                3,
                4 => [
                    1,
                    2,
                    3 => [
                        1,
                        "2 слона",
                        3,
                        4,
                        5,
                    ],
                ],
            ];

            // 2) Функция для суммирования всех 2-х элементов:
            function sum2($array)
            {
                $sum = 0;
                $counter = 0;
                foreach($array as $value) {
                    if(is_array($value)) {
                        $sum += sum2($value);
                    } else {
                        $counter++;
                        if($counter == 2) {
                            if(!is_array($value)) $sum += $value;
                        }
                    }
                }
                return $sum;
            }

            // 3) Вывод результатов:
            echo 'Рассматриваемый массив:<br>';
            echo '<pre>';
            print_r($testArray);
            echo '</pre><br>';
            echo 'Сумма вторых элементов: <b>' . sum2($testArray) . '</b>';
            echo '<br><br><hr><br>';

            echo '<h3>2.1. Определение количества символов в строке (с учётом регистра):</h3>';
            // 1) Записываем строку:
            $string = 'My mistery StringgGG';

            // 2) Превращаем строку в массив с учётом лишь уникальных символов:
            $arrayFromString = array_unique(mb_str_split($string));

            // 3) Выполняим поиск количества их вхождений (пробелы - не учитываются, с помощью условия if() ):
            $arrayOfResult = [];
            foreach($arrayFromString as $value) {
                if($value != ' ') {
                    $resultKey = $value;
                    $resultValue = mb_substr_count($string, $value);
                    $arrayOfResult += [$resultKey => $resultValue];
                }
            }

            // 4) Отсортируем массив результатов для удобства чтения:
            ksort($arrayOfResult);

            // 5) Вывод результатов:
            echo 'Строка: <b>' . $string . '</b><br>';
            echo 'Массив результатов:<br>';
            echo '<pre>';
            print_r($arrayOfResult);
            echo '</pre>';
            echo '<br><hr><br>';

            echo '<h3>2.2. Определение количества символов в строке (БЕЗ учёта регистра):</h3>';
            // 1) Записываем строку:
            $firstString = 'My mistery StringgGG';

            // 2) Переводим всё в нижний регистр:
            $string = mb_strtolower($firstString);

            // 3) Превращаем строку в массив с учётом лишь уникальных символов:
            $arrayFromString = array_unique(mb_str_split($string));

            // 4) Выполняим поиск количества их вхождений (пробелы - не учитываются, с помощью условия if() ):
            $arrayOfResult = [];
            foreach($arrayFromString as $value) {
                if($value != ' ') {
                    $resultKey = $value;
                    $resultValue = mb_substr_count($string, $value);
                    $arrayOfResult += [$resultKey => $resultValue];
                }
            }

            // 5) Отсортируем массив результатов для удобства чтения:
            ksort($arrayOfResult);

            // 6) Вывод результатов:
            echo 'Строка: <b>' . $firstString . '</b><br>';
            echo 'Массив результатов:<br>';
            echo '<pre>';
            print_r($arrayOfResult);
            echo '</pre>';
            echo '<br><hr><br>';
            ?>
    </section>
</main>
</body>
</html>