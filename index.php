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
            echo '<h3>1. Фунция - фабрика вызова функций через анонимную функцию</h3>';
            // 1.1. Создадим несколько пользовательских функций
            function userFunc1() {
                echo 'Пользовательская функция №1';
            }
            function userFunc2() {
                echo 'Пользовательская функция №2';
            }
            function userFunc3() {
                echo 'Пользовательская функция №3';
            }

            // 1.2. Создадим анонимную функцию-фабрику для
            $userFunction = function ($func)
            {
                return call_user_func($func);
            };

            // 1.3. Проверим работоспособность функции-фабрики:
            $userFunction('userFunc1');     // Выводит: Пользовательская функция №1
            echo '<br>';
            $userFunction('userFunc2');     // Выводит: Пользовательская функция №2
            echo '<br>';
            $userFunction('userFunc3');     // Выводит: Пользовательская функция №3
            echo '<br><br><hr><br>';

            echo '<h3>2. Фунция записи в csv файл</h3>';
            // 2.1. Запишем массив с данными, которые будем представлять в табличном виде в СSV-файле
            $dataArray = [
                0 => ['Элемент 1.1', 'Элемент 1.2', 'Элемент 1.3'],
                1 => ['Элемент 2.1', 'Элемент 2.2', 'Элемент 2.3'],
                2 => ['Элемент 3.1', 'Элемент 3.2', 'Элемент 3.3'],
            ];
            echo 'Массив для записи в CSV-файл:<br>';
            echo '<pre>';
            print_r($dataArray);
            echo '</pre>';

            // 2.2. Создадим функцию для записи в файл
            function writeCSV($array)
            {
                $fileToWrite = fopen("table.csv", "w");
                foreach ($array as $value) {
                    fputcsv($fileToWrite, $value);
                }
                fclose($fileToWrite);
            }

            // 2.3. Проверяем работоспособность функции записи в файл
            writeCSV($dataArray);   // Функция отработала верно!
            echo '<br><br><hr><br>';

            echo '<h3>3. Фунция чтения из csv файла</h3>';
            // 3.1. Создадим массив для заполнения из CSV-файла
            $arrayFromCSV = [];

            // 3.2. Создадим переменную с именем CSV-файла
            $nameCSV = 'table.csv';

            // 3.3. Создадим функциб записи CSV-файла в массив
            function readCSV($fileName)
            {
                $arrayCSV = [];
                $fileToRead = fopen($fileName, "r");
                $counter = 0;
                while(($stringToRead = fgetcsv($fileToRead, 1000, ",")) !== false) {
                    $arrayCSV[$counter] = $stringToRead;
                    $counter++;
                }
                fclose($fileToRead);
                return $arrayCSV;
            }

            // 3.4. Проверим работоспособность считывания CSV-файла
            $arrayFromCSV = readCSV($nameCSV);      // Функция отработала верно!
            echo 'Массив, считанный из CSV-файла:<br>';
            echo '<pre>';
            print_r($arrayFromCSV);
            echo '</pre>';
            echo '<br><br><hr><br>';
        ?>
    </section>
</main>
</body>
</html>