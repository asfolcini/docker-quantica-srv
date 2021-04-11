
<style>
a.disabled {
  pointer-events: none;
  cursor: default;
  text-decoration: underline;
}    
</style>

<div class="card">
    <div id="chartReturns" class="card-line bg-secondary"></div>
    <div class="card-body m-1 p-1">
        <div class="mt-1">
            <div class="row m-0 p-0">
                <div class="col-6 text-left m-0 p-0"><p class="text-muted text-uppercase m-0 p-0">Returns</p></div>
                <div class="col-6 small text-muted text-right m-0 p-0">
                    <a href="#"  id="bar_day"   onClick="setBarChartType('DAY');">DAY</a> | 
                    <a href="#"  id="bar_week"  onClick="setBarChartType('WEEK');">WEEK</a> | 
                    <a href="#"  id="bar_month" onClick="setBarChartType('MONTH');" class="disabled">MONTH</a> | 
                    <a href="#"  id="bar_year"  onClick="setBarChartType('YEAR');">YEAR</a></div>
            </div>
        </div>
        <hr class="bg-secondary m-2">

        <canvas id="chart-returns-canvas" width="300" height="150" class="chartjs-render-monitor" style="display: block; width: 300px; height: 150px;"></canvas>
    
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
var barChartType = 'MONTH';
// create chart first 
var barChart = drawBarChartReturns();
// build it immediatly
ajax_UPDATEBARCHART_getData();
// then set the update timeer
setInterval(ajax_UPDATEBARCHART_getData, updTime*10);

function setBarChartType(ctype){
    barChartType = ctype;
    document.getElementById('bar_day').setAttribute("class", "");
    document.getElementById('bar_week').setAttribute("class", "");
    document.getElementById('bar_month').setAttribute("class", "");
    document.getElementById('bar_year').setAttribute("class", "");
    document.getElementById('bar_'+ctype.toLowerCase()).setAttribute("class", "disabled");
    ajax_UPDATEBARCHART_getData();
}
    
function ajax_UPDATEBARCHART_getData(){
   $.ajax({
      type:"post",
      url:"api/barchartReturnsData.php",
      data: { type : barChartType,
              runID : '<?php echo $runID?>'
      },
      datatype:"json",
      success:function(data) {
              const obj = JSON.parse(data);
              updateBarChartReturns(obj.labels,obj.dataset);
          }
    });
}        

function updateBarChartReturns(v_labels,v_dataset){
    barChart.data.labels = v_labels;
    barChart.data.datasets[0].data = v_dataset;
    barChart.update();
}

function drawBarChartReturns(){
 return new Chart(
    document.getElementById('chart-returns-canvas'),
    {
      type:'bar',
          data:{
                  labels: 0,
                  datasets:[
                              {
                                yAxisID : 'y-axis-0',
                                backgroundColor:'rgba(104, 193, 117, 0.5)',
                                borderColor:'rgba(220, 220, 220, 0.8)',
                                highlightFill:'rgba(220, 220, 220, 0.75)',
                                highlightStroke:'rgba(220, 220, 220, 1)',
                                data: 0
                              }
                              
                            ]
          },
          options:{
                    responsive:true,
                    legend: {display: false}
          },
          plugins: [{
              beforeDraw: function(c) {
                 var data = c.data.datasets[0].data;
                 for (let i in data) {
                    let bar = c.data.datasets[0]._meta['0'].data[i]._model;
                    if (data[i] > 0) {
                       bar.backgroundColor = 'rgb(104, 193, 117)';
                    } else bar.backgroundColor = 'rgb(255, 153, 153)';
                 }
              }
          }]
          
        });
    }
    
</script>