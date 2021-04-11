<?php
    
    // THEME TAB
    if (isset($_POST['theme'])){
        setcookie("theme", $_POST['theme'],0);
        header("Refresh:0");
        die;
    }

    // GENERAL TAB
    if (isset($_POST['general'])){
      if (isset($_POST['timezone'])){
          setcookie("timezone", $_POST['timezone'],0);
          //try{
          //  $qry = "SET GLOBAL time_zone = '".$_POST['timezone']."'";
          //    $dbh->doQuery($qry);
          //}catch(Exception $e){};
      }
      if (isset($_POST['locale'])){
          setcookie("locale", $_POST['locale'],0);
      }
      if (isset($_POST['currency'])){
          setcookie("currency", $_POST['currency'],0);
      }
      if (isset($_POST['numericFormat'])){
          setcookie("numericFormat", $_POST['numericFormat'],0);
      }
      if (isset($_POST['dataFrequency'])){
          setcookie("updatetime", $_POST['dataFrequency'],0);
      }
      if (isset($_POST['csvSeparator'])){
          setcookie("csv_separator", $_POST['csvSeparator'],0);
      }
      if (isset($_POST['csvDecimal'])){
          setcookie("csv_decimal", $_POST['csvDecimal'],0);
      }      
      
      header("Refresh:0");
      die;
    }

    // NEWS_SUBMIT TAB
    if (isset($_POST['news_submit'])){
      if (isset($_POST['newsFeed1'])){
          setcookie("newsFeed1", $_POST['newsFeed1'],0);
      }
      if (isset($_POST['newsFeed2'])){
          setcookie("newsFeed2", $_POST['newsFeed2'],0);
      }
      if (isset($_POST['newsPerPage'])){
          setcookie("newsPerPage", $_POST['newsPerPage'],0);
      }

      header("Refresh:0");
      die;
    }
    
    
    
    
    function isActive($menuItemDesc,$page){
        if (strcmp(strtoupper($menuItemDesc),strtoupper($page))==0)
            echo "active";
    }
?>

<nav class="navbar navbar-expand-lg sticky-top nav-dark bg-secondary p-0">
  <div class="container-fluid">
    <div class="d-flex flex-row">
        <a class="navbar-brand m-1 p-0" href="index.php">
            <img src="assets/images/swanlogo-small-gray.png" width="48px">
            <span class="brand align-middle">QUANTiCA</span>
        </a>
        <!-- -SideBar toggler -->
        <a href="#" id="sidebarCollapse" class="sideMenuToggler">
            <i id="sideMenuIcon" class="fa fa-angle-double-left fa-lg"></i>
        </a> 
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars fa-lg text-primary"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-end pr-2" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php isActive('dashboard',$PAGE);?>" aria-current="page" href="index.php">DASHBOARD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php isActive('strategies',$PAGE);?>" aria-current="page" href="strategies.php">STRATEGIES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php isActive('datahub',$PAGE);?>" aria-current="page" href="datahub.php">DATAHUB</a>
        </li>
        
        <!-- SETTINGS -->
        <li class="nav-item">
          <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#settingsModal" href=""><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a>
        </li>

        <!-- LOGOUT -->
        <li class="nav-item">
          <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#quitModal" href=""><i class="fa fa-power-off fa-lg" aria-hidden="true"></i></a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>




<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="settingsModalLabel">Settings</h5>
        <a href="#" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
      </div>
      <div class="modal-body">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">General</button>
            <button class="nav-link" id="nav-themes-tab" data-bs-toggle="tab" data-bs-target="#nav-themes" type="button" role="tab" aria-controls="nav-themes" aria-selected="true">Themes</button>
            <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="true">Password</button>
            <button class="nav-link" id="nav-news-tab" data-bs-toggle="tab" data-bs-target="#nav-news" type="button" role="tab" aria-controls="nav-news" aria-selected="true">News</button>
            <button class="nav-link" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" type="button" role="tab" aria-controls="nav-about" aria-selected="true">About</button>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

          <!-- GENERAL SETTINGS-->
          <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
            <div class="mt-2 pt-2">
                <h6>General Settings</h6>
                <form method="post">
                    <!-- TIME ZONE -->
                    <div class="row">
                      <div class="form-check col-md-4 text-right mt-1">
                        <p>Time-Zone</p>
                      </div>
                      <div class="form-check col-md-6">
                        <?php include_once 'timezone.php';?>
                         <select class="custom-select" name="timezone">
                            <?php 
                                foreach ($timezone as $zone) {
                                  $selected = '';
                                  if ($SETTINGS_TIMEZONE==$zone) 
                                    $selected = 'selected';
                                  echo '<option '.$selected.' value="'.$zone.'">'.$zone.'</option>';
                                 } 
                             ?>
                         </select>
                      </div>    
                    </div>
                    <!-- LOCALE -->
                    <div class="row">
                      <div class="form-check col-md-4 text-right mt-1">
                        <p>Locale</p>
                      </div>
                      <div class="form-check col-md-6">
                         <?php include_once 'locale.php';?>
                         <select class="custom-select" name="locale">
                            <?php 
                                foreach ($locale as $loc) {
                                  $selected = '';
                                  if ($SETTINGS_locale==$loc["code"]) 
                                    $selected = 'selected';
                                  echo '<option '.$selected.' value="'.$loc["code"].'">'.$loc["desc"].'</option>';
                                 } 
                             ?>
                         </select>
                      </div>    
                    </div>
                    <!-- CURRENCY -->
                    <div class="row">
                      <div class="form-check col-md-4 text-right mt-1">
                        <p>Currency</p>
                      </div>
                      <div class="form-check col-md-6">
                         <select class="custom-select" name="currency">
                          <option <?php if ($SETTINGS_currency=='€') echo 'selected'; ?> value="€">Euro €</option>
                          <option <?php if ($SETTINGS_currency=='$') echo 'selected'; ?> value="$">Dollars $</option>
                          <option <?php if ($SETTINGS_currency=='£') echo 'selected'; ?> value="£">Pound Sterling £</option>
                          <option <?php if ($SETTINGS_currency=='￥') echo 'selected'; ?> value="￥">Japanese YEN ￥</option>
                          <option <?php if ($SETTINGS_currency=='RMB') echo 'selected'; ?> value="RMB">Renminbi RMB</option>
                         </select>
                      </div>    
                    </div>
                    <!-- NUMERIC FORMAT -->
                    <div class="row">
                      <div class="form-check col-md-4 text-right mt-1">
                        <p>Numeric Format</p>
                      </div>
                      <div class="form-check col-md-6">
                         <select class="custom-select" name="numericFormat">
                          <option <?php if ($SETTINGS_international=='de-DE') echo 'selected'; ?> value="de-DE">123<b>.</b>456<b>,</b>79</option>
                          <option <?php if ($SETTINGS_international=='en-UK') echo 'selected'; ?> value="en-UK">123<b>,</b>456<b>.</b>79</option>
                         </select>
                      </div>    
                    </div>
                    <!-- DATA FREQUENCY -->
                    <div class="row">
                      <div class="form-check col-md-4 text-right mt-1">
                        <p>Data Frequency</p>
                      </div>
                      <div class="form-check col-md-6">
                         <select class="custom-select" name="dataFrequency">
                          <option <?php if ($UPDATE_TIME==$HIGH_FREQUENCY) echo 'selected'; ?> value="<?php echo $HIGH_FREQUENCY?>">High Frequency</option>
                          <option <?php if ($UPDATE_TIME==$MID_FREQUENCY) echo 'selected'; ?> value="<?php echo $MID_FREQUENCY?>">Mid Frequency</option>
                          <option <?php if ($UPDATE_TIME==$LOW_FREQUENCY) echo 'selected'; ?> value="<?php echo $LOW_FREQUENCY?>">Low Frequency</option>
                         </select>
                      </div>    
                    </div>
                    <!-- CSV SETTINGS -->
                    <div class="row">
                      <div class="form-check col-md-4 text-right mt-1">
                        <p>CSV Separator</p>
                      </div>
                      <div class="form-check col-md-6">
                         <select class="custom-select" name="csvSeparator">
                          <option <?php if ($SETTINGS_CSV_SEPARATOR==';') echo 'selected'; ?> value=";">;</option>
                          <option <?php if ($SETTINGS_CSV_SEPARATOR==',') echo 'selected'; ?> value=",">,</option>
                         </select>
                      </div>    
                    </div>
                    <!-- CSV DECIMAL -->
                    <div class="row">
                      <div class="form-check col-md-4 text-right mt-1">
                        <p>CSV Decimal</p>
                      </div>
                      <div class="form-check col-md-6">
                         <select class="custom-select" name="csvDecimal">
                          <option <?php if ($SETTINGS_CSV_DECIMAL=='.') echo 'selected'; ?> value=".">.</option>
                          <option <?php if ($SETTINGS_CSV_DECIMAL==',') echo 'selected'; ?> value=",">,</option>
                         </select>
                      </div>    
                    </div>                    
                    
                    <!-- SUBMIT -->
                    <div class="row">
                      <div class="form-check col-md-10 text-right">
                        <button type="submit" class="btn btn-primary" name="general">Apply</button>
                      </div>
                    </div>
                </form>
            </div>
          </div>
          
          <!-- CHANGE THEMES -->
          <div class="tab-pane fade" id="nav-themes" role="tabpanel" aria-labelledby="<nav-h></nav-h>ome-tab">
            <div class="mt-2 pt-2">
                <h6>Change color theme</h6>
                <form class="col-sm-8" method="post">
                    <div class="form-check row">
                      <input class="form-check-input" type="radio" name="theme" id="theme1" value="darkly" <?php if ($currentTheme=='darkly') echo 'checked'?>>
                      <label class="form-check-label" for="theme1">
                        Darkly Theme (Default)
                      </label>
                    </div>
                    <div class="form-check row">
                      <input class="form-check-input" type="radio" name="theme" id="theme2" value="flatly" <?php if ($currentTheme=='flatly') echo 'checked'?>>
                      <label class="form-check-label" for="theme2">
                        Flatly Theme
                      </label>
                    </div>
                    <div class="form-check row">
                      <input class="form-check-input" type="radio" name="theme" id="theme3" value="sandstone" <?php if ($currentTheme=='sandstone') echo 'checked'?>>
                      <label class="form-check-label" for="theme3">
                        Sandstone Theme
                      </label>
                    </div>
                    <div class="form-check row">
                      <input class="form-check-input" type="radio" name="theme" id="theme4" value="yeti" <?php if ($currentTheme=='yeti') echo 'checked'?>>
                      <label class="form-check-label" for="theme4">
                        Yeti Theme
                      </label>
                    </div>  
                    <div class="form-check row">
                      <input class="form-check-input" type="radio" name="theme" id="theme5" value="superhero" <?php if ($currentTheme=='superhero') echo 'checked'?>>
                      <label class="form-check-label" for="theme5">
                        Superhero Theme
                      </label>
                    </div>                      
                    <div class="row mt-2">
                        <button type="submit" class="btn btn-primary" id="themeApply">Apply</button>
                    </div>
                </form>
            </div>
          </div>
          <!-- CHANGE PASSWORD-->
          <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
            <div class="mt-2 pt-2">
                <h6>Change your password</h6>
                <form class="row col-sm-12" method="post">
                    <input type="password" class="form-control mb-2" name="old-password" placeholder="Current Password" required disabled>
                    <input type="password" class="form-control mb-2" name="new-password" placeholder="New Password" required disabled>
                    <input type="password" class="form-control mb-2" name="new2-password" placeholder="Repeat Password" required disabled>
                    <button class="btn btn-primary mb-3" disabled>Confirm Change</button>
                </form>
            </div>
          </div>
          
          <!-- NEWS -->
          <div class="tab-pane fade" id="nav-news" role="tabpanel" aria-labelledby="nav-news-tab">
            <div class="mt-2 pt-2">
                <h6>News RSS settings</h6>
                <form method="post">
                
                  <!-- NEWS FEED 1 -->
                  <div class="row">
                    <div class="form-check col-md-2 text-right mt-1">
                      <p>News Feed 1</p>
                    </div>
                    <div class="form-check col-md-8">
                      <input type="text" class="form-control mb-2" name="newsFeed1" placeholder="rss url" value="<?php echo $SETTINGS_NEWSFEED_1?>">
                    </div>    
                  </div>
                  
                  <!-- NEWS FEED 2 -->
                  <div class="row">
                    <div class="form-check col-md-2 text-right mt-1">
                      <p>News Feed 2</p>
                    </div>
                    <div class="form-check col-md-8">
                      <input type="text" class="form-control mb-2" name="newsFeed2" placeholder="rss url" value="<?php echo $SETTINGS_NEWSFEED_2?>">
                    </div>    
                  </div>

                  <!-- NEWS PER PAGE  -->
                  <div class="row">
                    <div class="form-check col-md-2 text-right mt-1">
                      <p>News per page</p>
                    </div>
                    <div class="form-check col-md-2">
                      <input type="number"  class="form-control mb-2" name="newsPerPage" min="5" max="50" value="<?php echo $SETTINGS_NEWSPERPAGE?>">
                    </div>    
                  </div>

                  
                  <!-- SUBMIT -->
                  <div class="row">
                    <div class="form-check col-md-10 text-right">
                      <button type="submit" class="btn btn-primary" name="news_submit">Apply</button>
                    </div>
                  </div>  
                </form>
            </div>
          </div>
        
          <!-- ABOUT-->
          <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
              <div class="mt-2 pt-2">
                <br/>
                <p class="text-center small">
                    <img class="img-responsive" src="assets/images/swanlogo-small.png"><br/>
                    Version <?php echo $VERSION.' - BUILD '.$BUILD?>
                    <br/>
                    Designed & Developed by Alberto Sfolcini.
                    <br/><br/>
                    This software is distributed as a part of <span class="text-muted">QUANTiCA</span> under the <span class="text-muted">MIT License</span>.
                </p>
                <p class="text-center small">
                    <br/>
                    <a href="https://www.linkedin.com/in/albertosfolcini/" target="new"><i class="fa fa-linkedin fa-lg fa-2x"></i></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="https://getquantica.com" target="new"><i class="fa fa-globe fa-lg fa-2x"></i></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="mailto:a.sfolcini@gmail.com"><i class="fa fa-envelope fa-lg fa-2x"></i></a>
                </p>                
              </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Quit Modal -->
<div class="modal fade" id="quitModal" tabindex="-1" aria-labelledby="quitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quitModalLabel">Logout ?</h5>
      </div>
      <div class="modal-footer">
        <a href="logout.php" class="btn btn-primary" role="button">Yes</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
    if (screen.width < 768) {
      //close sidepanel
      console.log('Close side panel');
      document.getElementById('sidebar').toggle();
    }
    
    /** toggle sidebar menu **/
    document.getElementById('sidebarCollapse').onclick = function(){
        if (document.getElementById('sideMenuIcon').getAttribute("class").includes('left'))
          document.getElementById('sidebarCollapse').innerHTML = '<i id="sideMenuIcon" class="fa fa-angle-double-right fa-lg"></i>';
        else
          document.getElementById('sidebarCollapse').innerHTML = '<i id="sideMenuIcon" class="fa fa-angle-double-left fa-lg"></i>';
    };
</script>
