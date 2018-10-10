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

/*
array(
        'db'        => 'start_date',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    ),

*/

$token = 'e53db2b5b93254fddb55de43a3323970';

$config =  json_decode(file_get_contents("../Config/config.json"),true);
    
    if ($token == md5($config["token"])){
        
        $configDB =  json_decode(file_get_contents("../Config/config.json"),true);
        
        // DB table to use
        $table = 'nb_categorias_vw';

        // Table's primary key
        $primaryKey = 'nb_id_fld';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'nb_id_fld', 'dt' => 0 ),
            array( 'db' => 'nb_categoria_fld',  'dt' => 1 ),
            array( 'db' => 'nb_descripcion_fld',   'dt' => 2 ),
            array( 'db' => 'nb_estado_fld',     'dt' => 3 )
        );

        // SQL server connection information
        $sql_details = array(
            'user' => $configDB["username"],
            'pass' => $configDB["password"],
            'db'   => $configDB["database"],
            'host' => $configDB["hostname"]
        );
 

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        require( '../Class/ssp.class.php' );

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );
}