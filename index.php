<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vodomer">
    <meta name="author" content="AK">
    <meta name="keyword" content="Vodomer, AK , Responsive">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Vodomer</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      
      <header class="header white-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
            </div>

            <!--logo start-->
            <a href="index.html" class="logo"><span>Vodo</span>mer</a>
            <!--logo end-->

            
            
      </header>      
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li>
                      <a class="" href="#">
                          <i class="icon_piechart"></i>
                          <span>Graf(i)</span>
                      </a>
                  </li>
                  <li>
                      <a class="" href="#">
                          <i class="icon_genius"></i>
                          <span>Statistika</span>
                      </a>
                  </li>
                  <li>
                      <a class="" href="#">
                          <i class="icon_info"></i>
                          <span>Ta meni še ne deluje. Važn d srce dela :D</span>
                      </a>
                  </li>
               
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-sm-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Meritve
                          </header>
                          <table class="table table-hover">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th><span class="menu-arrow arrow_carrot-right"></span></i>Nivo</th>
                                  <th><i class="icon_cogs"></i>Napetost baterije</th>
                                  <th><i class="icon_calendar"></i> Datum in ura</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                              <?php
                                $file = fopen("meritve.txt", "r");
                                $ctr = 1;
                                while(!feof($file)){
                                    $line = fgets($file);
                                    $tmp = explode("#",$line);
                                    date_default_timezone_set('Europe/Ljubljana');
                                    $date = new DateTime('@' . $tmp[2]);
                                    $datetime = date_format($date, 'd.M Y H:i:s');
                                    echo("<tr>");
                                    echo("<td>$ctr</td>");
                                    echo("<td>$tmp[0]</td>");
                                    echo("<td>$tmp[1]V</td>");
                                    echo("<td>$datetime</td>");
                                    echo("</tr>");
                                    $ctr++;
                                }
                                fclose($file);


                              ?>
                              </tbody>
                          </table>
                      </section>
                  </div>
                  <div class="col-lg-6">
                      <section class="panel">                        
                        <header class="panel-heading">
                             Opažanja
                          </header>
                      <div class="panel-body">
                        <?php
                          $file = fopen("meritve.txt", "r");
                          $line = fgets($file);
                          $tmp = explode("#",$line);
                          date_default_timezone_set('Europe/Ljubljana');
                          $date = new DateTime('@' . $tmp[2]);
                          $datum = date_format($date, 'd.m Y');
                          $time = date_format($date, 'H:i:s');

                          ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Zadnji izmerjen nivo: <b><?php echo($tmp[0]);?></b>.</div>
                          <div class="panel-content">
                          <?php
                          echo("<b>".$tmp[0]."</b> izmerjeno ".$datum. " ob ".$time.".");
                          fclose($file);
                          ?></div>
                        </div> 

                        <?php
                             $file = fopen("meritve.txt", "r");
                                $min = 9999;
                                $ts = "";

                                while(!feof($file)){
                                    $line = fgets($file);
                                    $temp = explode("#",$line);
                                    date_default_timezone_set('Europe/Ljubljana');
                                    $datum = date_format($date, 'd.m Y');
                                    $time = date_format($date, 'H:i:s');

                                    if ($temp[0]<$min) {
                                        $min = $temp[0];
                                        $ts = $datum." ob ".$time;
                                    }
                                } 
                        ?>       
                        <div class="panel panel-info">
                          <div class="panel-heading">Najnižji nivo: <b><?php echo($min);?></b>.</div>
                          <div class="panel-content">
                          <?php
                                echo("Najnižja vrednost: <b>".$min."</b> je bila izmerjena ".$ts.".");
                                fclose($file);
                          ?>
                          </div>
                        </div>
                        <?php
                          $percent = intval(($tmp[1]/12)*100);
                          if ($percent>100){
                            $percent=100;
                          }
                          elseif ($percent<0) {
                              $percent=0;
                          }
                          $str = "width: ".$percent."%;";
                          ?> 
                        <div class="panel panel-info">
                          <div class="panel-heading">Stanje baterije: <b><?php echo($percent);?></b>%.</div>
                          <div class="panel-content">
                          
                          Napetost baterije: <b><?php echo($tmp[1]);?></b>V.
                              <div class="progress progress-xs">
                                  <div class="progress-bar" role="progressbar" aria-valuenow=<?php echo($percent);?> aria-valuemin="0" aria-valuemax="100" style="<?php echo("$str");?>">
                                      <span class="sr-only">10% Complete</span>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </section>
              </div>
              
              
              
              <!-- page end-->
          </section>

      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nicescroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>


  </body>
</html>
