<?php

namespace Classes;

use Classes\GoodsFromUSA;

class PurchaseInDE extends GoodsFromUSA
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
        $this->getInfo();
        $result = $this->taxAccounting($this->tax['Germany']);
        $result = $this->deliveryAccounting($result, $this->delivery['Germany']);
        $result = $this->currencyСonversion($result, $this->currencyСonversions['Germany']);
        return $result;
    }

    public function responseToRequest()
    {
        echo 'Уважаемый клиент, Вы можете купить автомобиль <b>' . $this->product . '</b> сделав предзаказ у нас!<br>';
        echo 'Cтоимость в США: <b>' . $this->cost . ' $</b>.<br>';
        echo 'Стоимость в Вашей стране, с учётом доставки: <b>' . $this->preparePrice() . ' ' . $this->currencyMarks['Germany'] . '</b>.';
    } 
}