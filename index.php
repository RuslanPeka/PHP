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
        <h1>Курс PHP - Занятие №5</h1>
    </div>
    <div class="header_second_line">
        <h3>ООП</h3>
    </div>
</header>
<main>
    <section class="work">
        <?php
        // Константы в классе: const CONST_NANE
        // Доступ к константе класса:   self::
        //                              ClassName::
        // Статик - можно переопределить, в отличии от констант

        abstract class A
        {
            abstract function test(int $i):int;
        }

        class B extends A
        {
            function test(int $i):int
            {
                return 1;
            }

            function func(string $var)
            {
                return $var . $var;
            }
        }

        class C extends A
        {
            function test(int $i):int
            {
                return 2;
            }
        }
        class E extends C
        {
            function func(string $var)
            {
                return $var . $var;
            }
        }

        class D
        {
            function test(A $obj)
            {
                return $obj->test(5);
            }
        }

        $objB = new B;
        $objC = new C;
        $objD = new D;
        $objE = new E;

        echo '<h3>1. Анализ использования абстрактных функций</h3>';
        echo '<b>test(B)</b> -> ' . $objD->test($objB) . '<br>';
        echo '<b>test(C)</b> -> ' . $objD->test($objC) . '<br>';
        echo '<b>test(E)</b> -> ' . $objD->test($objE) . '<br>';
        echo '<br><hr><br>';
        ?>
    </section>
</main>
</body>
</html>