<?php

class simpleXML {

    private $buy;
    private $sale;
    private $postHas;
    private $postNeed;
    private $postMoney;

    /*
     * если у нас руб евро или долар мы сначала все
     * переводим в грн..(yourUAH)..бо только его курс дает
     * дает нам приват-банк
     */
    private $yourUAH;
    private $result;

    const URL = 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5';

    function __construct($has, $need, $money) {
        $this->postHas = $has;
        $this->postNeed = $need;
        $this->postMoney = trim($money);
    }

    function convert() {
        $this->postMoney = floatval($this->postMoney);
        switch ($this->postHas) {
            case ('RUR'):
                $this->yourUAH = $this->postMoney * $this->buy['RUR'];
                break;
            case ('EURO'):
                $this->yourUAH = $this->postMoney * $this->buy['EURO'];
                break;
            case ('$'):
                $this->yourUAH = $this->postMoney * $this->buy['$'];
                break;
            case ('UAH'):
                $this->yourUAH = $this->postMoney;
                break;
        }

        switch ($this->postNeed) {
            case ('RUR'):
                $this->result = round($this->yourUAH / $this->sale['RUR'], 2);
                break;
            case ('EURO'):
                $this->result = round($this->yourUAH / $this->sale['EURO'], 2);
                break;
            case ('$'):
                $this->result = round($this->yourUAH / $this->sale['$'], 2);
                break;
            case ('UAH'):
                $this->result = $this->yourUAH;
                break;
        }
    }

    function showResult() {
        if ($this->postNeed !== 'RUR') {
            if ($this->result < 10)
                echo '<h2>your money: ' . $this->result . ' ' . $this->postNeed . '(you must work better) <h2>';
            elseif ($this->result < 1000)
                echo '<h2>your money: ' . $this->result . ' ' . $this->postNeed . '(not bad) <h2>';
            else
                echo '<h2>your money: ' . $this->result . ' ' . $this->postNeed . '(you working too much, meet with family) <h2>';
        }
        else echo 'error';
    }

    function parseXml() {
        $XML = file_get_contents(self::URL);
        $exchangerates = new SimpleXMLElement($XML);
        $same = $exchangerates->row;

        $this->buy['RUR'] = floatval($same[0]->exchangerate['buy']);
        $this->sale['RUR'] = floatval($same[0]->exchangerate['sale']);
        $this->buy['EURO'] = floatval($same[1]->exchangerate['buy']);
        $this->sale['EURO'] = floatval($same[1]->exchangerate['sale']);
        $this->buy['$'] = floatval($same[2]->exchangerate['buy']);
        $this->sale['$'] = floatval($same[2]->exchangerate['sale']);
    }

}

if ($_POST) {
    if (is_numeric($_POST['money']) && $_POST['money'] > 0) {
        $sXML = new simpleXML($_POST['have'], $_POST['need'], $_POST['money']);
        $sXML->parseXml();
        $sXML->convert();
        $sXML->showResult();
    } else {
        echo 'Введите положительное число';
    }
}

