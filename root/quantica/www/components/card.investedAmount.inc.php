<div class="card">
    <div id="investedAmountColor" class="card-line bg-primary"></div>
        <div class="card-body text-center">
            <h4 class="card-title"><span id="investedAmount">0.00</span> <span class="small"><?php echo $SETTINGS_currency?></span></h4>
            <p class="small text-muted text-uppercase">Invested Amount</p>
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
        
    setInterval(ajax_INVESTEDAMOUNT_getData, updTime);
    
    function ajax_INVESTEDAMOUNT_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              
              const obj = JSON.parse(data);
    
              document.getElementById("investedAmount").innerHTML = new Intl.NumberFormat(locale).format(obj.investedAmount);
              if (obj.investedAmount==0)
                document.getElementById("investedAmountColor").setAttribute("class", "card-line bg-success");
              else
                document.getElementById("investedAmountColor").setAttribute("class", "card-line bg-warning");
          }
        });
    }        
</script>