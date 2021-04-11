<div class="card">
    <div id="closedPositionsColor" class="card-line bg-secondary"></div>
        <div class="card-body text-left m-1 p-1">
            <div class="mt-1 mb-1">
                <div class="row m-0 p-0">
                    <div class="col-5 col-sm-8 text-left m-0 p-0">
                        <p class="text-muted text-uppercase m-0 p-0">Historical Positions</p>
                    </div>
                    <div class="col-4 col-sm-3 text-muted text-right m-0 p-0">
                        <p class="small m-0 p-0"><span><a href="javascript:void(0);" onclick="downloadCSV();"><i class="fa fa-download fa-xs"></i></a></span>&nbsp;&nbsp;#<span id="closedPositions_totalPositions">0</span>  Total PnL &nbsp;<span class="small"><?php echo $SETTINGS_currency?></span></p>
                    </div>
                    <div class="col-3 col-sm-1 text-muted text-right m-0 p-0">
                        <p class="small m-0 p-0"><span id="closedPositions_totalPNL">0.00</span></p>
                    </div>
                </div>
            </div>
            <table id="closedPositions_table" class="table table-hover table-striped table-condensed m-0 p-0">
              <thead>
                <tr>
                  <!--<th class="small text-muted m-0 p-1" scope="col">tsystem</th>-->
                  <th class="small text-muted m-0 p-1" scope="col">strategy</th>
                  <th class="small text-muted m-0 p-1" scope="col">type</th>
                  <th class="small text-muted m-0 p-1" scope="col">open date</th>
                  <th class="small text-muted m-0 p-1" scope="col">close date</th>
                  <th class="small text-muted m-0 p-1" scope="col">symbol</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">qty</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">avgPrice</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">mktPrice</th>
                  <th class="small text-muted m-0 p-1 text-right" width="15%" scope="col">PnL <?php echo $SETTINGS_currency?></th>
                </tr>
              </thead>
            </table>
            <div class="mt-0 mb-0">
                <div class="row m-0 p-0 text-secondary" style="border-top: 1px solid">
                    <div class="col-12 col-sm-12 text-muted text-center m-0 p-0 pt-2">
                        <a onClick="prev_Page();" href="javascript:void(0);"><i class="fa fa-angle-double-left"></i></a>
                        &nbsp;&nbsp;
                        <span class="small m-0 p-0">page&nbsp;<span id="closedPositions_currentPage">1</span></span>
                        &nbsp;&nbsp;
                        <a onClick="next_Page();" href="javascript:void(0);"><i class="fa fa-angle-double-right"></i></a>
                        
                    </div>
                </div>
            </div>

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
    
    var p_page = 0;
    var p_rowPerPage = 10;
    var max_pages = 99;
    
    function setPage(page){
        p_page = page;
    }
    function prev_Page(){
        if (p_page>0)
            p_page = p_page -1;
    }
    function next_Page(){
        if (p_page<=(max_pages-2))
            p_page = p_page +1;
    }
    
    function downloadCSV(){
        post('/api/downloadPositions.php', {runID: 'FakeTS'});
    }
    
        
    setInterval(ajax_CLOSEDPOSITIONS_getData, updTime);
    
    function ajax_CLOSEDPOSITIONS_getData(){
       $.ajax({
          type:"post",
          url:"api/positionsData.php",
          data: { runID : '<?php echo $runID?>',
                  type : 'CLOSED',
                  page : p_page,
                  rowPerPage : p_rowPerPage
          },
          datatype:"json",
          success:function(data) {
              
            const obj = JSON.parse(data);

            $("#closedPositions_table tr:has(td)").remove();
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
                        $('<td class="small">').text(item.closeDate),
                        $('<td class="small">').text(item.symbol),
                        $('<td class="small text-right">').text(item.qty),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(item.avgPrice)),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(item.mktPrice)),
                        $('<td class="small text-right '+class_color+'">').text(new Intl.NumberFormat(locale).format(item.PnL)),
                        $('</tr>')
                    );
                    $('#closedPositions_table').append($tr);
                });
            
            // TOTAL POSITIONS
            document.getElementById("closedPositions_totalPositions").innerHTML = new Intl.NumberFormat(locale).format(obj.totalPositions);
            // TOTAL PNL
            document.getElementById("closedPositions_totalPNL").innerHTML = new Intl.NumberFormat(locale).format(obj.totalPnL);
              if (obj.totalPnL>=0)
                document.getElementById("closedPositions_totalPNL").setAttribute("class", "text-success");
              else
                document.getElementById("closedPositions_totalPNL").setAttribute("class", "text-danger");
    
            if (obj.totalPnL>=0)
                document.getElementById("closedPositionsColor").setAttribute("class", "card-line bg-success");
              else
              document.getElementById("closedPositionsColor").setAttribute("class", "card-line bg-danger");
              
              
              max_pages = Math.ceil(Number(obj.totalPositions) / Number(p_rowPerPage));
              document.getElementById("closedPositions_currentPage").innerHTML = Number(p_page)+1+'/'+Number(max_pages);
              
          }
        });
    }        
</script>