<?php

namespace PrivatCoolLib;

class Exchange
{
    private $from;
    private $to;
    private $amount;

    public function __construct($from, $to, $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }

    public function toDecimal()
    {
        $exchange = $this->getActualCurrenciesData();
        if ($exchange['ccy'] == $this->from) {
            $result = $exchange['sale'] * $this->amount;
        } else {
            $result = $this->amount / $exchange['buy'];
        }
        return number_format($result, 2);
    }

    private function getActualCurrenciesData()
    {
        $json = file_get_contents("https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11");
        $exchanges = json_decode($json, true);
        return array_filter($exchanges, function($exchange) {
            return (in_array($this->from, $exchange) and in_array($this->to, $exchange));
        })[0];
    }
}
