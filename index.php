<?php
    // Функционал на этапе, когда БД ещё нет и необходимо её создать
    class dbWork
    {
        public $config;
        public $conn;
        public $table;

        public function __construct()
        {
            $this->config = require_once 'configDb.php';
            $this->table = require_once 'configTables.php';
        }

        public function connection()
        {
            $this->conn = new mysqli($this->config['driver'], $this->config['user'], $this->config['pass']);
            if(!$this->conn) {
                die('Ошибка подключения к БД: ' . $this->conn->connect_error . '<br>');
            } else {
                echo 'Подключение к локальному серверу прошло успешно.<br>';
            }
        }

        public function checkDb()
        {
            if(!$this->conn->select_db($this->config['dbName'])) {
                $result = false;
            } else {
                $result = true;
            }
            return $result;
        }

        public function createDb()
        {
            if($this->checkDb() === false) {
                $query = 'CREATE DATABASE ' . $this->config['dbName'];
                if(!$this->conn->query($query)) {
                    echo 'Ошибка создания БД: ' . $this->conn->error . '<br>';
                } else {
                    echo 'База данных под названием <b>' . $this->config['dbName'] . '</b> успешно создана!<br>';
                }
            } else {
                echo 'База данных под названием <b>' . $this->config['dbName'] . '</b> уже существует!<br>';
            }
        }

        public function prepareDb()
        {
            $this->connection();
            $this->createDb();
            $this->conn = new mysqli($this->config['driver'], $this->config['user'], $this->config['pass'], $this->config['dbName']);
        }

        public function checkTable(string $tableName)
        {
            $query = 'SHOW TABLES FROM `' . $this->config['dbName'] . '` like \'' . $tableName . '\';';
            $data = $this->conn->query($query);
            $data = mysqli_fetch_array($data);
            if(!empty($data[0])) $result = true;
            else $result = false;
            return $result;
        }

        public function createGoodsTable()
        {
            $tableName = $this->table['goodsTable'];
            if($this->checkTable($tableName) == false) {
                $query = 'CREATE TABLE `' . $tableName . '` (
                `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                `name` VARCHAR(50) NOT NULL, 
                `description` VARCHAR(200) NOT NULL, 
                `price` FLOAT(10) NOT NULL, 
                `create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
                `update_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                )';
                if(!$this->conn->query($query)) {
                    echo 'Ошибка создания таблицы: ' . $this->conn->error . '<br>';
                } else {
                    echo 'Таблица создана успешно!<br>';
                }
            } else {
                echo 'Таблица под названием <b>' . $tableName . '</b> уже существует.<br>';
            }
        }

        public function createCustomersTable()
        {
            $tableName = $this->table['customersTable'];
            if($this->checkTable($tableName) == false) {
                $query = 'CREATE TABLE `' . $tableName . '` (
                `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                `login` VARCHAR(20) NOT NULL,
                `pass` VARCHAR(50) NOT NULL,
                `name` VARCHAR(50),
                `e_mail` VARCHAR(50) NOT NULL,
                `age` INT(3) NOT NULL,
                `orders_id` INT(10),
                `create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `update_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                )';
                if(!$this->conn->query($query)) {
                    echo 'Ошибка создания таблицы: ' . $this->conn->error . '<br>';
                } else {
                    echo 'Таблица создана успешно!<br>';
                }
            } else {
                echo 'Таблица под названием <b>' . $tableName . '</b> уже существует.<br>';
            }
        }

        public function createOrdersTable()
        {
            $tableName = $this->table['ordersTable'];
            if($this->checkTable($tableName) == false) {
                $query = 'CREATE TABLE `' . $tableName . '` (
                `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `number` INT(11) NOT NULL,
                `user_id` INT(11) NOT NULL,
                `good_id` INT(11) NOT NULL,
                `cost` FLOAT(12) NOT NULL,
                `payment_id` INT(11) NOT NULL,
                `create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `update_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                )';
                if(!$this->conn->query($query)) {
                    echo 'Ошибка создания таблицы: ' . $this->conn->error . '<br>';
                } else {
                    echo 'Таблица создана успешно!<br>';
                }
            } else {
                echo 'Таблица под названием <b>' . $tableName . '</b> уже существует.<br>';
            }
        }

        public function createPaymentsTable()
        {
            $tableName = $this->table['paymentsTable'];
            if($this->checkTable($tableName) == false) {
                $query = 'CREATE TABLE `' . $tableName . '` (
                `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `number` INT(11) NOT NULL,
                `order_id` INT(11) NOT NULL,
                `sum` FLOAT(12) NOT NULL,
                `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                )';
                if(!$this->conn->query($query)) {
                    echo 'Ошибка создания таблицы: ' . $this->conn->error . '<br>';
                } else {
                    echo 'Таблица создана успешно!<br>';
                }
            } else {
                echo 'Таблица под названием <b>' . $tableName . '</b> уже существует.<br>';
            }
        }

        public function prepareTables()
        {
            $this->createGoodsTable();
            $this->createCustomersTable();
            $this->createOrdersTable();
            $this->createPaymentsTable();
        }

        public function fillingGoods()
        {
            $tableName = $this->table['goodsTable'];
            $query = [
                "INSERT INTO `goods` (`name`, `description`, `price`) VALUES ('Bicycle', 'Vehicle', '1500')",
                "INSERT INTO `goods` (`name`, `description`, `price`) VALUES ('Milk', 'Food', '20')",
                "INSERT INTO `goods` (`name`, `description`, `price`) VALUES ('S.T.A.L.K.E.R.', 'Game', '800')",
                "INSERT INTO `goods` (`name`, `description`, `price`) VALUES ('Owl', 'It is cool!', '4000')",
                "INSERT INTO `goods` (`name`, `description`, `price`) VALUES ('Bentley', 'The best car', '9000000')",
            ];
            foreach($query as $value) {
                if (!$this->conn->query($value)) {
                    echo 'Ошибка добавления записи в таблицу ' . $tableName . ': ' . $this->conn->error . '<br>';
                } else {
                    echo 'Запись успешно добавлена в таблицу ' . $tableName . '!<br>';
                }
            }
        }

        public function fillingCustomers()
        {
            $tableName = $this->table['customersTable'];
            $query = [
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('yarick', '123456', 'Yarick', 'yarick@ukr.net', '21')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('liza', '123456', 'Liza', 'liza@ukr.net', '28')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('dima', '123456', 'Dima', 'dima@ukr.net', '40')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('sveta', '123456', 'Sveta', 'sveta@ukr.net', '34')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('tolick', '123456', 'Tolick', 'tolick@ukr.net', '102')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('marina', '123456', 'Marina', 'marina@ukr.net', '9')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('johncena', '123456', 'JohnCena', 'jc@ukr.net', '43')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('johncena', '123456', 'JohnCena', 'jc@ukr.net', '43')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('margotrobbie', '123456', 'MargotRobbie', 'mr@ukr.net', '30')",
                "INSERT INTO `customers` (`login`, `pass`, `name`, `e_mail`, `age`) VALUES ('margotrobbie', '123456', 'MargotRobbie', 'mr@ukr.net', '30')",
            ];
            foreach($query as $value) {
                if (!$this->conn->query($value)) {
                    echo 'Ошибка добавления записи в таблицу ' . $tableName . ': ' . $this->conn->error . '<br>';
                } else {
                    echo 'Запись успешно добавлена в таблицу ' . $tableName . '!<br>';
                }
            }
        }

        public function fillingOrders()
        {
            $tableName = $this->table['ordersTable'];
            $query = [
                "INSERT INTO `orders` (`number`, `user_id`, `good_id`, `cost`) VALUES ('10001', '7', '7', '20')",
                "INSERT INTO `orders` (`number`, `user_id`, `good_id`, `cost`) VALUES ('10002', '10', '8', '800')",
                "INSERT INTO `orders` (`number`, `user_id`, `good_id`, `cost`) VALUES ('10003', '5', '9', '4000')",
                "INSERT INTO `orders` (`number`, `user_id`, `good_id`, `cost`) VALUES ('10004', '6', '10', '9000000')",
                "INSERT INTO `orders` (`number`, `user_id`, `good_id`, `cost`) VALUES ('10005', '1', '6', '1500')",
            ];
            foreach($query as $value) {
                if (!$this->conn->query($value)) {
                    echo 'Ошибка добавления записи в таблицу ' . $tableName . ': ' . $this->conn->error . '<br>';
                } else {
                    echo 'Запись успешно добавлена в таблицу ' . $tableName . '!<br>';
                }
            }
        }

        public function fillingPayments()
        {
            $tableName = $this->table['paymentsTable'];
            $query = [
                "INSERT INTO `payments` (`number`, `order_id`, `sum`) VALUES ('1', '1', '20')",
                "INSERT INTO `payments` (`number`, `order_id`, `sum`) VALUES ('2', '3', '4000')",
                "INSERT INTO `payments` (`number`, `order_id`, `sum`) VALUES ('3', '4', '9000000')",
            ];
            foreach($query as $value) {
                if (!$this->conn->query($value)) {
                    echo 'Ошибка добавления записи в таблицу ' . $tableName . ': ' . $this->conn->error . '<br>';
                } else {
                    echo 'Запись успешно добавлена в таблицу ' . $tableName . '!<br>';
                }
            }
        }

        public function fillingTables()
        {
            $this->fillingGoods();
            $this->fillingCustomers();
            $this->fillingOrders();
            $this->fillingPayments();
        }

        public function allOrdersByCustomer(int $num)
        {
            $query = 'SELECT `orders`.`id`, `customers`.`name`, `goods`.`name` AS `good` FROM `orders` INNER JOIN `customers`, `goods` WHERE `user_id` = ' . $num . ' AND `orders`.`user_id` = `customers`.`id` AND `orders`.`good_id` = `goods`.`id`';
            $result = $this->conn->query($query);
            if (!$result) {
                echo 'Ошибка выборки из таблицы ' . $tableName . ': ' . $this->conn->error . '<br>';
            } else {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                echo 'Заказчик: <b>' . $row['name'] . '</b> офирмил заказ(ы) на следующий(е) товар(ы): <b>' . $row['good'] . '</b><br>';
            }
        }

        public function sumOfAllOrders()
        {
            $query = 'SELECT sum(`orders`.`cost`) AS `sum` FROM `orders`';
            $result = $this->conn->query($query);
            if (!$result) {
                echo 'Ошибка выборки из таблицы ' . $tableName . ': ' . $this->conn->error . '<br>';
            } else {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                echo 'Общая сумма заказов составляет: <b>' . $row['sum'] . ' грн</b><br>';
            }
        }

        public function searchOfDublicatedCustomers()
        {
            $query = 'SELECT DISTINCT `customers`.`name` FROM `customers` WHERE `name` IN (SELECT `name` FROM `customers` GROUP BY `name` HAVING COUNT(*) > 1) ORDER BY `name`';
            $result = $this->conn->query($query);
            if (!$result) {
                echo 'Ошибка выборки из таблицы ' . $tableName . ': ' . $this->conn->error . '<br>';
            } else {
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo '<pre>';
                    print_r($row['name']);
                    echo '</pre>';
                }
            }
        }

        public function paidOrders()
        {
            $query = 'SELECT `orders`.`id`, `orders`.`number`, `payments`.`date` FROM `orders` INNER JOIN `payments` WHERE `orders`.`payment_id` = `payments`.`id`';
            $result = $this->conn->query($query);
            if (!$result) {
                echo 'Ошибка выборки из таблицы ' . $tableName . ': ' . $this->conn->error . '<br>';
            } else {
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo '<pre>';
                    echo 'Заказ <b>№ ' . $row['number'] . '</b> оплачен ' . $row['date'] . '<br>';
                    // print_r($row['number']);
                    echo '</pre>';
                }
            }
        }
    }
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
        <h1>Курс PHP - Занятие №7</h1>
    </div>
    <div class="header_second_line">
        <h3>Работа с базами данных</h3>
    </div>
</header>
<main>
    <section class="work">
        <?php
        
        // 1. Установка соединения
        echo '<h3>1. Установка соединения и подготовка БД</h3>';
        $db = new dbWork();
        $db->prepareDb();      // Прошло успешно
        echo '<br><hr><br>';

        // 2. Создание таблиц: Товары (goods), Контрагенты (customers), Заказы (orders) и Оплаты (payments)
        echo '<h3>2. Создание таблиц</h3>';
        $db->prepareTables();
        echo '<br><hr><br>';

        // 3. Заполнение таблиц данными
        echo '<h3>3. Заполнение таблиц</h3>';
        echo 'Прошло успешно!';
        // $db->fillingTables();
        echo '<br><hr><br>';

        // 4. Реализация выборок
        echo '<h3>4. Выборка всех заказов по одному из контрагентов</h3>';
        $db->allOrdersByCustomer(7);
        echo '<br><hr><br>';

        echo '<h3>5. Выборка по сумме всех заказов на контрагентов</h3>';
        $db->sumOfAllOrders();
        echo '<br><hr><br>';

        echo '<h3>6. Выборка дубликатов контрагентов</h3>';
        $db->searchOfDublicatedCustomers();
        echo '<br><hr><br>';

        echo '<h3>7. Выборка оплаченнных заказов</h3>';
        $db->paidOrders();
        echo '<br><hr><br>';


        ?>
    </section>
</main>
</body>
</html>