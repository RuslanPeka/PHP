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
        <h3>Классы и объекты. Часть 2</h3>
    </div>
</header>
<main>
    <section class="work">
        <?php

        abstract class Vehicles
        {
            protected $vehiclesAll = [
                'passengerCar_sedan' => 'Mercedes',
                'passengerCar_hatchback' => 'Audi',
            ];

            abstract public function listOfVehicles();
        }

        // 1) Создание интерфейсов: типа кузова (Bodywork); колёсная формула (Wheels); тип двигателя (Engine); тип коробки передач (Transmission)
        interface Bodywork
        {
            public function kindOfBodywork();
        }

        interface Wheels
        {
            public function numOfWheels();
        }

        interface Engine
        {
            public function kindOfEngine();
        }

        interface Transmission
        {
            public function kindOfTransmission();
        }

        // 2) Создание трейта расчёта мощности двигателя, в зависимости от расхода воздуха (P = G / 3), где P - мощность, G - расход в-ха
        trait EnginePower
        {
            public function powerOfEngine($consumption)
            {
                echo 'При расходе воздуха равном <b>' . $consumption . '</b> (кг) мощность двигателя составляет: <b>' . ($consumption / 3) . '</b> лошадиных сил';
            }
        }

        class PassengerCars extends Vehicles implements Bodywork, Wheels, Engine, Transmission
        {
            use EnginePower;

            public function kindOfBodywork()
            {
                $cars = $this->vehiclesAll;
                foreach($cars as $type => $kind) {
                    if(mb_substr_count($type, 'sedan') > 0) echo 'У автомобиля <b>' . $kind . '</b> тип кузова - седан<br>';
                    if(mb_substr_count($type, 'hatchback') > 0) echo 'У автомобиля <b>' . $kind . '</b> тип кузова - хэтчбек<br>';
                }
            }

            public function numOfWheels()
            {
                $cars = $this->vehiclesAll;
                foreach($cars as $type => $kind) {
                    if(mb_substr_count($type, 'sedan') > 0) echo 'У автомобиля <b>' . $kind . '</b> количество колёс - 4<br>';
                    if(mb_substr_count($type, 'hatchback') > 0) echo 'У автомобиля <b>' . $kind . '</b> количество колёс - 4<br>';
                }
            }

            public function kindOfEngine()
            {
                $cars = $this->vehiclesAll;
                foreach($cars as $type => $kind) {
                    if($kind == 'Mercedes') echo 'У автомобиля <b>' . $kind . '</b> двигатель - Mercedes-AMG M156<br>';
                    if($kind == 'Audi') echo 'У автомобиля <b>' . $kind . '</b> двигатель - Audi 4.2 FSI<br>';
                }
            }

            public function kindOfTransmission()
            {
                $cars = $this->vehiclesAll;
                foreach($cars as $type => $kind) {
                    if($kind == 'Mercedes') echo 'У автомобиля <b>' . $kind . '</b> коробка передач - Автоматическая<br>';
                    if($kind == 'Audi') echo 'У автомобиля <b>' . $kind . '</b> коробка передач - Ручная<br>';
                }
            }

            public function listOfVehicles()
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

        /*
            Вывод результатов
        */

        // 1. Реализация интерфейса Bodywork
        echo '<h3>1. Тип кузова:</h3>';
        $car = new PassengerCars;
        $car->kindOfBodywork();
        echo '<br><hr><br>';

        // 2. Реализация интерфейса Wheels
        echo '<h3>2. Количество колёс:</h3>';
        $car->numOfWheels();
        echo '<br><hr><br>';

        // 3. Реализация интерфейса Engine
        echo '<h3>3. Тип двигателя:</h3>';
        $car->kindOfEngine();
        echo '<br><hr><br>';

        // 4. Реализация интерфейса Engine
        echo '<h3>4. Тип двигателя:</h3>';
        $car->kindOfTransmission();
        echo '<br><hr><br>';

        // 5. Реализация трейта
        echo '<h3>5. Расчёт мощности двигателя:</h3>';
        $car->powerOfEngine(1950);
        echo '<br><br><hr><br>';

        ?>
    </section>
</main>
</body>
</html>