<?php

namespace Classes;

abstract class GoodsFromUSA
{
    /**
     *  Currency of the Cost and Delivery - USA ($).
     *  Tax is indicated as a percentage of the Cost.
     */
    protected $data = array();
    protected $product = 'Ford Mustang Mach-E';
    protected $cost = 43000;

    public function __construct()
    {
        $this->data = require_once 'configs/dataConfig.php';
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getCost()
    {
        return $this->cost;
    }

    abstract public function taxAccounting(float $tax);

    abstract public function deliveryAccounting(float $cost, float $delivery);

    abstract public function currencyСonversion(float $cost, float $currency);

    abstract public function preparePrice();
}