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
        <h3>Классы</h3>
    </div>
</header>
<main>
    <section class="work">
        <?php

        // 1. Создание абстрактного класса - Животные (Animals)
        abstract class Animals
        {
            protected $animalsAll = [
                'predator1' => 'Lion',
                'predator2' => 'Tiger',
                'predator3' => 'Wolf',
                'herbivorous1' => 'Elephant',
                'herbivorous2' => 'Cow',
                'herbivorous3' => 'Hare',
            ];

            abstract function listOfAnimals();
        }

        // 2. Создание абстрактного класса - Транспортные средства (Vehicles)
        abstract class Vehicles
        {
            protected $vehiclesAll = [
                'boat1' => 'RedBoat',
                'boat2' => 'BlueBoat',
                'passengerCar1' => 'Mercedes',
                'passengerCar2' => 'Audi',
                'truck1' => 'MAN',
                'truck2' => 'Scania',
            ];

            abstract function listOfVehicles();
        }

        // 3. Создание наследников от животных - хищники (Predators), травоядные (Herbivores)
        class Predators extends Animals
        {
            function listOfAnimals()
            {
                $animals = $this->animalsAll;
                foreach($animals as $type => $kind) {
                    echo $type . ' => ' . $kind . '<br>';
                }
            }

            public function listOfPredators()
            {
                $animals = $this->animalsAll;
                foreach($animals as $type => $kind) {
                    if(mb_substr_count($type, 'predator') > 0) echo $type . ' => ' . $kind . '<br>';
                }
            }
        }

        class Herbivores extends Animals
        {
            function listOfAnimals()
            {
                $animals = $this->animalsAll;
                foreach($animals as $type => $kind) {
                    echo $type . ' => ' . $kind . '<br>';
                }
                        
            }
        
            public function listOfHerbivores()
            {
                $animals = $this->animalsAll;
                foreach($animals as $type => $kind) {
                    if(mb_substr_count($type, 'herbivorous') > 0) echo $type . ' => ' . $kind . '<br>';
                }
            }
        }

        // 4. Создание наследников от транспортных средств - лодки (Boats), легковые авто (PassengerCars), грузовики (Trucks)
        class Boats extends Vehicles
        {
            function listOfVehicles()
            {
                $vehicles = $this->vehiclesAll;
                foreach($vehicles as $type => $kind) {
                    echo $type . ' => ' . $kind . '<br>';
                }
            }

            public function listOfBoats()
            {
                $vehicles = $this->vehiclesAll;
                foreach($vehicles as $type => $kind) {
                    if(mb_substr_count($type, 'boat') > 0) echo $type . ' => ' . $kind . '<br>';
                }
            }
        }

        class PassengerCars extends Vehicles
        {
            function listOfVehicles()
            {
                $vehicles = $this->vehiclesAll;
                foreach($vehicles as $type => $kind) {
                    echo $type . ' => ' . $kind . '<br>';
                }
            }

            public function listOfPassengerCars()
            {
                $vehicles = $this->vehiclesAll;
                foreach($vehicles as $type => $kind) {
                    if(mb_substr_count($type, 'passengerCar') > 0) echo $type . ' => ' . $kind . '<br>';
                }
            }
        }

        class Trucks extends Vehicles
        {
            function listOfVehicles()
            {
                $vehicles = $this->vehiclesAll;
                foreach($vehicles as $type => $kind) {
                    echo $type . ' => ' . $kind . '<br>';
                }
            }

            public function listOfTrucks()
            {
                $vehicles = $this->vehiclesAll;
                foreach($vehicles as $type => $kind) {
                    if(mb_substr_count($type, 'truck') > 0) echo $type . ' => ' . $kind . '<br>';
                }
            }
        }

        // 5. Реализации всех наследников первого уровня созданы в соответствующих классха

        // 6. Хелпер, работающий с массивами
        class ArrayHelp
        {
            static function ArrayPrint(array $array)
            {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        }

        // 7. Хелпер, работающий со строками
        class StringHelp
        {
            static function StringBold(string $str)
            {
                echo '<b>' . $str . '</b>';
            }
        }

        /*
            Вывод результатов
        */

        // 1) Проверка работоспособности вывода списка всех животных
        echo '<b>1. Список всех животных:</b><br>';
        $predators = new Predators;
        $predators->listOfAnimals();        // Метод отработал верно
        echo '<br><hr><br>';

        // 2) Проверка работоспособности вывода списка всех хищников
        echo '<b>2. Список всех хищников:</b><br>';
        $predators->listOfPredators();      // Метод отработал верно
        echo '<br><hr><br>';

        // 3) Проверка работоспособности вывода списка всех животных
        echo '<b>3. Список всех травоядных:</b><br>';
        $herbivores = new Herbivores;
        $herbivores->listOfHerbivores();    // Метод отработал верно
        echo '<br><hr><br>';

        // 4) Проверка работоспособности вывода списка всех транспортных средств
        echo '<b>4. Список всех транспортных средств:</b><br>';
        $boats = new Boats;
        $boats->listOfVehicles();           // Метод отработал верно
        echo '<br><hr><br>';

        // 5) Проверка работоспособности вывода списка всех лодок
        echo '<b>5. Список всех лодок:</b><br>';
        $boats->listOfBoats();              // Метод отработал верно
        echo '<br><hr><br>';

        // 6) Проверка работоспособности вывода списка всех легковых автомобилей
        echo '<b>6. Список всех легковых автомобилей:</b><br>';
        $passengerCar = new PassengerCars;
        $passengerCar->listOfPassengerCars();       // Метод отработал верно
        echo '<br><hr><br>';

        // 7) Проверка работоспособности вывода списка всех грузовиков
        echo '<b>7. Список всех грузовиков:</b><br>';
        $trucks = new Trucks;
        $trucks->listOfTrucks();                    // Метод отработал верно
        echo '<br><hr><br>';

        // 8) Проверка работоспособности хелпера для работы с массивами
        $countries = [
            'NorthAmerica1' => 'USA',
            'NorthAmerica2' => 'Сanada',
            'Europe1' => 'Germany',
            'Europe2' => 'France',
            'Asia1' => 'China',
            'Asia2' => 'South Korea',
        ];
        echo '<b>8. Пример работы хелпера для работы с массивами:</b><br>';
        ArrayHelp::ArrayPrint($countries);          // Отработал верно
        echo '<br><hr><br>';

        // 9) Проверка работоспособности хелпера для работы со строками
        $someString = 'Я учусь создавать web-сайты.';
        echo '<b>9. Пример работы хелпера для работы со строками:</b><br>';
        StringHelp::StringBold($someString);        // Отработал верно
        echo '<br><br><hr><br>';

        ?>
    </section>
</main>
</body>
</html>