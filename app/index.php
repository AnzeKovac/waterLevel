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
            <a href="index.php" class="logo"><span>Vodo</span>mer</a>
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
                          <i class="icon_genius"></i>
                          <span>Statistika</span>
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
    			
    			<!-- KODA ZA MERITEVEEEE-->
    			<?php
                    $file = fopen("meritve.txt", "r");     
                    $meritve = array();
                    while(!feof($file))
                    {
                        $line = fgets($file);
                        $tmp = explode("#",$line);
                        $meritve[]=$tmp;            
                    }

                    $meritve = array_reverse($meritve);
                    $ctr = count($meritve);
                    fclose($file);
                 ?>
                  <div class="col-lg-6">
                      <section class="panel">                        
                        <header class="panel-heading">
                             Podatki
                          </header>
                      <div class="panel-body">
                        <?php
                          $file = fopen("meritve.txt", "r");
                          $line = fgets($file);
                          $tmp = explode("#",$line);

                          ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Zadnji izmerjen nivo: <b><?php echo($meritve[0][0]);?></b></div>
                          <div class="panel-content">
                          <?php
                          echo("<b>".$meritve[0][0]."</b> izmerjeno ob: ".$meritve[0][3]);
                          fclose($file);
                          ?></div>
                        </div> 

                        <?php
                             $file = fopen("meritve.txt", "r");
                                $min = 9999;
                                $ts = "";
                                $time = $meritve[0][2];
                                while(!feof($file)){
                                    $line = fgets($file);
                                    $podatki = explode("#",$line);
                                    $nivo = $podatki[0];
                                    $cas = $podatki[2];
                                    $datum = $podatki[3];

                                    if (($nivo<$min) && ($cas>$time-86400))
                                    {
                                        $min = $nivo;
                                        $ts = $cas;
                                        $date = $datum;
                                    }
                                } 
                        ?>       
                        <div class="panel panel-info">
                          <div class="panel-heading">Najnižji nivo v zadnjih 24h: <b><?php echo($min);?></b></div>
                          <div class="panel-content">
                          <?php
                                echo("Najnižja vrednost: <b>".$min."</b> je bila izmerjena ob: ".$date);
                                fclose($file);
                          ?>
                          </div>
                        </div>
                        <?php
                          $percent = intval(($meritve[0][1]/4.8)*100);
                          if ($percent>100){
                            $percent=100;
                          }
                          elseif ($percent<0) {
                              $percent=0;
                          }
                          $str = "width: ".$percent."%;";
                          ?> 
                        <div class="panel panel-info">
                          <div class="panel-heading">Stanje baterije: <b><?php echo($percent);?></b>%</div>
                          <div class="panel-content">
                          
                          Napetost baterije: <b><?php echo($meritve[0][1]);?></b>V
                              <div class="progress progress-xs">
                                  <div class="progress-bar" role="progressbar" aria-valuenow=<?php echo($percent);?> aria-valuemin="0" aria-valuemax="100" style="<?php echo("$str");?>">
                                      <span class="sr-only">10% Complete</span>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </section>
             	 </div>

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
                               	foreach ($meritve as $tmp)
                               	{  
                                    echo("<tr>");
                                    echo("<td>$ctr</td>");
                                    echo("<td>$tmp[0]</td>");
                                    echo("<td>$tmp[1]V</td>");
				    				echo("<td>$tmp[3]</td>");
                                    echo("</tr>");
                                    $ctr--;
                                }
                                

                              ?>
                              </tbody>
                          </table>
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
    
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>


  </body>
</html>
