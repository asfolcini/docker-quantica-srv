<div class="card">
    <div id="liveStrategiesColor" class="card-line bg-secondary"></div>
        <div class="card-body text-left m-1 p-1">
            <div class="mt-1 mb-1">
                <div class="row m-0 p-0">
                    <div class="col-10 col-sm-11 text-left m-0 p-0">
                        <p class="text-muted text-uppercase m-0 p-0">LIVE TRADING SYSTEMS</p>
                    </div>
                    <div class="col-2 col-sm-1 text-muted text-right m-0 p-0">
                        <p class="small m-0 p-0"><span><a href="javascript:void(0);" onclick="downloadCSV();"><i class="fa fa-download fa-xs"></i></a></p>
                    </div>
                </div>
            </div>
            <table id="liveStrategies_table" class="table table-hover table-condensed m-0 p-0">
              <thead>
                <tr>
                  <th colspan="2" class="small text-muted m-0 p-1 text-center" scope="col">System ID</th>
                  <th class="small text-muted m-0 p-1 text-center" scope="col"></th>
                  <th class="small text-muted m-0 p-1 text-center" scope="col">Broker</th>
                  <th class="small text-muted m-0 p-1 text-center" scope="col">Algos</th>
                  <th class="small text-muted m-0 p-1 text-center" scope="col">lastUpdate</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Balance <?php echo $SETTINGS_currency?></th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Invested <?php echo $SETTINGS_currency?></th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Realized PnL</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Return</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Sharpe Ratio</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Profit Factor</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Open Trades</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Unrealized PnL</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">Trades</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col">WinRate</th>
                  <th class="small text-muted m-0 p-1 text-right" scope="col"></th>
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

    /** ------------------------------------------------------------------------
     * STOP SYSTEM 
     */
    function downloadCSV(){
        post('/api/downloadSystems.php', {mode: 'LIVE'});
    }
    
    /** ------------------------------------------------------------------------
     * STOP SYSTEM 
     */
    function stopSystem(runID){
        if ('<?php echo strtoupper($_SESSION['AUTH'])?>'!='view'.toUpperCase()){
            bootbox.confirm({
                message: "Are you sure to STOP the execution of system ["+runID+"] ?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result){
                          // CALL API
                             $.ajax({
                              type:"put",
                              url:"<?php echo $SETTINGS_ENDPOINT_STOP?>",
                              data: JSON.stringify({ 
                                        "runID": runID,
                                        "auth": "<?php echo $SETTINGS_API_KEY ?>"
                              }),
                              datatype:"json",
                              contentType: 'application/json',
                              success:function(data) {
                                     if (!data.stopped)
                                        alert(data.message);
                              },
                              error:function(e){
                                  console.log(e);
                              }
                             });
                             // ------------
                    }
                }
            });
        }else{
            bootbox.alert("Your authorization level is read-only, you cannot perform this operation!");
        }
    }
    
    /** ------------------------------------------------------------------------
     * START SYSTEM 
     */
    function startSystem(runID){
        if ('<?php echo strtoupper($_SESSION['AUTH'])?>'!='view'.toUpperCase()){
            bootbox.confirm({
                message: "START the execution of system ["+runID+"], are you sure?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result){
                          // CALL API
                             $.ajax({
                              type:"put",
                              url:"<?php echo $SETTINGS_ENDPOINT_START?>",
                              data: JSON.stringify({ 
                                        "runID": runID,
                                        "mode": "LIVE",
                                        "auth": "<?php echo $SETTINGS_API_KEY ?>"
                              }),
                              datatype:"json",
                              contentType: 'application/json',
                              success:function(data) {
                                     if (!data.started)
                                        alert(data.message);
                              },
                              error:function(e){
                                  console.log(e);
                              }
                             });
                             // ------------
                    }
                }
            });
        }else{
            bootbox.alert("Your authorization level is read-only, you cannot perform this operation!");
        }
    }
    
    /** ------------------------------------------------------------------------
     * GO TO DASHBOARD
     */
    function openDashboard(runID,mode){
        post('dashboard.php',{ runID, mode },'POST');
    }
    
    /** ------------------------------------------------------------------------
     * REMOVE SYSTEM FROM DASHBOARD
     */
    function removeDashboard(runID,status){
        if ('<?php echo strtoupper($_SESSION['AUTH'])?>'!='view'.toUpperCase()){
            if (status=='RUNNING'){
              bootbox.alert("System must be stopped first.");  
            }else{
                bootbox.confirm({
                    message: "All system ["+runID+"] data will be lost, are you sure?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        if (result){
                             // CALL API REMOVE
                             $.ajax({
                              type:"post",
                              url:"api/post.php",
                              data: { 
                                        action: 'REMOVE_SYSTEM',
                                        runID: runID
                              },
                              datatype:"json",
                              success:function(data) {
                                  if (data!='0'){
                                      alert('Error while trying to delete data, pls try again.');
                                  }
                              }
                             });
                             // ------------
                        }
                    }
                });
            }
        }else{
            bootbox.alert("Your authorization level is read-only, you cannot perform this operation!");
        }        
        
    }
        
    setInterval(ajax_LIVESYSTEMS_getData, updTime);
    
    function ajax_LIVESYSTEMS_getData(){
       $.ajax({
          type:"post",
          url:"api/systemsData.php",
          data: { mode : 'LIVE' },
          datatype:"json",
          success:function(data) {
              
            const obj = JSON.parse(data);

            $("#liveStrategies_table tr:has(td)").remove();
            $.each(obj, function(i, item) {
                    if (item.unrealizedPnL>=0)
                        class_color = 'text-success';
                    else
                        class_color = 'text-danger';
                    if (item.returnOnAccount>=0)
                        roa_class_color = 'text-success';
                    else
                        roa_class_color = 'text-danger';
                    if (item.sharpeRatio>=0)
                        sr_class_color = 'text-success';
                    else
                        sr_class_color = 'text-danger';
                    if (item.profitFactor>=0)
                        pf_class_color = 'text-success';
                    else
                        pf_class_color = 'text-danger';
                    if (item.realizedProfit>=0)
                        rp_class_color = 'text-success';
                    else
                        rp_class_color = 'text-danger';
                    if (item.unrealizedProfit>=0)
                        up_class_color = 'text-success';
                    else
                        up_class_color = 'text-danger';
                    if (item.status == 'RUNNING')
                        html_status = '<a href="javascript:void(0);" onClick="stopSystem(\''+item.runID+'\')"><i class="fa fa-circle fa-fw fa-lg text-success icon_over"></i></a>';
                    else
                        html_status = '<a href="javascript:void(0);" onClick="startSystem(\''+item.runID+'\')"><i class="fa fa-circle fa-fw fa-lg text-danger icon_over"></i></a>';
                    
                    
                    html_dashboard = '<a href="javascript:void(0);" onClick="openDashboard(\''+item.runID+'\',\''+item.mode+'\')"><i class="fa fa-tachometer fa-fw fa-lg text-info icon_over"></i></a>';    
                    html_delete = '<a href="javascript:void(0);" onClick="removeDashboard(\''+item.runID+'\',\''+item.status+'\')"><i class="fa fa-trash fa-fw fa-xs text-muted icon_over"></i></a>';    
                    
                        
                    var totTrades = parseInt(item.winTrades) + parseInt(item.oddTrades) + parseInt(item.lossTrades);
                    var winRate = (parseInt(item.winTrades) / parseInt(totTrades) ) * 100;    

                    var $tr = $('<tr>').append(
                        $('<td class="small text-left">&nbsp;&nbsp;'+html_status),
                        $('<td class="small">').text(item.runID),
                        $('<td class="small text-left">'+html_dashboard),
                        $('<td class="small text-center">').text(item.brokerDescription),
                        $('<td class="small text-center">').text(item.liveStrategies),
                        $('<td class="small">').text(item.lastUpdate.substr(0,item.lastUpdate.indexOf('.'))),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(item.accountBalance)),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(item.investedAmount)),
                        $('<td class="small text-right '+rp_class_color+'">').text(new Intl.NumberFormat(locale).format(item.realizedProfit)),
                        $('<td class="small text-right '+roa_class_color+'">').text(new Intl.NumberFormat(locale).format(item.returnOnAccount)+'%'),
                        $('<td class="small text-right '+sr_class_color+'">').text(new Intl.NumberFormat(locale).format(item.sharpeRatio)),
                        $('<td class="small text-right '+pf_class_color+'">').text(new Intl.NumberFormat(locale).format(item.profitFactor)),
                        $('<td class="small text-right '+pf_class_color+'">').text(new Intl.NumberFormat(locale).format(item.NrOpenPositions)),
                        $('<td class="small text-right '+up_class_color+'">').text(new Intl.NumberFormat(locale).format(item.unrealizedProfit)),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(totTrades)),
                        $('<td class="small text-right">').text(new Intl.NumberFormat(locale).format(winRate.toFixed(2))+'%'),
                        $('<td class="small text-right text-muted">'+html_delete),
                        $('</tr>')
                    );
                    $('#liveStrategies_table').append($tr);
                });
            
          }
        });
    }        
</script>