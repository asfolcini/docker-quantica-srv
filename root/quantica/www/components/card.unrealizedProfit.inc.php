<div class="card">
    <div id="unrealizedProfitColor" class="card-line bg-primary"></div>
    <div class="card-body text-center">
      <h4 class="card-title"><span id="unrealizedProfit">0.00</span> <span class="small"><?php echo $SETTINGS_currency?></span></h4>
      <p class="small text-muted text-uppercase">Unrealized Profit</p>
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
        
    setInterval(ajax_UNREALIZEDPROFIT_getData, updTime);
    
    function ajax_UNREALIZEDPROFIT_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              
              const obj = JSON.parse(data);
    
              document.getElementById("unrealizedProfit").innerHTML = new Intl.NumberFormat(locale).format(obj.unrealizedProfit);
              if (obj.unrealizedProfit>0)
                document.getElementById("unrealizedProfitColor").setAttribute("class", "card-line bg-success");
              else
                document.getElementById("unrealizedProfitColor").setAttribute("class", "card-line bg-danger");
          }
        });
    }        
</script>