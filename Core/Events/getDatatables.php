<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

include_once "../Class/Utilities.php";

$token =$_GET['token'];

$config =  json_decode(file_get_contents("../Config/config.json"),true);
    
if ($token == md5($config["token"])){

    header('Content-type: application/json');

        //Parametros del AJAX
        
        $codigoemp =$_GET['codigoemp'];
        $encryptKey = md5($config["encryptKey"]);
        $pagina =$_GET['pagina'];
        
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
    
        
        // DB table to use
        $tableR  = $database->getDataRecord($empresa,$pagina);
        $table   = $tableR[0];

       

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
    
        $fields  = $database->getFieldsPage($empresa,$pagina,'vw');
    
        $i=0;
        foreach($fields as $field){
        
            if ($i == 0)
                $primaryKey = $field[0];
            
            $columns[$i]['db']=$field[0];
            $columns[$i]['dt']=$i;
            
            /*
               
               Toca mirar cuando se aplica formato y esta encriptado
               
               $columns[$i]['formatter']=ejemplo;
                
                ejemplo:
                
                'formatter' => function( $d, $row ) { return date( 'jS M y', strtotime($d));})
                'formatter' => function( $d, $row ) { return '$'.number_format($d);})
            
            */
            
            
            $i=$i+1;
        }
    
        
        // SQL server connection information
        $sql_details = array(
            'user' => $config["username"],
            'pass' => $config["password"],
            'db'   => $config["database"],
            'host' => $config["hostname"]
        );
 

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        require( '../Class/ssp.class.php' );
        
        header('Content-type: application/json');

        echo json_encode(
            SSP::simple( $_GET,$sql_details, $table, $primaryKey, $columns,$database,$empresa,$encryptKey)
        );
}