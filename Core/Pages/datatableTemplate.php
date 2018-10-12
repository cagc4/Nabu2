<?php

function datagrid(){
    
?>
<table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" width="100%" >
    <thead>                                    
        <tr>
            <th>Link</th>
            <th>Categoria</th>
            <th>Descripcion</th>
            <th>Estado</th>
            </tr>
        <tr>
            <th><input type="text" data-column="1"  class="form-control"></th>
            <th><input type="text" data-column="2"  class="form-control"></th>
            <th class="hidden-xs"><input type="text" data-column="3"  class="form-control"></th>
            <th class="hidden-xs"><input type="text" data-column="4"  class="form-control"></th>
        </tr> 
    </thead>

</table>
                                
 <script>
     
     $(document).ready(function() {
         
            var table =$('#example').DataTable( {
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
                "columns": [

                        { className:'all'},
                        { className:'all'},
                        { className:'desktop'},
                        { className:'desktop'}
                       ],
                
                        columnDefs: [
                        {
                            targets: 0,
                            render: function (data, type, row, meta)
                            {
                                if (type === 'display')
                                {
                                    data = '<a href="?p=nb_categorias_m_pg&accion=b&nb_id_fld=' + encodeURIComponent(data) + '">'+encodeURIComponent(data)+'</a>';
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
                                        "token": 'e53db2b5b93254fddb55de43a3323970',
                                        "codigoemp":'nabufina',
                                        "pagina":'nb_categorias_v_pg'
                            },
                },
                dom: 'Bfrtip',
                buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                } );
         
             // Apply the search
            table.columns().every(function (index) {
                $('#example thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
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


                           
                            
