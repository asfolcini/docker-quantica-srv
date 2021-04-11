<div class="card">
    <div id="realizedProfitColor" class="card-line bg-primary"></div>
    <div class="card-body text-center">
      <h4 class="card-title"><span id="realizedProfit">0.00</span> <span class="small"><?php echo $SETTINGS_currency?></span></h4>
      <p class="small text-muted text-uppercase">Realized Profit</p>
    </div>
 </div>

<script type="text/javascript" src="assets/js/functions.min.js"></script>
<script type="text/javascript">
    var updTime = getCookie('updatetime');
    var locale  = getCookie('numericFormat');
    if (isEmpty(updTime))
        updTime = 500;
    if (isEmpty(locale))
        locale = 'it-IT';        
        
    setInterval(ajax_REALIZEDPROFIT_getData, updTime);
    
    function ajax_REALIZEDPROFIT_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              
              const obj = JSON.parse(data);
    
              document.getElementById("realizedProfit").innerHTML = new Intl.NumberFormat(locale).format(obj.realizedProfit);
              if (obj.realizedProfit>0)
                document.getElementById("realizedProfitColor").setAttribute("class", "card-line bg-success");
              else
                document.getElementById("realizedProfitColor").setAttribute("class", "card-line bg-danger");
          }
        });
    }        
</script>