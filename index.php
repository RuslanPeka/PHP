<?php
    use Classes\PurchaseInCN;
    use Classes\PurchaseInDE;
    use Classes\PurchaseInUA;
    use Classes\PurchaseInUK;
    require_once "vendor/autoload.php";
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
        <h1>Курс PHP - Занятие №15</h1>
    </div>
    <div class="header_second_line">
        <h3>Чистый код</h3>
    </div>
</header>
<main>
    <section class="work">
        <form action="" method="post">
            <h2>Доставка автомобилей США в другие страны!</h2>
            <p>Оценка стоимости автомобиля <b>Ford Mustang Mach-E.</b></p>
            <p><b>Выбирите, пожалуйста, страну доставки:</b></p>
            <select name="country" id="">
                <option value="CN">Китай</option>
                <option value="DE">Германия</option>
                <option value="UA">Украина</option>
                <option value="UK">Великобритания</option>
            </select>
            <button type="submit">Проверить!</button>
            <br><br><h6>Обратите внимание, что мы делаем доставку только в страны, указанные в перечне.<br>
            На данный момент мы работаем над расширением зоны сотрудничества. Приносим извинения за неудобство.</h6><br><hr><br>
        </form>
        <?php
            if(isset($_POST['country']) && is_string($_POST['country'])) {
                $className = 'Classes\PurchaseIn';

                if($_POST['country'] == 'CN' || $_POST['country'] == 'DE' || $_POST['country'] == 'UA' || $_POST['country'] == 'UK') $className .= $_POST['country'];
                else die('К сожалению, мы не производим доставку в данную страну.');

                $request = new $className;
                $request->responseToRequest();
            }
        ?>
    </section>
</main>
</body>
</html>