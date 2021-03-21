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
        <h1>Курс PHP - Занятие №6</h1>
    </div>
    <div class="header_second_line">
        <h3>Пространства имён, Трейты и Интерфейсы, Магические методы</h3>
    </div>
</header>
<main>
    <section class="work">
        <?php
        // Магические методы:
        // 1) __construct()     - Срабатывает при создании объекта
        // 2) __destruct()      - Срабатывает при завершении жизненного цикла объекта
        // 3) __get()           - Вызов переменной
        // 4) __set()           - Задание переменной
        // 5) __call()          -
        // 6) __callstatic()    -
        // 7) __serialize()     - Представление класса в виде набора значений массивов
        // 8) __unserialize()   - Функция, обратная __serialize()
        // 9) __invoke()        - Выполнение функции по имени класса
        echo '<h3>1. Пример реализации интерфейса и трейта</h3>';
        interface Animal
        {
            public function getType():string;
            public function getColor():string;
            public function getEat():string;
        }

        interface Area
        {
            public function getArea():string;
        }

        class Alligator implements Animal, Area
        {
            protected $type = 'predator';
            protected $color = 'green';
            protected $eat = 'meat';
            protected $area = 'water';

            public function getType():string
            {
                return $this->type;
            }

            public function getColor():string
            {
                return $this->color;
            }

            public function getEat():string
            {
                return $this->eat;
            }

            public function getArea():string
            {
                return $this->area;
            }
        }

        class Pig implements Animal, Area
        {
            protected $type = 'omnivorous';
            protected $color = 'yellow';
            protected $eat = 'grass';
            protected $area = 'earth';

            public function getType():string
            {
                return $this->type;
            }

            public function getColor():string
            {
                return $this->color;
            }

            public function getEat():string
            {
                return $this->eat;
            }

            public function getArea():string
            {
                return $this->area;
            }
        }

        class Peggy extends Pig
        {

        }

        trait Test
        {
            public function sum(int $a, int $b):int
            {
                return $a + $b;
            }

            public function percent(int $a, int $b):int
            {
                return ($a / $b) * 100;
            }
        }

        class Math
        {
            use Test;

            public function __call($name, $arguments)
            {
                var_export('function name:' . $name);
                var_export($arguments);
            }
        }

        $obj = new Math;
        echo $obj->sum(2, 4);

        echo '<br>';

        $obj->test = 10;
        var_export($obj->test);

        echo '<br>';

        $obj->test('Test');
        echo '<br>';
        $obj->test1('Test');
        echo '<br>';
        $obj->test2('Test');

        echo '<br><hr><br>';
        ?>
    </section>
</main>
</body>
</html>