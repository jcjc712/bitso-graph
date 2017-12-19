
window.setInterval(function(){

    $.ajax({
      method: "POST",
      dataType: "json",
      url: "getData.php",
      data: {cryptoId: "btc"}
    }).done(function( msg ) {
      if($("#last_date_btc").val() != msg[0].date){
        addData(myLine, msg[0].date, msg[0].mxn_value);
        $("#last_date_btc").val(msg[0].date);
        $("#btn_mxn").html("$"+msg[0].mxn_value+"MXN");
        var last_update = moment(msg[0].date).format('DD/MMMM/YYYY HH:mm:ss');
        $("#last-update").html("Last update: "+last_update);
      }
    });

    $.ajax({
      method: "POST",
      dataType: "json",
      url: "getData.php",
      data: {cryptoId: "xrp"}
    }).done(function( msg ) {
      if($("#last_date_xrp").val() != msg[0].date){
        addData(myLine2, msg[0].date, msg[0].mxn_value);
        $("#last_date_xrp").val(msg[0].date);
        $("#xrp_mxn").html("$"+msg[0].mxn_value+"MXN");
        var last_update = moment(msg[0].date).format('DD/MMMM/YYYY HH:mm:ss');
        $("#last-update").html("Last update: "+last_update);
      }
    });

    var btn_mxn = $("#btn_mxn").text();
    var xrp_mxn = $("#xrp_mxn").text();
    btn_mxn     = btn_mxn.replace("$","");
    btn_mxn     = btn_mxn.replace("MXN","");
    xrp_mxn     = xrp_mxn.replace("$","");
    xrp_mxn     = xrp_mxn.replace("MXN","");

    var total = parseFloat(btn_mxn) + parseFloat(xrp_mxn);
    $("#total_mxn").html("$"+total+"MXN");
}, 300000);
