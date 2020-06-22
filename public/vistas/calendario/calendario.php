

<form id="frm-calendario" >

<?php
require_once('bdd.php');


$sql = " SELECT reservas.idReserva, reservas.fechainicio, reservas.fechafinal, clientes.idCliente, clientes.nombre, habitaciones.idHabitacion, habitaciones.numhabitacion FROM reservas 
INNER JOIN clientes on reservas.idCliente=clientes.idCliente 
INNER JOIN habitaciones ON reservas.idHabitacion=habitaciones.idHabitacion";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>





	
	<!-- FullCalendar -->
<link href='public/vistas/calendario/css/fullcalendar.css' rel='stylesheet' />

    <div class="card" style="width: 65rem;">
        <h3 class="card-header">
          <center> Calendario <i class="fas fa-fw fa-calendar-alt"></i>
            <button type="button" id="btn-close-calendario" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></center> 
        </h3>
        <div class="card-body">
		<div class="table-wrapper-scroll-y my-custom-scrollbar">

  



    <div class="container">
            <div id="calendar" class="col-md-12">
            </div>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->

    <!-- Bootstrap Core JavaScript -->
	
	<!-- FullCalendar -->
	<script src='public/vistas/calendario/js/moment.min.js'></script>
	<script src='public/vistas/calendario/js/fullcalendar/fullcalendar.min.js'></script>
	<script src='public/vistas/calendario/js/fullcalendar/fullcalendar.js'></script>
	<script src='public/vistas/calendario/js/fullcalendar/locale/es.js'></script>
	
	
	<script>

	$(document).ready(function() {

	   var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
		
		$('#calendar').fullCalendar({
			header: {
				 language: 'es',
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay',

			},
			defaultDate: yyyy+"-"+mm+"-"+dd,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,


			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
			
				$fechainicio = explode(" ", $event['fechainicio']);
				$fechafinal = explode(" ", $event['fechafinal']);
				$fechainicio = $fechainicio[0];
				$fechafinal = $fechafinal[0];
			?>
				{
					idReserva: '<?php echo $event['idReserva']; ?>',
					title: '<?php echo $event['nombre']." reservó hab #".$event['numhabitacion']; ?>',
					start: '<?php echo $fechainicio; ?>',
					end: '<?php echo $fechafinal; ?>',
					color: "#D1B5B5",
				},
			<?php endforeach; ?>
			]
		});
		
		function edit(event){
			fechainicio = event.start.format('YYYY-MM-DD');
			if(event.end){
				fechafinal = event.end.format('YYYY-MM-D');
			}else{
				fechafinal = fechainicio;
			}
			
			idReserva =  event.idReserva;
			
			Event = [];
			Event[0] = idReserva;
			Event[1] = fechainicio;
			Event[2] = fechafinal;
			
			$.ajax({
			 url: 'public/vistas/calendario/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Reserva modificada correctamente');
					}else{
						alert('No se ha podido modificar la reserva'); 
					}
				}
			});
		}
		
	});

    </script>
</div>
        </div>
    </div>
</form>







