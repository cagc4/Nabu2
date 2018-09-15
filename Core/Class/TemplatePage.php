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

	function TemplatePage($objUtilities,$usuario){
        
        if (!isset ($objUtilities)){ 
            
            $this->objUtilities = new Utilities('localhost','nabu','6492496','nabu2');
            $_SESSION['objUtilities']=$this->objUtilities;
            
            if ($usuario <> ''){
                $row=$this->objUtilities->database->validateUser($usuario);
                $_SESSION['app']   = $row[0];
                $_SESSION['oprid'] = $row[1];
                $_SESSION['role']  = $row[2];
                
                $this->initTemplate($_SESSION['app'],'home');
            }
        }
        else{
            $this->objUtilities=$objUtilities; 
        }
            
    }

    function initTemplate($empresa,$id_page){
        
        
        $this->pageProperties=$this->objUtilities->pageProperties($empresa,$id_page);
        
        $this->pageAttribute=$this->objUtilities->pageAttribute($empresa,$id_page);
        
        if ($_SESSION['validateUser']=='X'){
                                
            $bindEmp[0]=$empresa;
            $sqlEmpresa = $this->objUtilities->database->getSqlStatement('nabu', 'nabuconnect', $bindEmp, "1");
        
            $bd =$sqlEmpresa[1];
            $usuario =$sqlEmpresa[2];
            $password =$sqlEmpresa[3];
            $host =$sqlEmpresa[4];
            
            $this->objUtilities = new Utilities($host, $usuario, $password, $bd);
                
            $_SESSION['objUtilities']=$this->objUtilities;
            $_SESSION['validateUser']='';
        }
        
        if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg')
            $this->menuPrincipal = new Menu($empresa,$this->objUtilities,$_SESSION['menuString']);
        
         
        $this->tipo=$this->pageProperties['tipo'];
        
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
            
             <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>  
             <div class="container body">
              <div class="main_container">     
            <?php }else{?>  
            <div class="login_wrapper">
             <div class="animate form login_form">
            <?php }?>
            
                  
                <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>    
                <div class="col-md-3 left_col">
                  <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                      <a href="../Pages/nabu.php?p=home" class="site_title"><i>N</i><span>&nbsp;&nbsp;<img src="../Images/logo.png" ></span></a>
                    </div>

                    <div class="clearfix">
                      
                    <!-- menu profile quick info -->
                        <div class="profile clearfix">
                          <div class="profile_pic">
                            <img src="../Images/user.jpg" alt="..." class="img-circle profile_img">
                          </div>
                          <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2>Carlos García Cobo</h2>
                          </div>
                        </div>
                        <!-- /menu profile quick info -->

                    </div>
                      
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
                             <img src="../Images/user.jpg" alt="">Carlos Garcia Cobo
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
                        <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?> 
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
                        
                      <div>
                      <!--<div class="col-md-12 col-sm-12 col-xs-12">-->
                        
                        <div class="x_panel">
                        
                            
                          
                        <div class="x_title">
                            <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ 
                                    $linkProp=$this->objUtilities->getpagelink($_GET['p']);
                            ?>   
                              <h2><i class="fa fa-external-link-square"></i>&nbsp;&nbsp;<a href="?p=<?php echo $linkProp[0]; ?>"><?php echo $linkProp[1]; ?></a></h2>
                            <?php }?>  
                            <ul class="nav navbar-right panel_toolbox">
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                              <li><a class=""><i class="fa fa-info-circle"></i></a></li>
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>
                            <div class="clearfix"></div>
                              Aca podemos describir algo
                          </div>
                            <?php } ?>
                        
                        
                          <div class="x_content">
                          
                            <div align='left'>
                              
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
                   
                    if ($this->tipo == 'chart'){
                        $this->objUtilities->legend($id_page);
                    ?>
                        <div style="width: 90%">
			               <canvas id="canvas" height="30%" width="100%"></canvas> 
                        </div>
                    <?php
                        $this->objUtilities->charts($id_page);  
                    }
                    
                    ?>
			            
                        </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div align=center><?php 
                            if ($id_page = 'login'){
                                 echo '<a href=""><img src="../Images/signingoogle.png" alt="Ingresa con tu cuenta Google" /></a>';
                                //echo googleSIgn(); 
                            }
                                
                        ?>
                </div> 
                <!-- /page content -->

                <!-- footer content -->
                <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>  
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