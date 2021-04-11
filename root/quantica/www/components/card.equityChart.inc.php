
<style>
a.disabled {
  pointer-events: none;
  cursor: default;
  text-decoration: underline;
}    
</style>

<div class="card">
    <div id="chartEquity" class="card-line bg-secondary"></div>
    <div class="card-body m-1 p-1">
        <div class="mt-1">
            <div class="row m-0 p-0">
                <div class="col-6 text-left m-0 p-0"><p class="text-muted text-uppercase m-0 p-0">EQUITY</p></div>
                <div class="col-6 small text-muted text-right m-0 p-0">
                    <a href="#"  id="equity_all" onClick="setEquityChartType('ALL');">ALL</a> | 
                    <a href="#"  id="equity_ytd"  onClick="setEquityChartType('YTD');">YTD</a> | 
                    <a href="#"  id="equity_1y"   onClick="setEquityChartType('1Y');" class="disabled" >1Y</a> | 
                    <a href="#"  id="equity_6m"   onClick="setEquityChartType('6M');">6M</a> |
                    <a href="#"  id="equity_3m"   onClick="setEquityChartType('3M');">3M</a> |
                    <a href="#"  id="equity_1m"   onClick="setEquityChartType('1M');">1M</a></div>
            </div>
        </div>
        <hr class="bg-secondary m-2">

        <canvas id="chart-equity-canvas" width="300" height="150" class="chartjs-render-monitor" style="display: block; width: 300px; height: 150px;"></canvas>
    
    </div>
</div>

<script type="text/javascript" src="assets/js/functions.min.js"></script>
<script language="javascript">

var updTime = getCookie('updatetime');
var locale  = getCookie('numericFormat');
if (isEmpty(updTime))
    updTime = 500;
if (isEmpty(locale))
    locale = 'it-IT';  

// setting default barchart type
var equityChartType = '1Y';
// create chart first 
var equityChart = drawEquityChartReturns();
// build it immediatly
ajax_UPDATEEQUITYCHART_getData();
// then set the update timeer
setInterval(ajax_UPDATEEQUITYCHART_getData, updTime*10);

function setEquityChartType(ctype){
    equityChartType = ctype;
    document.getElementById('equity_all').setAttribute("class", "");
    document.getElementById('equity_ytd').setAttribute("class", "");
    document.getElementById('equity_1y').setAttribute("class", "");
    document.getElementById('equity_6m').setAttribute("class", "");
    document.getElementById('equity_3m').setAttribute("class", "");
    document.getElementById('equity_1m').setAttribute("class", "");
    document.getElementById('equity_'+ctype.toLowerCase()).setAttribute("class", "disabled");
    ajax_UPDATEEQUITYCHART_getData();
}
    
function ajax_UPDATEEQUITYCHART_getData(){
   $.ajax({
      type:"post",
      url:"api/equityChartData.php",
      data: { runID : '<?php echo $runID?>',
              type  : equityChartType
            },
      datatype:"json",
      success:function(data) {
              const obj = JSON.parse(data);
              updateEquityChartReturns(obj.labels,obj.dataset);
          }
    });
}        

function updateEquityChartReturns(v_labels,v_dataset){
    equityChart.data.labels = v_labels;
    equityChart.data.datasets[0].data = v_dataset;
    equityChart.update();
}

function drawEquityChartReturns(){
 return new Chart(
    document.getElementById('chart-equity-canvas'),
    {
      type:'line',
          data:{
                  labels: 0,
                  datasets:[
                              {
                                yAxisID : 'y-axis-0',
                                //backgroundColor:'rgb(104, 193, 117)',
                                borderColor:'rgba(104, 193, 117, 0.5)',
                                highlightFill:'rgba(220, 220, 220, 0.75)',
                                highlightStroke:'rgba(220, 220, 220, 1)',
                                fill: true,
                                pointRadius:2,
                                pointBackgroundColor: '#black',
                                steppedLine: false,
                                data: 0
                              }
                              
                            ]
          },
          options:{
                    responsive:true,
                    legend: {display: false}
          }

        });
    }
    
</script>
