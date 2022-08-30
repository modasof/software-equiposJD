 
/*=============================================
=            Sección Notas           =
=============================================*/

- 21-Febrero-2022:@katyRuiz Solicitud de agregar checkbox al momento de aprobar una orden de compra.
- 21-Febrero-2022:@katyRuiz Se organiza Oc para que solo dejar unos valores.
- 22-Febrero-2022:@Yenny Actualización en bloque de las cajas menores asociando equipo. 
- 22-Febrero-2022:@Angela Solicitud de cargar los nuevas tarifas en software
- 23-Febrero-2022:@Rafael Reunión y capacitación con Germán - Alexander
- 23-Febrero-2022:@grupocontabilidad Se realiza Manual de procedimiento actualizar vr unitario OC.
- 24-Febrero-2022:@Yenny Solicitud de bug en listado de conductores


/*=====  Final Sección Notas  ======*/


# Actualización 21 Febrero 2022 

- Se agrega función de editar gastos caja menor (MVC) gastos
- Se agrega el menú de cuentas por pagar por usuario (M) usuarios

# Actualización 22 Febrero 2022 
 - Se actualizan las nuevas tarifas de las comisiones por rango (V) index/informe1
 - Creación de nuevo Rol - Conductor Mula para visualizar comisiones
 - Se actualizan formularios para listado de precios de rutas, alquiler, productos (MVC) clientesprecios 
 - Se actualiza funcionalidad por módulo clientes (V) Clientes

# Actualización 23 de Febrero 
- Se agrega funcionalidad de editar el valor unitario y cantidades en orden de compra, (MVC) compras

# Actualización 24 de Febrero 

- Solución al bug de conductores (Listado de Conductores volquetas y mula)
- Solución al bug de verificar cantidades en cotizaciones
- Se agrega restricción en gastos de caja menor por rol 

# Actualización 25 de Febrero

- Se realiza ajuste de cálculo de valores tanto en rutas como en horas máquina de manera automatizada. 

# Actualización 4 de Marzo

- Actualización de abonos y pagos a compras con fechas anteriores y vista de saldos en lista de ordenes de compra.
- Se agrega columna con rendimientos por equipo en volquetas
- Se agrega opción de anticipo a proveedor en los egresos de cuentas.

# Actuualización 7 de Marzo

- Se agrega la función de seleccionar por items para aprobación de orden de compra, adicional a eso se habilita la función retornar a Espera de aprobación. 

# Actualización 7 Marzo a 12 de Marzo
- Opción de pago "a convenir "
- Opción de pagar orden de compra sin adjunto de factura
- Ajustar rubros por usuario
- Agregar RQ el rubro y sub rubro
- Link a la RQ en la orden de compra 
- Pasar a cotización lo que este aprobado por el jefe de área
- Actualización y ajuste del módulo carga a inventario de las compras por rango de fecha, se cambia el campo de fecha que estaba por defecto del día actual a un campo editable.

# Actualización 12 de Marzo al 27 de Abril 
-   Replicar anticipo a proveedor
-   Agregar opción de seleccionar diferentes item para aprobar
-   Verificar órdenes de compra con items que no aplican
-   Ajuste de los pagos a compras anteriores a Marzo 01 - Terluz - Nomadas
-   Opción de pago "a convenir "
-   Opción de pagar orden de compra sin adjunto de factura
-   Ajustar rubros por usuario
-   Agregar RQ el rubro y sub rubro
-   Link a la RQ en la orden de compra 
-   Notificaciones de las cuentas por pagar que se suben en el dashboard
-   Pasar a cotización lo que este aprobado por el jefe de área
-   Actualización y ajuste del módulo carga a inventario de las compras por rango de fecha, se cambia el campo de fecha que estaba por defecto del día actual a un campo editable.
-   Quitar lo que está aprobado en el dashboard de RQ (verificar todos los roles)
-   Subir adjunto de cotizaciones por proveedor al finalizar las cotizaciones
-   Pasar a espera de aprobación cuando se sube la cotización 
-   Módulo de aprobación y proyección de pagos 
-   Módulo cuentas por pagar 
-   Módulo cuentas por cobrar
# Actualización 23 de Mayo 

- Seleccionar ordenes de compra y agregar botón Factura
- Mostrar todos los item de las ordenes de compra seleccionadas y dejar eliminar y editar valores
- La edición por ajax  sin refrescar la página
- Agregar columna de iva (campo porcentaje)
- Agregar campos y que estos se calculen automaticamente (Subtotal, Iva, Retenciones, Descuentos, retención asumida, total) 
- Mostrar relación de anticipos para cruzar con la factura "
- Editar cantidades sin actualizar la vista
- Agregar campo base y aplicar retención , aplica para dos bases
- Módulo de retenciones, editar, crear, eliminar, agregar a listado en"subir factura"
- Editar factura (vista igua que al momento de cargarla)
- Centralizar todas las ordenes de compra en un solo lugar
- Filtrar por proveedor todas las ordenes de compra
- Validación al cargar la factura de una orden de compra, que no se repita. 
- Cruce con anticipos
- Realizar Abonos / pagos 

# Actualización 19 de Julio 2022

- Campo en tabla recepción de OC (Usuario que solicita la RQ)
- Actualizacion de formulario reporte de kilometraje.  

# Actualización 22 de Julio 2022

- Validación de campos duplicados en parametrización 
- Optimización de formulario Km, se agrega el campo km inicial en equipos. 
- Módulo de propietarios
- Módulo horas máquina campo adicional para verificar fecha de reporte versus fecha de creación del registro. 
- Mensaje informativo con reporte fuera del rango de la fecha actual 
- Solución de Bug en rutas de cliente


