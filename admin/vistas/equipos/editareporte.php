<?php
$IdSesion = $_SESSION['IdUser'];
$getusermecanico = $_GET['usermecanico'];

$campos   = $campos->getCampos();
foreach ($campos as $campo) {
    $id_reporte       = $campo['id_reporte'];
    $equipo_id_equipo = $campo['equipo_id_equipo'];
    $creado_por       = $campo['creado_por'];
    $fecha_reporte    = $campo['fecha_reporte'];
    $problema         = $campo['problema'];
    $marca_temporal   = $campo['marca_temporal'];
    $actividad        = $campo['actividad'];
    $repuesto         = $campo['repuesto'];
    $num_salida_inv   = $campo['num_salida_inv'];
    $nombreq          = Equipos::obtenerNombreEquipo($equipo_id_equipo);
}
?>

<!-- CCS Y JS PARA LA CARGA DE IMAGEN -->
<script src="plugins/dropify/dropify.min.js"></script>
<link rel="stylesheet" href="plugins/dropify/dropify.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script type="text/javascript">
  jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2();
    });
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Editar Reporte </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="?controller=index&&action=index">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="?controller=equipos&&action=todos">Equipos</a></li>
            <li class="breadcrumb-item active"><a href="?controller=equipos&&action=reportediario&&id=<?php echo ($equipo_id_equipo) ?>">Reporte</a></li>
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
				<div class="container-fluid">
					<div class="row">
						<!-- ESTE DIV LO USO PARA CENTRAR EL FORMULARIO -->
						<!-- left column -->
						<div class="col-md-12">
						  <!-- general form elements -->
						  <div class="card card-primary">
							<!-- /.card-header -->
							<!-- form start -->
		<form role="form" action="?controller=equipos&&action=actualizareporte&&id_reporte=<?php echo ($id_reporte) ?>&&id_equipo=<?php echo ($equipo_id_equipo); ?>&&usermecanico=<?php echo($getusermecanico); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">

					<input type="hidden" name="creado_por" value="<?php echo ($creado_por) ?>">
					<input type="hidden" name="marca_temporal" value="<?php echo ($marca_temporal); ?>">
					<input type="hidden" name="estado_reporte" value="1">
					<input type="hidden" name="reporte_publicado" value="1">
					<input type="hidden" name="valor_reporte" value="0">
					<input type="hidden" name="num_salida_inv" value="0">


							  <div class="card-body">

							<div class="row">
											 <div class="col-sm-3 col-xs-12">
												<div class="form-group">
													<label>Fecha Reporte: <span>*</span></label>
													<input type="date" name="fecha_reporte" placeholder="Fecha" class="form-control required" required id="fecha_reporte" value="<?php echo utf8_encode($fecha_reporte); ?>">
												</div>
											</div>
								<div id="divplaca" class="col-md-4">
												<div class="form-group">
											<label> Seleccione el Equipo: <span>*</span></label>
							<select  class="form-control mi-selector0" id="equipo_id_equipo" name="equipo_id_equipo"  required>

										<option value="<?php echo utf8_encode($equipo_id_equipo); ?>" selected><?php echo utf8_encode($nombreq); ?></option>
										<?php
$rubros = Equipos::obtenerListaEquiposAsf();
foreach ($rubros as $campo) {
    $id_equipo     = $campo['id_equipo'];
    $nombre_equipo = $campo['nombre_equipo'];
    ?>
										<option value="<?php echo $id_equipo; ?>"><?php echo $nombre_equipo; ?></option>
										<?php }?>
								</select>
												</div>
								</div>
									<div class="col-md-12">
												<div class="form-group">
													<label>Problemas Presentados<span>*</span></label>
						<textarea class="form-control" rows="5" id="descripcion" name="problema"><?php echo htmlspecialchars_decode($problema); ?></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Actividad Realizada<span>*</span></label>
						<textarea class="form-control" rows="5" id="descripcion" name="actividad"><?php echo htmlspecialchars_decode($actividad); ?></textarea>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Nombre y/o Referencia del repuesto cambiado<span>*</span></label>
						<textarea class="form-control" rows="5" id="descripcion" name="repuesto"><?php echo htmlspecialchars_decode($repuesto); ?></textarea>
												</div>
											</div>
										</div>
							<div class="row">
								<div class="card-footer">
								  <button name="Submit" type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Haz clic aqui para guardar la información">Actualizar Reporte</button>
								</div>
						  </div>
						  </form>
						  <!-- /.card -->
						</div>
					  </div>
					</div>


					</div> <!-- FIN DE ROW-->
				</div><!-- FIN DE CONTAINER FORMULARIO-->
			</div> <!-- Fin Row -->
		</div> <!-- Fin Container -->
	</div> <!-- Fin Content -->



</div> <!-- Fin Content-Wrapper -->
<!-- Inicio Libreria formato moneda -->
<script src="dist/js/jquery.maskMoney.js" type="text/javascript"></script>
<script type="text/javascript">
$("#demo1").maskMoney({
prefix:'$ ', // The symbol to be displayed before the value entered by the user
allowZero:true, // Prevent users from inputing zero
allowNegative:true, // Prevent users from inputing negative values
defaultZero:false, // when the user enters the field, it sets a default mask using zero
thousands: '.', // The thousands separator
decimal: '.' , // The decimal separator
precision: 0, // How many decimal places are allowed
affixesStay : true, // set if the symbol will stay in the field after the user exits the field.
symbolPosition : 'left' // use this setting to position the symbol at the left or right side of the value. default 'left'
}); //
		</script>
<script type="text/javascript">
	var datefield = document.createElement("input")

datefield.setAttribute("type", "date")

if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
    document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
    document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"><\/script>\n')
}
if (datefield.type != "date"){ //if browser doesn't support input type="date", initialize date picker widget:
    $(document).ready(function() {
        $('#fecha_reporte').datepicker();
        //dateFormat: 'dd/mm/yy'
    });
}
</script>

<script type="text/javascript">
  $(function () {
   $('[data-toggle="tooltip"]').tooltip();
  })
</script>

<script>
	//CARGA DE IMAGENES
	$(document).ready(function(){
    // Basic
		$('.dropify').dropify();
		$('.dropify2').dropify();
    });

	$('.dropify').dropify({
				messages: {
					'default': 'Arrastra y suelta un archivo aquí o haz clic',
					'replace': 'Arrastra y suelta o haz clic para reemplazar',
					'remove':  'Remover',
					'error':   'Oops, sucedió algo mal.'
				},
				error: {
						'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} maximo).',
						'imageFormat': 'El formato de imagen no está permitido ({{ value }} solamente).',
						'fileExtension': 'El archivo no está permitido ({{ value }} solamente).'
				}
	});

	var drEvent = $('.dropify').dropify();

	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Realmente desea eliminar la imagen \"" + element.filename + "\" ?");
	});

	drEvent.on('dropify.error.fileSize', function(event, element){
		alert('Imagen demasiado grande!');
	});
	drEvent.on('dropify.error.minWidth', function(event, element){
		alert('Min width error message!');
	});
	drEvent.on('dropify.error.maxWidth', function(event, element){
		alert('Max width error message!');
	});
	drEvent.on('dropify.error.minHeight', function(event, element){
		alert('Min height error message!');
	});
	drEvent.on('dropify.error.maxHeight', function(event, element){
		alert('Max height error message!');
	});
	drEvent.on('dropify.error.imageFormat', function(event, element){
		alert('Error en el formato de la imagen!');
	});

	drEvent.on('dropify.errors', function(event, element){
		alert('Ha ocurrido un error!');
	});
	  var drEvent = $('.dropify').dropify();

	drEvent.on('dropify.afterClear', function(event, element){
		alert('Archivo Eliminado');
	});
</script>
