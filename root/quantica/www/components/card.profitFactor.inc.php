<div class="card">
    <div id="profitFactorColor" class="card-line bg-primary"></div>
    <div class="card-body text-center">
      <h4 id="profitFactor" class="card-title">0.00</h4>
          <p class="small text-muted text-uppercase">Profit Factor</p>
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
        
    setInterval(ajax_PROFITFACTOR_getData, updTime);
    
    function ajax_PROFITFACTOR_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              
              const obj = JSON.parse(data);
    
              document.getElementById("profitFactor").innerHTML = new Intl.NumberFormat(locale).format(obj.profitFactor);
              if (Number(obj.profitFactor)>1)
                document.getElementById("profitFactorColor").setAttribute("class", "card-line bg-success");
              else
                if (obj.profitFactor>0)
                    document.getElementById("profitFactorColor").setAttribute("class", "card-line bg-warning");
                else
                    document.getElementById("profitFactorColor").setAttribute("class", "card-line bg-danger");
          }
        });
    }        
</script>