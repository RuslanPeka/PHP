<?php

namespace Classes;

use Classes\GoodsFromUSA;

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
        $result = $this->taxAccounting($this->data['tax']['The United Kingdom']);
        $result = $this->deliveryAccounting($result, $this->data['delivery']['The United Kingdom']);
        $result = $this->currencyСonversion($result, $this->data['currencyСonversions']['The United Kingdom']);
        return $result;
    }

    public function responseToRequest()
    {
        echo 'Уважаемый клиент, Вы можете купить автомобиль <b>' . $this->product . '</b> сделав предзаказ у нас!<br>';
        echo 'Cтоимость в США: <b>' . $this->cost . ' $</b>.<br>';
        echo 'Стоимость в Вашей стране, с учётом доставки: <b>' . $this->preparePrice() . ' ' . $this->data['currencyMarks']['The United Kingdom'] . '</b>.';
    } 
}