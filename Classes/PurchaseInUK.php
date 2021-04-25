<?php

namespace Classes;

require_once 'GoodsFromUSA.php';

class PurchaseInUK extends GoodsFromUSA
{
    public function taxAccounting(float $tax)
    {
        return ($this->cost + ($this->cost * ($tax / 100)));
    }

    public function deliveryAccounting(float $cost, float $delivery)
    {
        return $cost + $delivery;
    }

    public function currencyСonversion(float $cost, float $currency)
    {
        return $cost *= $currency;
    }

    public function preparePrice()
    {
        $result = $this->taxAccounting($this->tax['The United Kingdom']);
        $result = $this->deliveryAccounting($result, $this->delivery['The United Kingdom']);
        $result = $this->currencyСonversion($result, $this->currencyСonversions['The United Kingdom']);
        return $result;
    }

    public function responseToRequest()
    {
        echo 'Уважаемый клиент, Вы можете купить автомобиль <b>' . $this->product . '</b> сделав предзаказ у нас!<br>';
        echo 'Cтоимость в США: <b>' . $this->cost . ' $</b>.<br>';
        echo 'Стоимость в Вашей стране, с учётом доставки: <b>' . $this->preparePrice() . ' ' . $this->currencyMarks['The United Kingdom'] . '</b>.';
    } 
}