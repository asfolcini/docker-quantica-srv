<div class="card">
    <div id="sharpeRatioColor" class="card-line bg-primary"></div>
    <div class="card-body text-center">
      <h4 id="sharpeRatio" class="card-title">0.00</h4>
          <p class="small text-muted text-uppercase">Sharpe Ratio</p>
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
        
    setInterval(ajax_SHARPERATIO_getData, updTime);
    
    function ajax_SHARPERATIO_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              
              const obj = JSON.parse(data);
    
              document.getElementById("sharpeRatio").innerHTML = new Intl.NumberFormat(locale).format(obj.sharpeRatio);
              if (obj.sharpeRatio>1)
                document.getElementById("sharpeRatioColor").setAttribute("class", "card-line bg-success");
              else
                if (obj.sharpeRatio>0)
                    document.getElementById("sharpeRatioColor").setAttribute("class", "card-line bg-warning");
                else
                    document.getElementById("sharpeRatioColor").setAttribute("class", "card-line bg-danger");
          }
        });
    }        
</script>