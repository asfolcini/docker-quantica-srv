<?php
    $id=uniqid(); // this way you can use more than one card at the same time
?>
<div class="card">
    <div id="rssFeed-<?php echo $id?>" class="card-line bg-secondary"></div>
        <div class="card-body text-left m-1 p-1">
            <div class="mt-1 mb-1">
                <div class="row m-0 p-0">
                    <div class="col-4 col-sm-4 text-left m-0 p-0">
                        <p class="text-muted text-uppercase m-0 p-0">NEWS</p>
                    </div>
                    <div class="col-8 col-sm-8 text-muted text-right m-0 p-0">
                        <p class="small m-0 p-0"><span id="rssTitle-<?php echo $id?>"></span>&nbsp;&nbsp;<i class="fa fa-circle-o text-success"></i></p>
                    </div>
                </div>
            </div>

            <table id="news_table-<?php echo $id?>" class="table table-hover table-condensed m-0 p-0">
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
    var timezone = getCookie('timezone');
    if (isEmpty(updTime))
        updTime = 500;
    if (isEmpty(locale))
        locale = 'it-IT';        

    var newsPerPage = <?php echo $newsPerPage?>;
    var urlRss      = '<?php echo $urlRss?>';
    
    setInterval(ajax_GETNEWS_<?php echo $id?>(urlRss,newsPerPage), updTime*10);

    function ajax_GETNEWS_<?php echo $id?>(url,limit){
        fetch(url).then((res) => {
          res.text().then((xmlTxt) => {
            var domParser = new DOMParser()
            let doc = domParser.parseFromString(xmlTxt, 'text/xml')
            
            var rssTitle = doc.querySelectorAll('channel').item(0).querySelector('title').textContent;
            if (rssTitle!='')
                document.getElementById('rssTitle-<?php echo $id?>').innerHTML = rssTitle;
                
            for(var i=0;i<doc.querySelectorAll('item').length;i++){
                        
                item = doc.querySelectorAll('item').item(i);

                time_row = '<span class="text-muted small">'+new Date(item.querySelector('pubDate').textContent).toLocaleString(locale, {timeZone: timezone})+'</span>';
                html_row = '<a href="'+item.querySelector('link').textContent+'" target="new">'+item.querySelector('title').textContent+'</a>';

                var $tr = $('<tr>').append(
                    $('<td class="small text-left">'+time_row),
                    $('<td class="small text-left">'+html_row),
                    $('</tr>')
                );
                $('#news_table-<?php echo $id?>').append($tr); 
                 
                if (i>=(limit-1)) {
                    break;
                }
             }
         })
        })
    };

    
</script>