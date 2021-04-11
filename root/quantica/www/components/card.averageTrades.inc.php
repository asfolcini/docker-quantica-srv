<div class="card">
    <div id="averageTradesColor" class="card-line"></div>
        <div class="card-body text-center">
            <p class="small text-muted text-uppercase mt-0 mb-2">Per Trade</p>
            <h4 class="card-title"><span id="averageTrade_value">0.00</span> <span class="small"><?php echo $SETTINGS_currency?></span></h4>
            <div class="progress progress-xs mt-0 mb-0 bg-danger">
                <div id="averageTrade_bar" class="progress-bar bg-success" role="progressbar"></div>
            </div>
            <span class="mt-0 pt-0 text-muted small text-center">avgWin vs avgLoss</span>
            <table class="table table-condensed m-0 p-0 mt-1">
                <tr><td class="text-left text-muted small">Avg Win</td>  <td id="averageTrades_avgWin"class="text-right text-muted small">0</td><td class="small text-left text-muted"><?php echo $SETTINGS_currency?></td></tr>
                <tr><td class="text-left text-muted small">Avg Loss</td> <td id="averageTrades_avgLoss" class="text-right text-muted small">0</td><td class="small text-left text-muted"><?php echo $SETTINGS_currency?></td></tr>
                <tr><td class="text-left text-muted small">Max Win</td>  <td id="averageTrades_maxWin" class="text-right text-muted small">0</td><td class="small text-left text-muted"><?php echo $SETTINGS_currency?></td></tr>
                <tr><td class="text-left text-muted small">Max Loss</td> <td id="averageTrades_maxLoss" class="text-right text-muted small">0</td><td class="small text-left text-muted"><?php echo $SETTINGS_currency?></td>
            </table>
        </div>
</div>

<style>
.progress-xs{
    height: 8px;
}    
.table td, .table th {
    padding: .1rem;
}
</style>

<script type="text/javascript" src="assets/js/functions.min.js"></script>
<script language="javascript">

var updTime = getCookie('updatetime');
var locale  = getCookie('numericFormat');
if (isEmpty(updTime))
    updTime = 500;
if (isEmpty(locale))
    locale = 'it-IT';  

ajax_AVERAGETRADES_getData();
// then set the update timeer
setInterval(ajax_AVERAGETRADES_getData, updTime*10);

function ajax_AVERAGETRADES_getData(){
   $.ajax({
      type:"post",
      url:"api/data.php",
      data: { runID : '<?php echo $runID?>'},
      datatype:"json",
      success:function(data) {
              const obj = JSON.parse(data);
              
              totTrades = Number(obj.winTrades) + Number(obj.lossTrades) + Number(obj.oddTrades);
              value = Number(obj.realizedProfit) / Number(totTrades);
              
              avgWin_pct = (Math.abs(Number(obj.avgWinTrade)) / (Math.abs(Number(obj.avgWinTrade)) + Math.abs(Number(obj.avgLossTrade))))*100;
              
              document.getElementById("averageTrade_bar").style['width'] = avgWin_pct+'%';
              document.getElementById("averageTrade_value").innerHTML = new Intl.NumberFormat(locale).format(value.toFixed(2));
              document.getElementById("averageTrades_maxWin").innerHTML = new Intl.NumberFormat(locale).format(obj.maxWin);
              document.getElementById("averageTrades_maxLoss").innerHTML = new Intl.NumberFormat(locale).format(obj.maxLoss);
              document.getElementById("averageTrades_avgLoss").innerHTML = new Intl.NumberFormat(locale).format(obj.avgLossTrade);
              document.getElementById("averageTrades_avgWin").innerHTML = new Intl.NumberFormat(locale).format(obj.avgWinTrade);
              if (value>=0)
                document.getElementById("averageTradesColor").setAttribute("class", "card-line bg-success");
              else
                document.getElementById("averageTradesColor").setAttribute("class", "card-line bg-danger");
              
              
          }
    });
}        
</script>
