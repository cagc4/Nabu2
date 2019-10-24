<?php

/*
The MIT License (MIT)

Copyright (c) <2016> <Carlos Alberto Garcia Cobo - carlosgc4@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

	Fecha creacion		= 24-09-2015
	Desarrollador		= CAGC
    Fecha modificacion	= 20-10-2018
	Usuario Modifico	= CAGC

*/

include "../Class/Utilities.php";
include "../Class/Menu.php";
include "../Class/Login.php";
include "../Pages/homeTemplate.php";
include "../Pages/datatableTemplate.php";


class TemplatePage
{
    
    var $menuPrincipal;
	var $objUtilities;
	var $pageProperties;
    var $pageAttribute;
    var $render;
    var $urlCurrent;
    var $login;
    var $avatar;
    var $userName;
    

	function TemplatePage($objUtilities,$usuario){
        
        if(!isset($_SESSION['app']) )
            $_SESSION['app']   = 'nabu';
        
        
        if (!isset ($objUtilities)){ 
            
            $config =  json_decode(file_get_contents("../Config/config.json"),true);
            $this->objUtilities = new Utilities($config["hostname"],$config["username"],$config["password"],$config["database"]);
            
            $_SESSION['objUtilities']=$this->objUtilities;
            
            if ($usuario <> ''){
                $row=$this->objUtilities->database->getUserInfo($usuario);
                $_SESSION['app']   = $row[0];
                $_SESSION['oprid'] = $row[1];
                $_SESSION['role']  = $row[2];
                $_SESSION['avatar']  = $row[3];
                $_SESSION['userName']  = $row[4];
                $_SESSION['token']  = md5($config["token"]);
                $_SESSION['encryptKey']  = md5($config["encryptKey"]);
                
                $this->initTemplate($_SESSION['app'],'home');
            }
        }
        else{
            $this->objUtilities=$objUtilities; 
        }
        
    }

    function initTemplate($empresa,$id_page){
        
        if(isset($_SESSION['userName']) )
            $this->userName = $_SESSION['userName'];
        
        
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
        
        $this->contenido($empresa,$id_page);        
        
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

           <?php if ($id_page <> 'login'){?>    
           <body class="nav-md">
           <?php } else { ?>       
           <body class="nav-md">
           <?php } ?>         
               
             <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>  
             <div class="container body">
              <div class="main_container">     
            <?php }else{?> 
            <div class="login_wrapper">
             <div class="animate form login_form">
                 <div align='center' class="made"><H1>NABU</H1></div> 
            <?php }?>
            
                  
                <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>
                 
                <script type="text/javascript">
                    $(document).ready(function () {
                        $(document).idleTimeout({
                          redirectUrl:  '../Pages/nabu.php?p=login',
                          idleTimeLimit: 600,
                          enableDialog: true,
                          dialogDisplayLimit: 30,
                          dialogTitle: 'Nabu',
                          dialogText: 'Se cierra la sesion por inactividad de 10 minutos',    
                          sessionKeepAliveTimer: false
                        });
                    });    
                </script>
                 
                 
                <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                <a href="" class="site_title"><i class="fa fa-paw"></i> <span>Nabu</span></a>
                </div>
                <div class="clearfix"></div>
                <br />
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    
                    <?php echo $_SESSION['menuString'];?>
                        
                </ul>
                </div></div></div></div>
                <div class="top_nav">
                <div class="nav_menu">
                <nav>
                <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div></nav></div> </div>        
                 
                 
                <?php }?>  
                <!-- page content -->
                <div class="right_col" role="main">
                    
                  <?php 
                        //Comento Dashboard
                        if ($id_page == 'homeXYZ') 
                       home();
                    else{
                  ?>        
                  <div class="">
                    
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
                            <?php }
                            ?>  
                            <ul class="nav navbar-right panel_toolbox">
                              <?php
                                 if ($id_page <> 'login'){
                              ?> 
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                              <li><a class=""><i class="fa fa-info-circle"></i></a></li>
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              <?php }?>      
                            </ul>
                            <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>
                            <div class="clearfix"></div>
                              
                          </div>
                            <?php }
                            
                            ?>
                        
                        
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
                        
                        $nameKeyField=$this->objUtilities->database->getNameKeyField($empresa,$id_page);
                        $link = "?p=".str_replace('_v_','_m_',$id_page)."&accion=b&".$nameKeyField[0]."=";
                        
                        $colTit=$this->objUtilities->datagridColumTit($empresa,$id_page);
                        datagrid($_SESSION['token'],$empresa,$id_page,$link,$colTit);
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
                  <?php } ?>    
                </div>
                <div align=center><?php 
                            if ($id_page == 'login'){
                                
                                $this->login = new Login();
                                
                                $linkGoogle=$this->login->start();
                                
                                echo "<br>
                                    <!--<a href=$linkGoogle class='loginboton'>
                                    <span class='fa fa-google'></span>   
                                    <span>Ingresa con Google</span>
                                    </a>
                                    <br><br>--><br>
                                    <div class='made'>
                                    <span>Hecho con <img src='../Images/hearth.png '> en Colombia</span>
                                    </div>
                                ";
                                
                            }
                                
                        ?>
                </div> 
                <!-- /page content -->

                <!-- footer content -->
                <?php if ($id_page <> 'login' and $id_page <> 'nb_user_new_pg' and $id_page <> 'nb_forg_pas_pg'){ ?>  
                <footer>
                  <div class="pull-right">
                    Nabu 2019
                  </div>
                  <div class="clearfix"></div>
                </footer>
                <?php }?> 
                <!-- /footer content -->
              </div>
            </div>    
            <!-- Attribute JS -->
            <?php echo $this->pageAttribute[1]; ?>   
                  

                  
           
          </body>
        </html>

<?php
    }
}    
?>