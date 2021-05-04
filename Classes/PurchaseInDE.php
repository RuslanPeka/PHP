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
        $result = $this->taxAccounting($this->data['tax']['Germany']);
        $result = $this->deliveryAccounting($result, $this->data['delivery']['Germany']);
        $result = $this->currencyСonversion($result, $this->data['currencyСonversions']['Germany']);
        return $result;
    }

    public function responseToRequest()
    {
        echo 'Уважаемый клиент, Вы можете купить автомобиль <b>' . $this->product . '</b> сделав предзаказ у нас!<br>';
        echo 'Cтоимость в США: <b>' . $this->cost . ' $</b>.<br>';
        echo 'Стоимость в Вашей стране, с учётом доставки: <b>' . $this->preparePrice() . ' ' . $this->data['currencyMarks']['Germany'] . '</b>.';
    } 
}