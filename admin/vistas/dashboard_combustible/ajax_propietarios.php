<?php
include_once '../../modelos/clientes.php';
include_once '../../controladores/clientesController.php';
include_once '../../modelos/productos.php';
include_once '../../controladores/usuariosController.php';
include_once '../../modelos/usuarios.php';
include_once '../../controladores/productosController.php';
include_once '../../modelos/equipos.php';
include_once '../../controladores/equiposController.php';
include_once '../../modelos/funcionarios.php';
include_once '../../controladores/funcionariosController.php';
include_once '../../modelos/usuarios.php';
include_once '../../controladores/usuariosController.php';
include_once '../../modelos/estaciones.php';
include_once '../../controladores/estacionesController.php';

include_once '../../modelos/proyectos.php';
include_once '../../controladores/proyectosController.php';

include_once '../../modelos/propietarios.php';
include_once '../../controladores/propietariosController.php';

include '../../vistas/index/estadisticas_acpm.php';
include '../../vistas/index/estadisticas_index.php';

$RolSesion = $_SESSION['IdRol'];
$IdSesion  = $_SESSION['IdUser'];
//Include database configuration file
include '../../include/class.conexion.php';

$getpropietario    = $_POST['id'];
$getnompropietario = Propietarios::obtenerNombre($getpropietario);

if (isset($_POST['daterange'])) {
    $fechaform = $_POST['daterange'];
} elseif (isset($_GET['daterange'])) {
    $fechaform = $_GET['daterange'];
}

date_default_timezone_set("America/Bogota");
$MarcaTemporal  = date('Y-m-d');
$FechaInicioDia = ($MarcaTemporal . " 00:00:000");
$FechaFinalDia  = ($MarcaTemporal . " 23:59:000");
//echo("FECHA QUE LLEGA:".$fechaform."<br>");

if ($fechaform != "") {
    $arreglo         = explode("-", $fechaform);
    $FechaIn         = $arreglo[0];
    $FechaFn         = $arreglo[1];
    $vectorfechaIn   = explode("/", $FechaIn);
    $vectorfechaFn   = explode("/", $FechaFn);
    $arreglofechauno = $vectorfechaIn[2] . "-" . $vectorfechaIn[0] . "-" . $vectorfechaIn[1];
    $arreglofechados = $vectorfechaFn[2] . "-" . $vectorfechaFn[0] . "-" . $vectorfechaFn[1];

    $FechaUno = str_replace(" ", "", $arreglofechauno);
    $FechaDos = str_replace(" ", "", $arreglofechados);
}

// Validación de la fecha en que inicia el Día

if ($FechaUno == "") {
    $FechaStart  = $FechaInicioDia;
    $datofechain = $MarcaTemporal;
} else {
    $FechaStart  = ($FechaUno . " 00:00:000");
    $datofechain = $FechaUno;
}
// Validación de la fecha en que Termina el Día
if ($FechaDos == "") {
    $FechaEnd       = $FechaFinalDia;
    $datofechafinal = $MarcaTemporal;
} else {
    $FechaEnd        = ($FechaDos . " 23:59:000");
    $limpiarvariable = str_replace(" ", "", $FechaDos);
    $datofechafinal  = $limpiarvariable;
}

?>

<div class="callout callout-warning col-md-6 col-sm-6 col-xs-12">
<h4>Equipo <?php echo ($getnompropietario); ?></h4>
<p>Reporte del <?php echo ($FechaStart) ?> al <?php echo ($FechaEnd) ?><br>
  <?php
$numtanqueos = AcpmconteoEquipo($FechaStart, $FechaEnd, $getpropietario);
$anqueoprom  = AcpmpromediotanqueoEquipo($FechaStart, $FechaEnd, $getpropietario);
?>
  
</p>
</div>


<div  class="col-md-3 col-xs-6">
<div class='small-box bg-orange'>
<div class="inner">
<h4><i class="fa fa-calendar"> </i><strong>

<?php
$bloque1 = AcpmmesPropietario($FechaStart, $FechaEnd, $getpropietario);
echo (number_format($bloque1, 0) . " Gl.");
?>
</strong></h4>
<p>Total Consumo</p>
</div>
</div>
</div>

<div  class="col-md-3 col-xs-6">
<div class='small-box bg-orange'>
<div class="inner">
<h4><i class="fa fa-calendar"> </i><strong>

<?php
$bloque1 = AcpmmesValorPropietario($FechaStart, $FechaEnd, $getpropietario);
echo ("$" . number_format($bloque1, 0));
?>
</strong></h4>
<p>Total Gasto</p>
</div>
</div>
</div>


<div class="clearfix">
                      <div class="pull-right tableTools-container2"></div>
                    </div>
              <div class="table-responsive mailbox-messages">
          <table id="example" class="table  table-responsive table-striped table-bordered table-hover" style="width: 100%;font-size: 14px;">


          <thead>
            <tr style="background-color: #4f5962;color: white;">
            <th style="width: 2%;">Id</th>
            <th>Fecha</th>
            <th>Propietario</th>
            <th style="width: 15%;">Equipo</th>
            <th style="width: 15%;">Despacho Gl</th>
            <th style="width: 15%;">Vr. Galón </th>
            <th style="width: 15%;">Vr. Compra</th>
            <th style="width: 15%;">P. Despacho</th>
            <th style="width: 15%;">Recibido por</th>
            <th style="width: 15%;">Kl - Hr</th>
            <th>Observaciones</th>
            </tr>
          </thead>

       <tbody>


<?php

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $db  = Db::getConnect();
    $sql = "SELECT * FROM reporte_combustibles as A, propietarios as B, equipos as C WHERE A.equipo_id_equipo=C.id_equipo and C.propietario=B.id_propietario and A.fecha_reporte >='" . $FechaStart . "' and A.fecha_reporte <='" . $FechaEnd . "' and A.reporte_publicado='1' and A.equipo_id_equipo<>'732' And B.id_propietario='" . $_POST['id'] . "'";

    $select = $db->query($sql);
    //echo ($sql);
    $camposq = $select->fetchAll();
    $i       = 0;
    foreach ($camposq as $campo) {
        $i                    = $i + 1;
        $id                   = $campo['id'];
        $fecha_reporte        = $campo['fecha_reporte'];
        $imagen               = $campo['imagen'];
        $valor_m3             = $campo['valor_m3'];
        $cantidad             = $campo['cantidad'];
        $indicador            = $campo['indicador'];
        $creado_por           = $campo['creado_por'];
        $estado_reporte       = $campo['estado_reporte'];
        $reporte_publicado    = $campo['reporte_publicado'];
        $tipo_despacho        = $campo['tipo_despacho'];
        $punto_despacho       = $campo['punto_despacho'];
        $marca_temporal       = $campo['marca_temporal'];
        $observaciones        = $campo['A.observaciones'];
        $equipo_id_equipo     = $campo['equipo_id_equipo'];
        $proyecto_id_proyecto = $campo['proyecto_id_proyecto'];
        $despachado_por       = $campo['despachado_por'];
        $recibido_por         = $campo['recibido_por'];
        $nomestacion          = Estaciones::ObtenerNombreEstacion($punto_despacho);
        $nomequipo            = Equipos::obtenerNombreEquipo($equipo_id_equipo);
        $nombrerecibe         = Usuarios::obtenerNombreUsuario($recibido_por);
        $nombredespachador    = Funcionarios::obtenerNombreFuncionario($despachado_por);
        $nomproyecto          = Proyectos::obtenerNombreProyecto($proyecto_id_proyecto);
        $idpropietario        = Equipos::obtenerPropietarioEquipo($equipo_id_equipo);
        $nompropietario       = Propietarios::obtenerNombre($idpropietario);
        $ventatotal           = $cantidad * $valor_m3;

        ?>

         <tr>
              <td><?php echo ($id) ?></td>
              <td><?php echo ($fecha_reporte) ?></td>
              <td><?php echo utf8_decode($nompropietario) ?></td>
              <td><?php echo utf8_decode($nomequipo) ?></td>
              <td><?php echo utf8_decode($cantidad); ?></td>
              <td><?php echo utf8_decode("$" . number_format($valor_m3)); ?></td>
              <td><?php echo utf8_decode("$" . number_format($ventatotal)); ?></td>
              <td><?php echo utf8_decode($nomestacion) ?></td>
              <td><?php echo utf8_decode($nombrerecibe) ?></td>
              <td><?php echo utf8_decode($indicador) ?></td>
              <td><?php echo utf8_decode($observaciones); ?> <br><?php echo utf8_decode($nomproyecto); ?></td>
            </tr>


        <?php
}

    ?>

 </tbody>



          </table>
        </div> <!-- Fin Row -->

    <?php

    $rowCount = $i;
    //Display states list
    if ($rowCount > 0) {
    } else {
        echo '<strong>Euipo sin datos en la fecha seleccionada</strong>';
    }
}

?>
      <script type="text/javascript">
      jQuery(function($) {

$('#cotizaciones2 thead tr:eq(1) th').each( function () {
        var title = $('#cotizaciones2 thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } );

    var myTable = $('#cotizaciones2').DataTable({
      responsive:true,
      "order": true,
      orderCellsTop: true,
      //"destroy":false,
      paging: false,
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

             pageTotal4 = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

              pageTotal3 = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

             // Update footer

              $( api.column( 3 ).footer() ).html(
                ''+formatmoneda(pageTotal3,'GL' )
            );

               $( api.column( 5 ).footer() ).html(
                '$'+formatmoneda(pageTotal4,'' )
            );

        },


    });

    // Apply the search
    myTable.columns().every(function (index) {
        $('#cotizaciones2 thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            myTable.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        });
    });

        var myTable =
        $('#cotizaciones2')


        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

        new $.fn.dataTable.Buttons( myTable, {
          destroy: true,
         buttons: [

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

          ]
        } );

        myTable.buttons().container().appendTo( $('.tableTools-container2') );

        setTimeout(function() {
          $($('.tableTools-container2')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
          });
        }, 500);

      });
    </script>



