<?php
    class Historic extends Database
    {
        public static function saveData($lastValue, $crpid, $btToMxn){
            try{
              $pdo = Database::getConnection();
              $rs = $pdo->prepare("INSERT INTO historic (crypto_coin_value, crypto_id, mxn_value)
                VALUES (:bcn,:crpid, :mxn)");
              $rs->execute([':bcn'=>$lastValue, ':crpid'=>$crpid, ':mxn'=>$btToMxn]);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public static function getHistoric($cryptoId){
            date_default_timezone_set('America/Mexico_City');
            try{
              $pdo  = Database::getConnection();
              $sql  = "SELECT date as x, mxn_value as y FROM historic WHERE crypto_id = :cryptoId
              AND date BETWEEN '".date("Y-m-d 00:00:00")."' AND now()";
              $stmt = $pdo->prepare($sql);
              $stmt->execute([":cryptoId"=>$cryptoId]);
              $stmt->setFetchMode(PDO::FETCH_ASSOC);
              $result = $stmt->fetchAll();
              return $result;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public static function apiError($code, $msg, $json){

          try{
            $pdo = Database::getConnection();
            $rs = $pdo->prepare("INSERT INTO errors (error_code, error_message, error_json)
              VALUES (:code,:msg, :json)");
            $rs->execute([':code'=>$code, ':msg'=>$msg, ':json'=>$json]);
          }
          catch(PDOException $e){
              echo $e->getMessage();
          }
        }

        public static function saveCryptoEarn($cryptoId, $value){
          try{
            $pdo = Database::getConnection();
            $rs = $pdo->prepare("INSERT INTO crypto_earn (crypto_id, value)
              VALUES (:cryptoId,:value)");
            $rs->execute([':cryptoId'=>$cryptoId, ':value'=>$value]);
          }
          catch(PDOException $e){
              echo $e->getMessage();
          }
        }

        public static function getCryptoEarn($cryptoId){
          try{
            $pdo  = Database::getConnection();
            $sql  = "SELECT value FROM crypto_earn WHERE crypto_id = :cryptoId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":cryptoId"=>$cryptoId]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
          }
          catch(PDOException $e){
              echo $e->getMessage();
          }
        }

        public static function getLastHistoric($cryptoId){
          try{
            $pdo  = Database::getConnection();
            $sql  = "SELECT mxn_value, date from historic WHERE crypto_id=:cryptoId order by id desc limit 1 ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":cryptoId"=>$cryptoId]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
          }
          catch(PDOException $e){
              echo $e->getMessage();
          }
        }

        public static function updateCryptoEarn($cryptoId, $value){
          try{
            $pdo  = Database::getConnection();
            $sql  = "UPDATE crypto_earn SET value = :value WHERE crypto_id = :cryptoId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":value"=>$value, ":cryptoId"=>$cryptoId]);
          }
          catch(PDOException $e){
              echo $e->getMessage();
          }
        }
    }
