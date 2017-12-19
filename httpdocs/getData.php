<?php
  include(__DIR__."/Core/bootstrap.php");
  $cryptoId  = $_POST['cryptoId'];
  $lastValue = Historic::getLastHistoric($cryptoId);
  if($lastValue)
    echo json_encode($lastValue);
  else
    echo 0;
