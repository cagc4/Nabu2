<?php

/*
http://localhost/Nabu2/Core/Events/webservice.php?token=e53db2b5b93254fddb55de43a3323970&codigoemp=nabufina&codigovalidacion=none&validacion=getData&binds=nb_compras_pg;nb_codigo_provedor_fld;1

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

	Fecha creacion		= 17-03-2017
	Desarrollador		= CAGC
	Fecha modificacion	= 20-10-2018
	Usuario Modifico	= CAGC

*/

include_once "../Class/Utilities.php";
include_once "../Class/JsonData.php";



if ( isset($_POST['token']) ){ 
    $token =$_POST['token'];
    
    $config =  json_decode(file_get_contents("../Config/config.json"),true);
    
    if ($token == md5($config["token"])){

        header('Content-type: application/json');

        
        //Parametros del AJAX
        
        $codigovalidacion =$_POST['sqlValidacion'];         // SQL Validacion debe retornar 0 = true  1 = false
        $validacion =$_POST['funcionWS'];                   // Función en el webservice
        $codigoemp =$_POST['codigoemp'];                    // Codigo empresa
        $mensaje =$_POST['messa'];                          // Mensaje de Error
        $binds=explode(";",$_POST['binds']);                // Parametros de entrada SQL

        
        $objUtilities = new Utilities($config["hostname"],$config["username"],$config["password"],$config["database"]);
        
        $database = $objUtilities->database;

        $bindEmp[0]=$codigoemp;
        
        $sqlEmpresa = $database->getSqlStatement('nabu', 'nabuconnect', $bindEmp, "1");
        
        $empresa =$sqlEmpresa[0];
        $bd =$sqlEmpresa[1];
        $usuario =$sqlEmpresa[2];
        $password =$sqlEmpresa[3];
        $host =$sqlEmpresa[4];
        
        $objUtilities = new Utilities($host, $usuario, $password, $bd);
        $database = $objUtilities->database;

        if ($codigovalidacion <> 'none')    
           $sql=$database->getSqlStatement($empresa,$codigovalidacion,$binds,"1");
        
        switch ($validacion) {
            case 'validacionesWS':
                $result = validacionesWS($sql[0], $mensaje); break;
            case 'getData':
                $result = getData($database,$empresa,$binds); break;
            case 'getDataSelect':
                $result = getDataSelect($objUtilities,$database,$empresa,$binds); break;    
        }

        echo json_encode($result);

    }
}

function validacionesWS($resultado, $mensaje){
    
    if ($resultado == 0 ){
        $value = true;
    } 
    elseif ($resultado == 1){
        $value = false;
        $result["message"] =$mensaje;
    } 
    elseif ($resultado==NULL){
        $value = false;
        $result["message"] ="Error en la validacion";
    }
     
	
    $result["status"] =$value;
	
    return $result;
 }

function getData($database,$empresa,$binds){
    
    $json = new JsonData();
    
    $idpage=$binds[0];
    $campo =$binds[1];
    $valor =$binds[2];
    
    $fieldxs=$database->getPromptSelect($empresa,$idpage,$campo,$valor);
    
    foreach($fieldxs as $fieldx){
        $value=$database->executeQueryOneRow($fieldx[1]);
        $fieldsData[$fieldx[0]]=$value[0];
    }
    
    $jsonA=$json->getData2($fieldsData);
    return $jsonA;
    
}

function getDataSelect($objUtilities,$database,$empresa,$binds){
    
    $campo =$binds[0];
    $valor  =$binds[1];
    
    $tablaRef =$database->existRefValue($empresa,$campo);
    
    if ($tablaRef[0] == 1){
        $param =$database->valueRef($empresa,$campo);
            
            $sql="select id,descr from ".$param[0]." where 1=1 ";
            
            if( $param[1]=='true')
                $co1=" AND empresa = '".$empresa."' ";
            if( $param[2]=='true')
                $co2=" AND usuario = '".$operatorId."' ";
            if( $param[3]=='true')
                $co3=" AND estado = 'A'";
            if( $param[4]=='true')
                $co3=" AND role = '".$role."'";
            if( $valor <> '')
                $co4=" AND cond = '".$valor."'";
            
            $sql=$sql.$co1.$co2.$co3.$co4;
    }
    
    $rows=$database->executeQuery($sql);
    $rows_returned =  count($rows);
    
    $i=0;
    
    if ($rows_returned > 0 ){
        foreach($rows as $row){
            $data[$i]['descr']=$row[1];
            $data[$i]['id']=$row[0];
            $i=$i+1;
        }
    }
    else{
            $data[0]['descr']='No hay valores';
            $data[0]['id']='-1';
    }
    
    $jsonA=json_encode($data);
    return $jsonA;
    
}
?>
