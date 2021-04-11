  <div class="p-3 text-center">
    <i class="fa fa-user-circle fa-lg"></i>&nbsp;
    <span><small><?php 
        if (isset($_SESSION['FULLNAME']))
          echo $_SESSION['FULLNAME']; 
        else 
          echo $_SESSION['UID'];
      ?> 
      (<?php echo $_SESSION['AUTH']?>)</small></span>
    <hr class="bg-light">
  </div>