<?php

function datagrid($token,$empresa,$pagina,$link,$colTit){
    
    
?>
<table id="nabuTable" class="table table-striped table-bordered table-hover dt-responsive nowrap" width="100%" >
    <thead>                                    
        <tr>
            <?php
                for ($i=0; $i<sizeof($colTit); $i++)
                    echo "<th>".$colTit[$i]."</th>";
            ?>
        </tr>
        <tr>
            
            <?php
                for ($i=0; $i<sizeof($colTit); $i++){
                    if ($i < 2){
                        echo '<th><input type="text" data-column="'.$i.'"  class="form-control"></th>';
                        $visibilidad[$i]['className'] = 'all';
                    }
                    else{
                        echo '<th class="hidden-xs"><input type="text" data-column="'.$i.'"  class="form-control"></th>';
                        $visibilidad[$i]['className'] = 'desktop';
                    }
                }
                
                $jsonVisi=json_encode($visibilidad);
    
            ?>
        </tr> 
    </thead>

</table>

 <script>
     
     $(document).ready(function() {
         
            var table =$('#nabuTable').DataTable( {
                "paging": true,
                "searching": true,
                "ordering": false,
                "lengthChange": true,
                "info": true,
                "language": {
                    "paginate": {
                        "first": "Primero",
                        "last": "\u00daltimo",
                        "previous": "Atr\u00e1s",
                        "next": "Siguiente"
                    },
                    buttons: {
                        "copyTitle": 'Datos Copiados',
                        "copySuccess": {
                                    _: '%d líneas copiadas',
                                    1: '1 línea copiada'
                        }
                    },     
                    "emptyTable": "Sin datos para mostrar",
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "info": " Mostrando del _START_ al _END_ de _TOTAL_ datos en total  ",
                    "infoFiltered": " (Filtrado de _MAX_ datos en total)  "
                },
                "orderCellsTop": true,
                "columns": <?php echo $jsonVisi; ?>,
                
                        "columnDefs": [
                        {
                            targets: 0,
                            render: function (data, type, row, meta)
                            {
                                if (type === 'display')
                                {
                                    data = '<a href="<?php echo $link ?>' + encodeURIComponent(data) + '">'+encodeURIComponent(data)+'</a>';
                                }
                                return data;
                            }
                        }],
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                            "url": "../Events/getDatatables.php",
                            "contentType": "application/json",
                            "type": "GET", //  CAGC Tiene que ser get para que funcione la busqueda
                            "data": {
                                        "token":'<?php echo $token?>',
                                        "codigoemp":'<?php echo $empresa?>',
                                        "pagina":'<?php echo $pagina?>'
                            },
                },
                dom: 'Bfrtip',
                buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                } );
         
             // Apply the search
            table.columns().every(function (index) {
                $('#nabuTable thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                    table.column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
                });
            });

        }); 
        
       
    </script>      
<?php
}
?>


                           
                            
