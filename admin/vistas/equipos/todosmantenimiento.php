<?php
ini_set('display_errors', '0');
include_once 'modelos/usuarios.php';
include_once 'controladores/usuariosController.php';

include_once 'modelos/equipos.php';
include_once 'controladores/equiposController.php';

include_once 'modelos/propietarios.php';
include_once 'controladores/propietariosController.php';

$IdSesion = $_SESSION['IdUser'];
$id_equipo=$_GET['id_equipo'];


?>
<!-- DataTables -->
  <!-- <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Reporte Repuestos </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="?controller=index&&action=index">Inicio</a></li>
            <li class="breadcrumb-item"><a href="?controller=equipos&&action=todos">Equipos</a></li>

            <li class="breadcrumb-item active">Reporte</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">

    <div class="col-lg-12">
    <div class="card card-default">
      <div class="card-body">
      <div class="clearfix">
                      <div class="pull-left tableTools-container"></div>
                    </div>
              <div class="table-responsive mailbox-messages">
         <table id="cotizaciones" class="table  table-responsive table-striped table-bordered table-hover" style="width: 100%">
           <tfoot style="display: table-header-group;">
                                    <th style="background-color: #dff0d8" class="success"></th>
                                    <th style="background-color: #dff0d8" class="success"></th>
                                    <th style="background-color: #dff0d8" class="success"></th>
                                    <th style="background-color: #dff0d8" class="success"></th>
                                    <th style="background-color: #dff0d8" class="success"></th>
                                    <th style="background-color: #dff0d8" class="success"></th>
                                    <th style="background-color: #dff0d8" class="success"></th>
                                    <th style="background-color: #dff0d8" class="success"></th>
                                   <th style="background-color: #dff0d8" class="success"></th>


                            </tfoot>
          <thead>
            <tr style="background-color: #4f5962;color: white;">
              <th>Orden</th>
              <th>Fecha Reporte</th>
              <th>Equipo</th>
              <th>Propietario</th>
              <th>Reportado por</th>
              <th>Problema Presentado</th>
               <th>Repuestos</th>
              <th>Solución</th>

              <th style="width: 10%;">Acción</th>
            </tr>
            <tr>
               <th>Orden</th>
             <th>Fecha Reporte</th>
              <th>Equipo</th>
              <th>Propietario</th>
              <th>Reportado por</th>
              <th>Problema Presentado</th>
               <th>Repuestos</th>
              <th>Solución</th>

              <th style="width: 10%;">Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
$res         = Equipos::obtenertodosreportes();
$movimientos = $res->getCampos();
foreach ($movimientos as $mov) {
    $id_reporte       = $mov['id_reporte'];
    $equipo_id_equipo = $mov['equipo_id_equipo'];
    $creado_por       = $mov['creado_por'];
    $fecha_reporte    = $mov['fecha_reporte'];
    $problema         = $mov['problema'];
    $num_salida_inv   = $mov['num_salida_inv'];
    $actividad        = $mov['actividad'];
    $repuesto         = $mov['repuesto'];
    $nombreq          = Equipos::obtenerNombreEquipo($equipo_id_equipo);
    $idpropietario    = Equipos::obtenerPropietarioEquipo($equipo_id_equipo);
    $nompropietario   = Propietarios::obtenerNombre($idpropietario);
    $nombrereporta    = Usuarios::obtenerNombreUsuario($creado_por);
    ?>
            <tr>
            <td><?php echo utf8_decode("OT-00".$id_reporte); ?></td>
            <td><?php echo utf8_decode(fechalarga($fecha_reporte)); ?></td>
            <td><?php echo utf8_decode($nombreq); ?></td>
            <td><?php echo utf8_decode($nompropietario); ?></td>
            <td><?php echo utf8_decode($nombrereporta); ?></td>
            <td><?php echo htmlspecialchars_decode($problema); ?></td>
            <td><?php echo htmlspecialchars_decode($repuesto); ?></td>
            <td><?php echo htmlspecialchars_decode($actividad); ?></td>

              <td>
                <div class="btn-group">
                      <button type="button" class="btn btn-default btn-flat">
                         <a href="?controller=equipos&&action=editareporte&&id=<?php echo $id_reporte; ?>&&id_equipo=<?php echo ($id_equipo) ?>&&usermecanico=1" class="tooltip-primary text-success" title="Editar Reporte">
                <i class="fa fa-edit bigger-110 "></i>
              </a>
                      </button>
                       <button type="button" class="btn btn-default btn-flat">
                        <a  href="#" onclick="eliminar(<?php echo $id_reporte; ?>,<?php echo ($id_equipo); ?>);" class="tooltip-primary text-danger" title="Eliminar Reporte">
                <i class="fa fa-trash bigger-110 "></i>
              </a>
                       </button>

                    </div>
              </td>
            </tr>
            <?php
}
?>
          </tbody>
          </table>
        </div> <!-- Fin Row -->
      </div> <!-- Fin card -->
    </div>
    </div>



      </div> <!-- Fin Row -->
    </div> <!-- Fin Container -->
  </div> <!-- Fin Content -->
</div> <!-- Fin Content-Wrapper -->

<script>
function eliminar($id,$equipo){
   eliminar=confirm("¿Deseas eliminar este registro?");
   if (eliminar)
     window.location.href="?controller=equipos&&action=eliminareporte&&id="+$id+"&&id_equipo="+$equipo+"&&usermecanico=1";
else
  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
    alert('No se ha podido eliminar el registro...')
}
</script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
          <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
         <script src="dist/js/buttons.colVis.min.js"></script>
          <script src="dist/js/buttons.print.min.js"></script>
           <script src="dist/js/dataTables.select.min.js"></script>
           <script src="dist/js/buttons.flash.min.js"></script>



<script>
   function format2(n, currency) {
    return currency + " " + n.toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
function formatmoneda(n, currency) {
    return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
        $(document).ready(function() {
    $('#example').DataTable( {
         "searching": true,
        "ordering": true,
        "paging":   true,
        "info":     true,
        "aLengthMenu": [[100, 200, 300, -1], [100, 200, 300, "Todas"]],
    "pageLength": 100,


    } );
} );
    </script>

<!-- page script -->
<script>
  $(function () {
    $('#cotizaciones33').DataTable({
      "paging": true,
      "lengthChange": true,
      "lengthMenu": [[25, 50, 150, -1], [25, 50, 150, "All"]],
      "searching": true,
      "order": [[ 0, "asc" ]],
      "ordering": true,
      "info": true,
      "autoWidth": false,
    language: {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}

    });
  });
</script>
<script type="text/javascript">
      jQuery(function($) {

$('#cotizaciones thead tr:eq(1) th').each( function () {
        var title = $('#cotizaciones thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } );

    var table = $('#cotizaciones').DataTable({
      responsive:true,
      "order": true,
        orderCellsTop: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado nada - Lo sentimos",
            "info": "Mostrar página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
           },

    "lengthMenu": [[5000, 7000, 10000, -1], [5000, 7000, 10000, "All"]],

          select: {
            style: 'multi'
          },
          "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };


            // Total over all pages


            pageTotal6 = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );



             $( api.column( 2 ).footer() ).html(
                '$'+formatmoneda(pageTotal6,'' )
            );

        },


    });

    // Apply the search
    table.columns().every(function (index) {
        $('#cotizaciones thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        });
    });

        var myTable =
        $('#cotizaciones')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable( {
retrieve: true,


          "aoColumns": [
            { "bSortable": false },
            null, null,null, null,null,null,null,null, null,null, null,null,null,null,null, null,null, null,null,null,null,
            { "bSortable": false }
          ],
          "aaSorting": [],
          "scrollX": true,

          //"bProcessing": true,
              //"bServerSide": true,
              //"sAjaxSource": "http://127.0.0.1/table.php" ,

          //,

          //"sScrollXInner": "120%",
          //"bScrollCollapse": true,
          //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
          //you may want to wrap the table inside a "div.dataTables_borderWrap" element

          //"iDisplayLength": 50


          } );





        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

        new $.fn.dataTable.Buttons( myTable, {
         buttons: [


            {
            "extend": "csv",
            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'></span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {

            "extend": "excelHtml5",
            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'></span>",
            "className": "btn btn-white btn-primary btn-bold"

            },
            {

            "extend": "pdf",
            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'></span>",
            "className": "btn btn-white btn-primary btn-bold",
            orientation: 'landscape',
                     pageSize: 'LEGAL',
            },
            {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'></span>",
            "className": "btn btn-white btn-primary btn-bold",
            autoPrint: true,
            message: 'Está impresión se produjo desde la App'
            }
          ]
        } );
        myTable.buttons().container().appendTo( $('.tableTools-container') );

        // style the message box
        // var defaultCopyAction = myTable.button(1).action();
        // myTable.button(1).action(function (e, dt, button, config) {
        //   defaultCopyAction(e, dt, button, config);
        //   $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        // });




        // var defaultColvisAction = myTable.button(0).action();
        // myTable.button(0).action(function (e, dt, button, config) {

        //   defaultColvisAction(e, dt, button, config);


        //   if($('.dt-button-collection > .dropdown-menu').length == 0) {
        //     $('.dt-button-collection')
        //     .wrapInner('<ul class="dropdown-menu dropdown-light " />')
        //     .find('a').attr('href', '#').wrap("<li />")
        //   }
        //   $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        // });

        //

        setTimeout(function() {
          $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
          });
        }, 500);





        myTable.on( 'select', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
          }
        } );
        myTable.on( 'deselect', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
          }
        } );






        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

        //select/deselect all rows according to table header checkbox
        $('#cotizaciones > thead > tr > th input[type=checkbox], #cotizaciones_wrapper input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header

          $('#cotizaciones').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) myTable.row(row).select();
            else  myTable.row(row).deselect();
          });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#cotizaciones').on('click', 'td input[type=checkbox]' , function(){
          var row = $(this).closest('tr').get(0);
          if(this.checked) myTable.row(row).deselect();
          else myTable.row(row).select();
        });



        $(document).on('click', '#cotizaciones .dropdown-toggle', function(e) {
          e.stopImmediatePropagation();
          e.stopPropagation();
          e.preventDefault();
        });



        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header

          $(this).closest('table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
            else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
          });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
          var $row = $(this).closest('tr');
          if($row.is('.detail-row ')) return;
          if(this.checked) $row.addClass(active_class);
          else $row.removeClass(active_class);
        });



        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

        //tooltip placement on right or left
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table')
          var off1 = $parent.offset();
          var w1 = $parent.width();

          var off2 = $source.offset();
          //var w2 = $source.width();

          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }




        /***************/
        $('.show-details-btn').on('click', function(e) {
          e.preventDefault();
          $(this).closest('tr').next().toggleClass('open');
          $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        });
        /***************/


      })
    </script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  exportEnabled: true,
  animationEnabled: true,
  title:{
    text: "Reporte <?php echo ($nombre_equipo); ?>"
  },
  axisX:{
    valueFormatString: "DD MMM"
  },
  axisY: {
    title: "<?php echo ($unidad_reportada); ?> Trabajadas",
    includeZero: false,
    scaleBreaks: {
      autoCalculate: false
    }
  },
  data: [{
    type: "line",
    xValueFormatString: "DD MMM",
    yValueFormatString: "#.### <?php echo ($unidad_reportada); ?>",
    color: "#F08080",
    dataPoints: [
     <?php
// Consulta por día
$mesactual = date("n");
$mesvector = $mesactual - 1;

$res    = Equipos::GraficaReporteDiario($mesactual, $id_equipo);
$campos = $res->getCampos();
foreach ($campos as $campo) {
    $DIA = $campo['DIA'];
    $TB  = $campo['TB'];
    ?>
      { x: new Date(2019, <?php echo ($mesvector) ?>, <?php echo ($DIA) ?>), y: <?php echo ($TB) ?> },
     <?php
}
?>

    ]
  }]
});
chart.render();

}
</script>