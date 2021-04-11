<div class="card">
    <div id="tradingSystems" class="card-line bg-secondary"></div>
        <div class="card-body text-left m-1 p-1">
            <div class="mt-1 mb-1">
                <div class="row m-0 p-0">
                    <div class="col-8 col-sm-10 text-left m-0 p-0">
                        <p class="text-muted text-uppercase m-0 p-0">ALGOS</p>
                    </div>
                    <div class="col-4 col-sm-2 text-muted text-right m-0 p-0">
                        <p class="small m-0 p-0">Total #<span id="tradingSystems_total">0</span></p>
                    </div>
                </div>
            </div>
            <table id="tradingSystems_table" class="table table-hover table-condensed m-0 p-0">
              <thead>
                <tr>
                  <th colspan="2" class="small text-muted m-0 p-1" scope="col">strategy</th>
                  <th class="small text-muted m-0 p-1" scope="col">start date</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">open</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">trades</th>
                  <th class="small text-muted m-0 p-1 text-right" width="20%" scope="col">PnL <?php echo $SETTINGS_currency?></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
</div>

<style>
    .table td, .table th {
        padding: .1rem;
}

</style>

<script type="text/javascript" src="assets/js/functions.min.js"></script>
<script type="text/javascript">
    var updTime = getCookie('updatetime');
    var locale  = getCookie('numericFormat');
    if (isEmpty(updTime))
        updTime = 500;
    if (isEmpty(locale))
        locale = 'it-IT';        
        
    setInterval(ajax_tradingSystems_getData, updTime);
    
    function ajax_tradingSystems_getData(){
       $.ajax({
          type:"post",
          url:"api/tradingSystemsData.php",
          data: { runID : '<?php echo $runID?>' },
          datatype:"json",
          success:function(data) {
              
            const obj = JSON.parse(data);

            $("#tradingSystems_table tr:has(td)").remove();
            $.each(obj, function(i, item) {
                    if (item.PnL>=0)
                        class_color = 'text-success';
                    else
                        class_color = 'text-danger';
                    
                    if (item.status=='RUNNING')
                        cog_color='fa-circle text-success';
                    else
                        cog_color='fa-circle-o text-danger';
                        
                    var $tr = $('<tr>').append(
                        $('<td class="small text-center"><a href="#" onClick="stopStrategy(\''+item.runID+'\');"><i class="fa '+cog_color+'"></i></a></td>'),
                        //$('<td class="small">').text(item.runID),
                        $('<td class="small">').text(item.strategy),
                        $('<td class="small">').text(item.date),
                        $('<td class="small text-right">').text(item.activeTrades),
                        $('<td class="small text-right">').text(item.trades),
                        $('<td class="small text-right '+class_color+'">').text(new Intl.NumberFormat(locale).format(item.PnL)),
                        $('</tr>')
                    );
                    $('#tradingSystems_table').append($tr);
                });
            
            // TOTAL POSITIONS
            document.getElementById("tradingSystems_total").innerHTML = new Intl.NumberFormat(locale).format(obj.length);

          }
        });
    }      
    
    function stopStrategy(runID){
        alert('Open Modal, check if ADMIN or USER and confirm for STOP/START TS '+runID);
    }
</script>