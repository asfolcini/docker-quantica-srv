<div class="card">
    <div id="returnOnAccountColor" class="card-line bg-primary"></div>
    <div class="card-body text-center">
      <h4 class="card-title"><span id="returnOnAccount">0.00</span> <span class="small">%</span></h4>
      <p class="small text-muted text-uppercase">ACCOUNT RETURN</p>
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
        
    setInterval(ajax_RETURNONACCOUNT_getData, updTime);
    
    function ajax_RETURNONACCOUNT_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              
              const obj = JSON.parse(data);
    
              document.getElementById("returnOnAccount").innerHTML = new Intl.NumberFormat(locale).format(obj.returnOnAccount);
              if (obj.returnOnAccount>0)
                document.getElementById("returnOnAccountColor").setAttribute("class", "card-line bg-success");
              else
                document.getElementById("returnOnAccountColor").setAttribute("class", "card-line bg-danger");
          }
        });
    }        
</script>