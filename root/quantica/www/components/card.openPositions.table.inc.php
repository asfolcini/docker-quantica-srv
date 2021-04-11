<div class="card">
    <div id="openPositionsColor" class="card-line bg-secondary"></div>
        <div class="card-body text-left m-1 p-1">
            <div class="mt-1 mb-1">
                <div class="row m-0 p-0">
                    <div class="col-5 col-sm-8 text-left m-0 p-0">
                        <p class="text-muted text-uppercase m-0 p-0">Open Positions</p>
                    </div>
                    <div class="col-4 col-sm-3 text-muted text-right m-0 p-0">
                        <p class="small m-0 p-0">#<span id="openPositions_totalPositions">0</span>  Total PnL &nbsp;<span class="small"><?php echo $SETTINGS_currency?></span></p>
                    </div>
                    <div class="col-3 col-sm-1 text-muted text-right m-0 p-0">
                        <p class="small m-0 p-0"><span id="openPositions_totalPNL">0.00</span></p>
                    </div>
                </div>
            </div>
            <table id="openPositions_table" class="table table-hover table-condensed m-0 p-0">
              <thead>
                <tr>
                  <!--<th class="small text-muted m-0 p-1" scope="col">tsystem</th>-->
                  <th class="small text-muted m-0 p-1" scope="col">strategy</th>
                  <th class="small text-muted m-0 p-1" scope="col">type</th>
                  <th class="small text-muted m-0 p-1" scope="col">date</th>
                  <th class="small text-muted m-0 p-1" scope="col">symbol</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">qty</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">avgPrice</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">mktPrice</th>
                  <th class="small text-muted m-0 p-1 text-right" width="15%" scope="col">PnL <?php echo $SETTINGS_currency?></th>
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
        
    setInterval(ajax_OPENPOSITIONS_getData, updTime);
    
    function ajax_OPENPOSITIONS_getData(){
       $.ajax({
          type:"post",
          url:"api/positionsData.php",
          data: { runID : '<?php echo $runID?>',
                  type : 'OPEN' },
          datatype:"json",
          success:function(data) {
              
            const obj = JSON.parse(data);

            $("#openPositions_table tr:has(td)").remove();
            $.each(obj.positions, function(i, item) {
                    if (item.PnL>=0)
                        class_color = 'text-success';
                    else
                        class_color = 'text-danger';
                        
                    var $tr = $('<tr>').append(
                        //$('<td class="small">').text(item.runID),
                        $('<td class="small">').text(item.strategy),
                        $('<td class="small">').text(item.type),
                        $('<td class="small">').text(item.openDate),
                        $('<td class="small">').text(item.symbol),
                        $('<td class="small text-right">').text(item.qty),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(item.avgPrice)),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(item.mktPrice)),
                        $('<td class="small text-right '+class_color+'">').text(new Intl.NumberFormat(locale).format(item.PnL)),
                        $('</tr>')
                    );
                    $('#openPositions_table').append($tr);
                });
            
            // TOTAL POSITIONS
            document.getElementById("openPositions_totalPositions").innerHTML = new Intl.NumberFormat(locale).format(obj.totalPositions);
            // TOTAL PNL
            document.getElementById("openPositions_totalPNL").innerHTML = new Intl.NumberFormat(locale).format(obj.totalPnL);
              if (obj.totalPnL>=0)
                document.getElementById("openPositions_totalPNL").setAttribute("class", "text-success");
              else
                document.getElementById("openPositions_totalPNL").setAttribute("class", "text-danger");
    
            if (obj.totalPnL>=0)
                document.getElementById("openPositionsColor").setAttribute("class", "card-line bg-success");
              else
              document.getElementById("openPositionsColor").setAttribute("class", "card-line bg-danger");
          }
        });
    }        
</script>