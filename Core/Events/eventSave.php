<?php

    include_once "../Class/Utilities.php";
    include_once "../Class/NabuEvent.php";


if ( isset($_POST['token']) ){ 
    $token =$_POST['token'];
    
    $config =  json_decode(file_get_contents("../Config/config.json"),true);
    
    if ($token == md5($config["token"])){
        header('Content-type: application/json');
        
        $objUtilities = new Utilities($config["hostname"],$config["username"],$config["password"],$config["database"]);
        $database = $objUtilities->database;
    
        $data=(array)json_decode($_POST['formulario']);
        $accion=$_POST['accion'];
        $page=$_POST['page'];
        $app=$_POST['app'];
        $encryptKey=md5($config["encryptKey"]);

        $result=eventSave($app,$database,$page,$data,$accion,$objUtilities,$encryptKey);
    }
}

echo json_encode($result);
    
    
function eventSave($app,$database,$page,$data,$accion,$objUtilities,$encryptKey){
        
    $nabuEvent = new NabuEvent($app,$page,$objUtilities);

    $audit=$database->getPageAudit($app,$page);
    $result=$nabuEvent->getEventSql($data,$accion,$audit['audit'],$encryptKey);

    $pagelinkX=$objUtilities->getpagelink($page);
    $pagelink = $pagelink[0];

    if ($pagelink == '' or pagelink == 'NULL' ){
        if ( strpos($page, '_m_pg')  !== false)
            $pagelink=str_replace("_m_pg","_v_pg",$page);
        else 
            $pagelink=str_replace("_pg","_v_pg",$page);
    }


    if ($result== 1){
        $tipomensaje=1;
        $redirect=1;

        if ($accion== 0)
            $mensaje='Guardado Exitoso';
        else
            if ($accion== 1){
                $mensaje='Actualizacion Exitosa';
            }
    }
    else{
        $tipomensaje=3;
        $mensaje='Problemas al realizar la Operacion';
    }

    $response["tipo"] =$tipomensaje;
    $response["mensaje"] =$mensaje;
    $response["duracion"] =2;
    $response["link"] =$pagelink;

    return $response;
}
?>