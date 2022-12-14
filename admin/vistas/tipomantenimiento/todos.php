<?php 

ini_set('display_errors', '0');
include_once 'modelos/unidadesmed.php';
include_once 'controladores/unidadesmedController.php';
$RolSesion = $_SESSION['IdRol'];
$IdSesion = $_SESSION['IdUser'];


 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tipo Mantenimiento</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="?controller=index&&action=index">Inicio</a></li>
            <li class="breadcrumb-item active">Tipo Mantenimiento</li>
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
		<div class="card card-primary">
			<div class="card-body">
				  <a href="?controller=tipomantenimiento&&action=nuevo" class="btn btn-success" style="float: right;"><i class="fa fa-file-text-o bigger-110 "></i> Nuevo Tipo Mantenimiento</a>
				  <br><br>
			<div class="card-header">
			  <h3 class="card-title">Tipo Mantenimiento</h3>
			</div>
				  <table id="cotizaciones" class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
						  
						  <th>Tipo Mantenimiento</th>
              <th>Nombre</th>
              <th>Frecuencia</th>
              <th>Acción</th>
						</tr>
					</thead>
				  <tbody>
					  <?php
					  $campos = $campos->getCampos();
					  foreach ($campos as $campo){
  						$id_tipomantenimiento = $campo['id_tipomantenimiento'];
  						$nombre_tipomantenimiento = $campo['nombre_tipomantenimiento'];
              $tipo_tipomantenimiento = $campo['tipo_tipomantenimiento'];
              $frecuencia_tipomantenimiento = $campo['frecuencia_tipomantenimiento'];
               $unidad_id_unidad = $campo['unidad_id_unidad'];
               $nombreunidad = Unidadesmed::obtenerNombre($unidad_id_unidad);
						?>
						<tr>
						
              <td><?php echo $tipo_tipomantenimiento; ?></td>
              <td><?php echo $nombre_tipomantenimiento; ?></td>
              <td><?php echo $frecuencia_tipomantenimiento."-".$nombreunidad; ?></td>
							<td>
  							<a href="?controller=tipomantenimiento&&action=editar&&id=<?php echo $id_tipomantenimiento; ?>" class="tooltip-primary text-success" data-rel="tooltip" data-placement="top" title="" data-original-title="Editar Tipo Mantenimiento">
  								<i class="fa fa-edit bigger-110 "></i>
  							</a>
  							<a href="#" onclick="eliminar(<?php echo $id_tipomantenimiento; ?>);" class="tooltip-primary text-danger" data-rel="tooltip" data-placement="top" title="" data-original-title="Eliminar Tipo Mantenimiento">
  								<i class="fa fa-trash bigger-110 "></i>
  							</a>
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
function eliminar(id){
   eliminar=confirm("¿Deseas eliminar este registro?");
   if (eliminar)
     window.location.href="?controller=tipomantenimiento&&action=eliminar&&id="+id;
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


<!-- page script -->
<script>
  $(function () {
    $('#cotizaciones').DataTable({
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

