<?php

include "../Class/Utilities.php";
include "../Class/Menu.php";

class TemplatePage
{
	var $menuPrincipal;
	var $objUtilities;
	var $pageProperties;
    var $pageAttribute;
    var $render;
    var $config;
    var $urlCurrent;

	function TemplatePage($objUtilities){

        if (!isset ($objUtilities)){
            $this->objUtilities = new Utilities('localhost','nabu','6492496','nabu2');
            $_SESSION['objUtilities']=$this->objUtilities;
        }
        else
            $this->objUtilities=$objUtilities;
        
    }

    function initTemplate($empresa,$id_page){
        
        
        
        $this->pageProperties=$this->objUtilities->pageProperties($empresa,$id_page);
        
        $this->pageAttribute=$this->objUtilities->pageAttribute($empresa,$id_page);
        $this->urlCurrent = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
        
        if ($id_page <> 'login' and $id_page <> 'event')
            $this->menuPrincipal = new Menu($empresa,$this->objUtilities,$_SESSION['menuString']);
         
        
        $this->tipo=$this->pageProperties['tipo'];
        if ($this->tipo == 'datagrid')
        	$this->render=$this->objUtilities->getDataGrid($id_page);
        
        if ($this->tipo <> 'save')
            $this->contenido($empresa,$id_page);
        else
            $this->objUtilities->eventSave();
        
    }

    function contenido($empresa,$id_page){
        
?>        
        <!DOCTYPE html>
        <html lang="en">
          <head>
              
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title><?php echo $this->pageProperties['title'];?></title>
            
            <!-- Attribute Css -->
            <?php echo $this->pageAttribute[0];?>
              
          </head>

          <body class="nav-md">
            
             <?php if ($id_page <> 'login' and $id_page <> 'event'){ ?>  
             <div class="container body">
              <div class="main_container">     
            <?php }else{?>  
            <div class="login_wrapper">
             <div class="animate form login_form">
            <?php }?>
            
                  
                <?php if ($id_page <> 'login' and $id_page <> 'event'){ ?>    
                <div class="col-md-3 left_col">
                  <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                      <a href="?p=home" class="site_title"><i>N</i><span>&nbsp;&nbsp;<img src="../Images/logo.png" ></span></a>
                    </div>

                    <div class="clearfix"></div>
                      
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                      <div class="menu_section">
                        <ul class="nav side-menu">
                            
                          <?php echo $_SESSION['menuString'];?>
                          
                        </ul>
                      </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                      <a data-toggle="tooltip" data-placement="top" title="Web">
                        <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                      </a>
                      <a data-toggle="tooltip" data-placement="top" title="Términos y Condiciones">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                      </a>
                      <a data-toggle="tooltip" data-placement="top" title="Contáctenos">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                      </a>
                      <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                      </a>
                    </div>
                    <!-- /menu footer buttons -->
                  </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                  <div class="nav_menu">
                    <nav>
                      <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                      </div>

                      <ul class="nav navbar-nav navbar-right">
                        <li class="">
                          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class=" fa fa-cogs fa-2x"></span>  
                            <span class=" fa fa-angle-down"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="javascript:;">
                                <span class=" fa fa-user"></span>   
                                <span>Usuario</span>
                                </a>
                            </li>
                            <li>
                              <a href="javascript:;">
                                <span class="fa fa-cog"></span>   
                                <span>Configuración</span>
                              </a>
                            </li>
                            <li>
                              <a href="javascript:;">
                                <span class="fa fa-life-ring"></span>   
                                <span>Ayuda</span>
                              </a>
                            </li>
                            <li>
                              <a href="javascript:;">
                                <span class="fa fa-sign-out"></span>   
                                <span>Cerrar Sesión</span>
                              </a>
                            </li>
                          </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge bg-green">6</span>
                          </a>
                          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            <li>
                              <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                  <span>John Smith</span>
                                  <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                              </a>
                            </li>
                            <li>
                              <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                  <span>John Smith</span>
                                  <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                              </a>
                            </li>
                            <li>
                              <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                  <span>John Smith</span>
                                  <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                              </a>
                            </li>
                            <li>
                              <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                  <span>John Smith</span>
                                  <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                              </a>
                            </li>
                            <li>
                              <div class="text-center">
                                <a>
                                  <strong>See All Alerts</strong>
                                  <i class="fa fa-angle-right"></i>
                                </a>
                              </div>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
                <!-- /top navigation -->

                <?php }?>  
                <!-- page content -->
                <div class="right_col" role="main">
                  <div class="">
                    <div class="page-title">
                        <?php if ($id_page <> 'login' and $id_page <> 'event'){ ?> 
                        <div class="title_left">
                        <h3></h3>
                        <?php }else{?>
                          <div align='center'><img src="../Images/logo.png"> 
                        <?php }?>  
                      </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2></h2>
                            <ul class="nav navbar-right panel_toolbox">
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                              <li><a class=""><i class="fa fa-info-circle"></i></a></li>
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                        
                          <div align='center'>
                              
				<?php
                    
                    $style=$this->pageProperties['style'];
                    $trace=$this->pageProperties['trace'];
                    
                    if ($empresa=='')
                        $empresa='nabu';
        
        
                    
                    
                    if ($this->tipo == 'alpaca' or $this->tipo == 'wizard'){
                        $schema=$this->objUtilities->getSchema($empresa,$id_page);
                        $options=$this->objUtilities->getOption($empresa,$id_page);
                        $data =$this->objUtilities->getData($empresa,$id_page);
                        $view =$this->objUtilities->getView($empresa,$id_page);
			            $postrender=$this->objUtilities->getPostrender($empresa,$id_page);
                        $this->objUtilities->forms($style,$trace,$schema,$options,$data, $view,$postrender);
                    }
                    if ($this->tipo == 'datagrid'){
                        
                        $rPDF=$this->objUtilities->reportPdf($empresa,$id_page);
                        
                        if ($rPDF <> NULL and $rPDF <>'' )
                            $permiso = true;
                        else
                            $permiso = false;
                        
                    ?>    
                        <div style="margin:10px">
                            <?php 
                                
                                $header=$this->objUtilities->gridHeader($empresa,$id_page);
                        
                                if ( $header <> NULL and $header <>''){
                                ?>    
                                    <a class="headerGrid">
                                        <button type="button" class="fa fa-th-large btn btn-default btn-sm">&nbsp;&nbsp;Encabezado</button>
                                    </a>    
                                    <br><br>
                            
                                    <script>
                                        $(document).on("click", ".headerGrid", function(e) {
                                           var dialog = bootbox.dialog({
                                                title: 'Encabezado',
                                                message: '<p><i class="fa fa-spin fa-spinner fa-2x"></i>Cargando Datos</p>',
                                                backdrop: true,
                                                className:"headerGrid"
                                            });

                                            dialog.init(function(){
                                                setTimeout(function(){dialog.find('.bootbox-body').html('<?php echo $header ?>');},1000);});
                                        });
                                    </script> 
                                <?php
                                }
                                
                                echo $this->render;
                                
                                if ($_SESSION['role'] == 1){
                                    $csv=$this->objUtilities->fileDatagrid($id_page);
                                     if ($csv <> '' and $permiso === false ){
                                        echo "<br><a href='$urlCurrent'>Actualizar</a>&nbsp&nbsp&nbsp&nbsp";
                                        echo "<a href='$csv' target='_blank'>Descargar Archivo</a>";
                                     }
                                }
                        
                                if ($permiso !== false){ 
                                    if (isset($_GET["idCabecera"])){
                                        $idCabecera=$_GET["idCabecera"];
                                        if (!is_numeric($idCabecera))
                                            $idCabecera=0;
                                    }
                                    echo "<br><a href='../Reports/".$rPDF.".php?idF=1&idCabecera=$idCabecera' target='_blank'>Imprimir Factura</a>";   
                                }
                            ?>
                        </div>
                    <?php
                    }
                    if ($this->tipo == 'chart'){
                        $this->objUtilities->legend($id_page);
                    ?>
                        <div style="width: 90%">
			               <canvas id="canvas" height="30%" width="100%"></canvas> 
                        </div>
                    <?php
                        $this->objUtilities->charts($id_page);  
                    }
                    
                    if ($this->tipo == 'event')
                        $this->objUtilities->validateLogin();
                    
                    ?>
			             </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <?php if ($id_page <> 'login' and $id_page <> 'event'){ ?>  
                <footer>
                  <div class="pull-right">
                    Nabu 2018
                  </div>
                  <div class="clearfix"></div>
                </footer>
                <?php }?> 
                <!-- /footer content -->
              </div>
            </div>    
            <!-- Attribute JS -->
            <?php echo $this->pageAttribute[1];?>
              
          </body>
        </html>

<?php
    }
}    
?>