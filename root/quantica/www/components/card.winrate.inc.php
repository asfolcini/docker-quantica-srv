<div class="card">
    <div id="winRateColor" class="card-line"></div>
        <div class="card-body text-center">
            <p class="small text-muted text-uppercase mt-0 mb-2">Win Rate</p>
            <h4 class="card-title"><span id="winrate_value">0.00</span> <span class="small">%</span></h4>
            <div class="progress progress-xs mt-0 mb-4 bg-danger">
                <div id="winrate_bar" class="progress-bar bg-success" role="progressbar"></div>
            </div>
            <table class="table table-condensed m-0 p-0 mt-1">
                <tr><td class="text-left text-muted small">Total</td>  <td id="winrate_totTrades" class="text-right text-muted small">0</td></tr>
                <tr><td class="text-left text-muted small">Winner</td> <td id="winrate_win" class="text-right text-muted small">0</td></tr>
                <tr><td class="text-left text-muted small">Odds</td>   <td id="winrate_odd"class="text-right text-muted small">0</td></tr>
                <tr><td class="text-left text-muted small">Losers</td> <td id="winrate_loss" class="text-right text-muted small">0</td></tr>
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

ajax_WINRATECHART_getData();
// then set the update timeer
setInterval(ajax_WINRATECHART_getData, updTime*10);

function ajax_WINRATECHART_getData(){
   $.ajax({
      type:"post",
      url:"api/data.php",
      data: { runID : '<?php echo $runID?>'},
      datatype:"json",
      success:function(data) {
              const obj = JSON.parse(data);
              
              totTrades = Number(obj.winTrades) + Number(obj.lossTrades) + Number(obj.oddTrades);
              value = (Number(obj.winTrades) / Number(totTrades))*100;
              
              
              document.getElementById("winrate_bar").style['width'] = value+'%';
              document.getElementById("winrate_value").innerHTML = new Intl.NumberFormat(locale).format(value.toFixed(2));
              document.getElementById("winrate_totTrades").innerHTML = new Intl.NumberFormat(locale).format(totTrades);
              document.getElementById("winrate_win").innerHTML = new Intl.NumberFormat(locale).format(obj.winTrades);
              document.getElementById("winrate_odd").innerHTML = new Intl.NumberFormat(locale).format(obj.oddTrades);
              document.getElementById("winrate_loss").innerHTML = new Intl.NumberFormat(locale).format(obj.lossTrades);
              if (value>50)
                document.getElementById("winRateColor").setAttribute("class", "card-line bg-success");
              else
                document.getElementById("winRateColor").setAttribute("class", "card-line bg-danger");
              
          }
    });
}        
</script>
