<?php
    include(__DIR__."/Core/bootstrap.php");
    $dataBTC = Historic::getHistoric("btc");
    $eje_x= array();
    $eje_y= array();
    $totalBTC_MXN = 0;
    $totalXRP_MXN = 0;
    foreach($dataBTC as $item){
      $eje_x[] = $item["x"];
      $eje_y[] = $item["y"];
      $totalBTC_MXN = $item["y"];
      $last_date_btc = $item["x"];
    }
    $dataXRP = Historic::getHistoric("xrp");
    $eje_x_xrp = array();
    $eje_y_xrp = array();
    foreach($dataXRP as $itemXRP){
      $eje_x_xrp[] = $itemXRP["x"];
      $eje_y_xrp[] = $itemXRP["y"];
      $totalXRP_MXN = $itemXRP["y"];
      $last_date_xrp = $itemXRP["x"];
    }
    $total = $totalBTC_MXN+$totalXRP_MXN;
    $btcEarned = Historic::getCryptoEarn("btc");
    $xrpEarned = Historic::getCryptoEarn("xrp");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
            rel=stylesheet type="text/css">
    </head>
    <body>
      <input type="hidden" id="last_date_btc" value="<?= $last_date_btc; ?>" />
      <input type="hidden" id="last_date_xrp" value="<?= $last_date_xrp; ?>" />
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <canvas id="canvas"></canvas>
          </div>
          <div class="col-md-6">
            <canvas id="canvas2"></canvas>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

              <h2 class="text-left">Data</h2>
              <small id="last-update" class="text-right align-text-top text-muted">Last update: <?= date("j/M/Y G:i:s", strtotime($last_date_xrp)); ?></small>

            <hr>
            <div class="row">
              <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                  <div class="card-body">
                    <h4 class="card-title">Coins Owned</h4>
                    <p class="card-text">
                      <dl class="row">
                        <dd class="col-sm-6">BTC</dd>
                        <dt class="col-sm-6"><?= $btcEarned[0]['value']; ?></dt>
                        <dd class="col-sm-6">XRP</dd>
                        <dt class="col-sm-6"><?= $xrpEarned[0]['value']; ?></dt>
                        <dd>&nbsp;</dd>
                      </dl>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                  <div class="card-body">
                    <h4 class="card-title">Original Investment</h4>
                    <p class="card-text">
                      <dl class="row">
                        <dd class="col-sm-6">BTC</dd>
                        <dt class="col-sm-6">$ <?= ORIGINAL_INVESTMENT_BTC_ON_MXN; ?> MXN</dt>
                        <dd class="col-sm-6">XRP</dd>
                        <dt class="col-sm-6">$ <?= ORIGINAL_INVESTMENT_XRP_ON_MXN; ?> MXN</dt>
                        <dd>&nbsp;</dd>
                      </dl>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                  <div class="card-body">
                    <h4 class="card-title">Updated Values</h4>
                    <p class="card-text">
                      <dl class="row">
                        <dd class="col-sm-3">BTC</dd>
                        <dt id="btn_mxn" class="col-sm-9">$ <?= $totalBTC_MXN; ?> MXN</dt>
                        <dd class="col-sm-3">XRP</dd>
                        <dt id="xrp_mxn" class="col-sm-9">$ <?= $totalXRP_MXN; ?> MXN</dt>
                        <dd class="col-sm-3">Total</dd>
                        <dt id="total_mxn" class="col-sm-9">$ <?= $total; ?> MXN</dt>
                      </dl>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
      <script>
        var btnLabels = <?= json_encode($eje_x); ?>;
        var btnData   = <?=  str_replace('"', "", json_encode($eje_y));?>;
        var xrpLabels = <?= json_encode($eje_x_xrp); ?>;
        var xrpData   = <?=  str_replace('"', "", json_encode($eje_y_xrp));?>;
      </script>
      <script src="js/chart-script.js"></script>
      <script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.4/moment.min.js"></script>
      <script src="js/update-data.js"></script>
    </body>
</html>
