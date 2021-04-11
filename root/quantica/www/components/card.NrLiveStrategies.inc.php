<div class="card">
    <div id="NrLiveStrategiesColor" class="card-line bg-primary"></div>
    <div class="card-body text-center">
      <h4 id="NrLiveStrategies" class="card-title"><strong>0</strong></h4>
          <p class="small text-muted text-uppercase">Active Strategies</p>
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
        
    setInterval(ajax_LIVESTRATEGIES_getData, updTime*10);
    
    function ajax_LIVESTRATEGIES_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              
              const obj = JSON.parse(data);
    
              document.getElementById("NrLiveStrategies").innerHTML = new Intl.NumberFormat(locale).format(obj.liveStrategies);
              if (obj.liveStrategies>0)
                document.getElementById("NrLiveStrategiesColor").setAttribute("class", "card-line bg-success");
              else
                document.getElementById("NrLiveStrategiesColor").setAttribute("class", "card-line bg-primary");
          }
        });
    }        
</script>