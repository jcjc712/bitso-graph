<?php
  include(__DIR__."/Core/bootstrap.php");
  set_time_limit(0);
  $calls   = new Calls();
  $coins = array('btc','xrp');
  foreach($coins as $coin){
  $balance = $calls->getBalance();
    if($balance){
      $balances = $balance->body->payload->balances;
      $coolBalance = array();
      foreach($balances as $itemBalance){
        foreach($itemBalance as $key=>$value){
          if($key != "currency")
            $coolBalance[$itemBalance->currency][$key] = $value;
        }
      }
      $bcnEarn = $coolBalance[$coin]['total'];
      $ticker    = $calls->getTicker();
      if($ticker){
        $tickers = $ticker->body->payload;
        $coolTicker = array();
        foreach($tickers as $itemTicker){
          foreach($itemTicker as $key=>$value){
            if($key != "book")
              $coolTicker[$itemTicker->book][$key] = $value;
          }
        }
        $lastValue = $coolTicker[$coin.'_mxn']['last'];
        $btToMxn   = $lastValue*$bcnEarn;
        if(count (Historic::getCryptoEarn($coin)) > 0){
            Historic::updateCryptoEarn($coin, $bcnEarn);
        }else{
            Historic::saveCryptoEarn($coin, $bcnEarn);
        }
        Historic::saveData($lastValue, $coin, $btToMxn);
      }
    } else{
      echo "error";
    }
  }


?>
