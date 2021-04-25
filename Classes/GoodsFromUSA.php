<?php

namespace Classes;

abstract class GoodsFromUSA
{
    /**
     *  Currency of the Cost and Delivery - USA ($).
     *  Tax is indicated as a percentage of the Cost.
     */
    protected $product = 'Ford Mustang Mach-E';
    protected $cost = 43000;
    protected $currencyСonversions = array();
    protected $currencyMarks = array();
    protected $delivery = array();
    protected $tax = array();

    public function __construct()
    {
        $this->currencyСonversions = require_once 'info/currencyСonversions.php';
        $this->currencyMarks = require_once 'info/currencyMarks.php';
        $this->delivery = require_once 'info/delivery.php';
        $this->tax = require_once 'info/taxes.php';
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getCost()
    {
        return $this->price;
    }

    abstract public function taxAccounting(float $tax);

    abstract public function deliveryAccounting(float $cost, float $delivery);

    abstract public function currencyСonversion(float $cost, float $currency);

    abstract public function preparePrice();
}