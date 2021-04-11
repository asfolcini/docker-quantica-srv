<p class="text-muted small text-uppercase pb-0 mb-0"><span class="text-lowercase" id="connectionStatus_time"></span>&nbsp;-&nbsp;connection status&nbsp;<i id="connectionStatus" class="fa fa-circle fa-fw text-success"></i></p>  

<script type="text/javascript">
    var updTime = getCookie('updatetime');
    var loca  = getCookie('locale');
    setInterval(ajax_CONNSTATUS_getData, updTime*10);
    setInterval(ajax_CONNSTATUS_getTime, 1000);



    function connectionError(){
          document.getElementById("connectionStatus").setAttribute("class", "fa fa-spinner fa-pulse text-danger");
    }
    
    
    function ajax_CONNSTATUS_getTime(){
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' , hour: 'numeric', minute: 'numeric', second: 'numeric'};
      document.getElementById("connectionStatus_time").innerHTML = new Date().toLocaleDateString(loca, options);
    }
    
    function ajax_CONNSTATUS_getData(){
       $.ajax({
          type:"post",
          url:"api/data.php",
          data: { runID : '<?php echo $runID?>'},
          datatype:"json",
          success:function(data) {
              const obj = JSON.parse(data);
              
              if (obj.connectionStatus=='OK')
                document.getElementById("connectionStatus").setAttribute("class", "fa fa-circle fa-fw text-success");
              else
                connectionError(); 
          },
          error: connectionError()
        });
    }        
</script>