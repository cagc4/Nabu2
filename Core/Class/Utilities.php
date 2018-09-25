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

	Fecha creacion		= 28-02-2015
	Desarrollador		= CAGC  
	Fecha modificacion	= 20-10-2018
	Usuario Modifico	= CAGC

*/

include_once "Schema.php";
include_once "Options.php";
include_once "JsonData.php";
include_once "Chart.php";
include_once "View.php";
include_once "Database.php";
include_once "ExportToExcel.php";
//include_once "../Class/NabuEvent.php";

class Utilities
{
	var $database;
    
    function Utilities($host,$user,$password,$database){
        $this->database = new Database($host,$user,$password,$database);
    }

    function idPage($path){
		$idPage = strtolower(str_replace('.php','',basename($path)));
        return $idPage;
    }
	
	function validateRole($empresa,$page, $role) {
        
        if( isset($role) ) {
            $row = $this->database->getValidateRole($empresa,$role, $page);
            if ($row != null)
                return true;
            else
                return false;
		}
	}
    
    function castingDate($date){
    
       $fechaInicioF = split (' ', $date);
	   $dateFormated = split('/', $fechaInicioF[0] );
	   $date = $dateFormated[2].'-'.$dateFormated[0].'-'.$dateFormated[1];
        
        return $date;
    }
    
    function menuHijos($empresa,$id){
        $row = $this->database->getMenuHijos($empresa, $id);
        if ($row[0] > 0)
            return true;

        return false;
	
    }
    
    function maxHijo($empresa,$papa,$idHijo){
        $row = $this->database->getMaxHijo($empresa, $papa);
        if ($row[0] == $idHijo)
		  return true;

        return false;
    	
    }

    function changeValue($field,$value) {
        
        if  ($value == 'nb_userid')
            return 'NABU'; 
            
        if   ($value == 'nb_sysdate')
            return $this->addSysdate();
            
        return $value;
    }
    
    
    function addSysdate(){
        return (new \DateTime())->format('Y-m-d H:i:s');
    }
    
    function setupConfig(){
          $row = $this->database->getSqlStatement("nabu","0001",null,"1");
          return $row;
    }
    
    function pageProperties($empresa,$id){
        return $this->database->getPageProperties($empresa,$id);
    }
    
    function getpagelink($page){
        
        $pageLink =$this->database->getPageLink($_SESSION['app'],$page);
    
        return $pageLink;
    }
    
    
    function pageAttribute($empresa,$id){
        
        if ($empresa=='')
            $empresa='nabu';
        
        
        $atrributes = array();
        
        $atrribute='';
        $atrributesTop='';
        $atrributesDown='';
        
        
        $rows =$this->database->getPageAttribute($empresa,$id);
        $comillas='"';
        
        
        foreach($rows as $row){
            echo chr(9).chr(9);  
            if ($row[0] == 'link' )
                $atrribute='<link type='.$comillas.$row[2].$comillas.' href='.$comillas.$row[1].$comillas.' rel='.$comillas.$row[3].$comillas.'/>';
            
            if ($row[0] == 'script')
                $atrribute='<script type='.$comillas.$row[2].$comillas.' src='.$comillas.$row[1].$comillas.'></script>';
            
             if ($row[4] == 'top' )
                $atrributesTop=$atrributesTop.$atrribute;
            else
                $atrributesDown=$atrributesDown.$atrribute;
            
        }
        
        $atrributes[0]=$atrributesTop;
        $atrributes[1]=$atrributesDown;  
        
        return $atrributes;
        
    }
    
	function getSchema($empresa,$id){
       
        $id = strtolower($id);
	    $type = 'schema';
		$row = $this->database->getSchemaDescription($empresa,$id);
        $typePage = $row[2];
		$json = new Schema($row[0],$row[1],$row[2]);
		
        if  ($typePage == 'array'){
			$json->addItems('type','object');
			$properties = array();
		}
		else
			unset($json->items);
        
        
        $rows = $this->database->getFormFields($empresa,$id, $type);
        
        foreach($rows as $row){
            
           $rowsI = $this->database->getFormFieldsTypes($empresa,$id, $type, $row[0]); 
            
           if  ($typePage == 'array')
               $properties[$row[0]] = $json->addField($rowsI);
           else{
               $campo = $json->addField($rowsI);
               $json->addProperties($row[0],$campo);
			} 
        }				
        
        if  ($typePage == 'array'){
			$json->addItems("properties",$properties);
			unset($json->properties);
		}

        return $json;
	}
   
	function getData($empresa,$id){
        
        $json = new JsonData();
        
        $table  = $this->database->getDataRecord($empresa,$id);
        
        $fieldsVW = $this->database->getFieldsPage($empresa,$id,'tbl');
        
        if (count($fieldsVW) < 1 )
            $fields = $this->database->getFieldsPage($empresa,$id,'vw');
        else
            $fields = $fieldsVW;
        
        $ifcampos=false;
        
        
        if (is_array($fields))
            $ifcampos=true;
        
        if ($table[0] == ''){

            $parametros=false;
            if($ifcampos){
                foreach($fields as $field){
                    
                    if (isset($_GET['accion'])){
                        if ($_GET['accion']=='b' or $_GET['accion']=='s'){
                            if (isset($_GET[$field[0]])){
                                
                               $parametros=true;
                                break;
                            }
                        }    
                        else{
                         if (isset($_GET['_1_'.$field[0]])){
                               $parametros=true;
                                break;
                            } 
                        }
                    }
                }
            }

            if ($parametros){
                $fieldsData = array();

                $where ="Where ";
                $i=1;
                $tabla='';
                $j=1;

                if (isset($_GET['accion'])){
                    if ($_GET['accion']=='b'){
                        foreach($fields as $field){
                            $key=$field[2];
                            $tabla=$field[1];
                            if ($tabla=='' OR $tabla == $field[1]){
                                if ( $key=='Y' ){
                                    if (isset($_GET[$field[0]])){
                                        if ($_GET[$field[0]] <> ''){    
                                            $value=$this->database->getDataChange($empresa,$field[0],$_GET[$field[0]]);

                                            if ($value[0] == '')
                                                $value[0]=$_GET[$field[0]];

                                            $crypted=$this->database->ifCrypted($empresa,$field[1],$field[0]);
                                            
                                            if ($crypted[0] =='Y')
                                                $value[0]=$this->database->decrypt($value[0]);
                                            
                                            if ($i == 1)
                                                $where=$where.$field[0]."='".$value[0]."' ";
                                            else
                                                $where=$where." AND ".$field[0]."='".$value[0]."' ";

                                            $fieldsData[$field[0]]=$value[0];
                                            $fieldsData[$field[0].'X']=$value[0];

                                        }
                                    }
                                    $i++;
                                }
                                else{
                                    
                                    
                                        
                                        $veriField=$this->database->verificarCampo($empresa,$id,$field[0]);
                                    
                                        $value=$this->database->getDatavalueW($field[1],$field[0],$where);
                                        $type =$this->database->getTypes($empresa,$field[1],$field[0]);
                                    
                                        $crypted=$this->database->ifCrypted($empresa,$field[1],$field[0]);
                                            
                                            if ($crypted[0] =='Y')
                                                $value[0]=$this->database->decrypt($value[0]);
                                    
                                        if ($veriField[0] <> 'Y')
                                            $fieldsData[$field[0]]=$value[0];
                                    
                                        $fieldxs=$this->database->getPromptSelect($empresa,$id,$field[0],$value[0]);

                                        foreach($fieldxs as $fieldx){
                                            $valueX=$this->database->executeQueryOneRow($fieldx[1]);
                                            $fieldsData[$fieldx[0]]=$valueX[0];
                                        
                                    }
                                }
                            }
                            else
                                $tabla =$field[1];
                        }
                    }
                    if ($_GET['accion']=='s'){
                        foreach($fields as $field){
                            if (isset($_GET[$field[0]])){
                                $value[0]=$_GET[$field[0]];
                                $fieldsData[$field[0]]=$value[0];
                                $fieldsData[$field[0].'X']=$value[0];
                                
                                $fieldxs=$this->database->getPromptSelect($empresa,$id,$field[0],$value[0]);
        
                                foreach($fieldxs as $fieldx){
                                    $valueX=$this->database->executeQueryOneRow($fieldx[1]);
                                    $fieldsData[$fieldx[0]]=$valueX[0];
                                }
                            }    
                        }
                    }
                }
                
                if ($_GET['accion']<>'bd')
                    $jsonA=$json->getData2($fieldsData);
            }
            else{
                $fields =$this->database->getData($empresa,$id);
                $jsonA=$json->getData($fields);
            }
        }
        else
        {  
            if($ifcampos)
                $jsonA=$json->getDataSelectU($this->database ,$table[0],$fields);
            else
                $jsonA='';
        }

        
       return $jsonA;
    }
    
    function getPostrender($empresa,$id){
	   $code = $this->database->getPostrender($empresa,$id);
	   return $code[0];
    }

    function getView($empresa,$id){
        
        $view = new View();
        $row = $this->database->getOptionsEvents($empresa,$id);
        $alpaca = $row['alpaca'];
        $parent = $this->database->getViewParent($empresa,$id);
        $view->setView($this->database,$parent[0], $alpaca, $id); 
        
        return $view;
            
    }
    
    function getOption($empresa,$id){
        
		$id = strtolower($id);
		$type = 'options';
		$row = $this->database->getOptionsEvents($empresa,$id);
		$alpaca = $row['alpaca'];  		
		
        $json = new Options();
        
        if ($alpaca == 'wizard' or $alpaca =='form' or $alpaca == 'table'){
            $event = $row['event'];
            $target = $row['target'];
			$attributes=$json->addElement($event,'post','',$target);
			$json->addForm("attributes",$attributes);
            $json->addForm("toggleSubmitValidState",false);
            unset($json->datatables);
        }
        
        if ($alpaca == 'form' or $alpaca == 'table'){
			
			$rows = $this->database->getFormButtonsQuery($empresa,$id);
            $button = array();
            foreach($rows as $r)
                
                $button[$r[0]] = array("value"=> $r[1],"title"=> $r[2], "click"=>$r[3], "styles"=>$r[4]);
            
			$json->addForm("buttons",$button);
            
            unset($json->type);
            unset($json->showActionsColumn);
            unset($json->datatables);
			
		}
        
        if ($alpaca == 'table'){
			$json->addType($alpaca,false);
            $fieldsA = array();
            $info = array();
        }
        else
            unset($json->items);
        
        if ($alpaca == 'image'){
            unset($json->type);
			unset($json->renderForm);
			unset($json->form);
            unset($json->showActionsColumn);
            unset($json->datatables);
		
		}
		
        $rows = $this->database->getFormFields($empresa,$id, $type);
        
        foreach($rows as $row){
            $rowsI = $this->database->getFormFieldsTypes($empresa,$id,$type,$row[0]);
            $campo=$json->addField($rowsI);
		    
            if  ($alpaca == 'table')
                $fieldsA[$row[0]] = $campo;
            else
                $json->addFields($row[0],$campo);
            
        }
        
        if  ($alpaca == 'table'){
			$json->addItems("fields",$fieldsA);
            
            $paginate['first']='Primero';
            $paginate['last']='Último';
            
            $paginate['previous']='Atrás';
            $paginate['next']='Siguiente';
            
            $info['paginate']=$paginate;
            $info['emptyTable']='Sin datos para mostrar';
            $info['search']='Buscar';
            $info['lengthMenu']='Mostrar _MENU_ entradas';
            
            $info['info']='<h5><p align=left>Mostrando del _START_ al _END_ de _TOTAL_ datos en total</p></h5>';
            $info['infoFiltered']='<h6><p align=left>(Filtrado de _MAX_ datos en total)</p></h6>';


            
            $json->addDatatables($info);
			unset($json->renderForm);
			unset($json->fields);
		}
        
        return $json;

	}
    
    function fixedJson($json) {
        
        $v1=chr(34)."function("; $c1="function(";                           // "function(   se cambia por function(
        $v2=chr(59).chr(125).chr(34); $c2=chr(59).chr(125);                 // ;}"          se cambia por  ;}    
        $v3=chr(40).chr(92).chr(34); $c3=chr(40).chr(34);                   // (\"          se cambia por  ("
        $v4=chr(92).chr(34).chr(43); $c4=chr(34).chr(43);                   // \"+          se cambia por  "+  
        $v5=chr(34).chr(123); $c5=chr(123);                                 // "{           se cambia por  {
        $v6=chr(92).chr(34);  $c6=chr(34);                                  // \"           se cambia por  "
        $v7=chr(125).chr(34);  $c7=chr(125);                                // }"           se cambia por  }
        $v8=chr(125).chr(32).chr(34).chr(125);  $c8=chr(125).chr(125);      // }espacio"}   se cambia por  }}
        $v9=chr(92).chr(47); $c9=chr(47);                                   //\/            se cambia por /
        $v10=chr(34).chr(91); $c10=chr(91);                                 //"[            se cambia por [
        $v11=chr(93).chr(34); $c11=chr(93);                                 //]"            se cambia por ] 
        $v12=chr(92).chr(110); $c12="";                                     //\n            se cambia por vacio
        $v13=chr(92).chr(116); $c13="";                                     //\t            se cambia por vacio
        $v14=chr(92).chr(114); $c14="";                                     //\r            se cambia por vacio
        
        $chars= array($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14);
        $correc= array($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14);
        
        for ($i=0; $i<sizeof($chars); $i++)
            $json=str_replace($chars[$i],$correc[$i],$json);
        
        
        
        return $json;
    }
    
	function forms($style,$imprimirJsons,$schema,$options,$data, $view, $postrender){
        
        $JsonSchema =$this->fixedJson(json_encode($schema));
        $JsonOptions=$this->fixedJson(json_encode($options));
        $JsonData=$this->fixedJson(json_encode($data));
        $JsonView=$this->fixedJson(json_encode($view, JSON_PRETTY_PRINT)); 
        
        if  ($imprimirJsons == "true") {
			echo '*******************************************************Schema*******************************************************<br/>';
			print_r($JsonSchema);
			echo '<br/>*******************************************************Options*******************************************************<br/>';
			print_r($JsonOptions);
			echo '<br/>*******************************************************Data*******************************************************<br/>';
			print_r($JsonData);
            echo '<br/>*******************************************************View*******************************************************<br/>';
			print_r($JsonView);
            echo '<br/>*******************************************************Postrender*******************************************************<br/>';
			print_r($postrender);
        }
    ?>
     <div class=<?php echo $style ?> >
			<div id="field1"></div>
				<script type="text/javascript" id="field1-script">
					$(function() {
                        Alpaca.defaultFocus=false;
						Alpaca.setDefaultLocale("es_ES");
						$("#field1").alpaca({
							"optionsSource":<?php print_r($JsonOptions);?>,
							"schema":<?php print_r($JsonSchema);?>,
							"dataSource":<?php print_r($JsonData); ?>,
							"view": <?php print_r($JsonView) ?>,
							"postRender": function(control){

				                <?php print_r($postrender); ?>
				
                                control.obtenerNombres = function(){
                                    var nombreCampos = [];
                                    for (var field in control.schema.properties){
                                        var fieldValue = control.childrenByPropertyId[field].getValue();
                                        if (fieldValue != '' && fieldValue != 'null' && fieldValue != null) 
                                            nombreCampos.push(field);
                                    }

                                    control.fieldsNames = nombreCampos;
									return nombreCampos;
								}
                                
                                control.obtenerValores = function(){
									var valores = [];
									var nombres = control.obtenerNombres();
									var fieldsLengthFields = nombres.length;
									for(var i = 0; i < fieldsLengthFields; i++){
										var fieldName = nombres[i];
										var fieldValue = control.childrenByPropertyId[fieldName].getValue();
										if (fieldValue != '' && fieldValue != 'null' && fieldValue != null) 
                                            valores.push(fieldValue);
									}
									return valores;
								}
				            }
						});
					});
				</script>
		</div>
	  
<?php
	}
    
    function legend($id){

        $rows = $this->database->getChartDataQuery($_SESSION['app'],$id, 'column');
        echo "<table border=1 width='20%'><tr>";
        
        foreach($rows as $row)
            echo "<th bgcolor='$row[1]'><center>&nbsp$row[0]&nbsp</center></th>";
        
        echo "</tr></table><br><br><br>";

    }
    
    function charts($id){
        
        $json = new Chart();
        $json->labels($this->database,$id);
        $json->bars($this->database,$id);
        
?>
    
       <script>
          function addCommas(nStr){
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
            var barChartData =<?php print_r(json_encode($json)); ?>

            var options = {
               responsive : true,
               animation: true,
               multiTooltipTemplate:"<%= '$' + addCommas(value) %>", 
               scaleLabel :"<%= '$' + addCommas(value) %>"
            };
           
            window.onload = function(){
                var ctx = document.getElementById("canvas").getContext("2d");
                myBar = new Chart(ctx).Bar(barChartData,options);
            }
        
        </script>

<?php        
    }
}
?>