var appbuscar_habitaciones = new Vue({
    el: '#frm-buscar-habitaciones',
    data:{
        mis_habitaciones:[],
        valor:''
    },
    methods:{
        buscarHabitaciones(){
            fetch(`private/Modulos/habitaciones/procesos.php?proceso=buscarHabitacion&habitacion=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_habitaciones = resp;
            });
        },
        modificarHabitacion(habitacion){
            apphabitaciones.habitacion = habitacion;
            apphabitaciones.habitacion.accion = 'modificar';
        },
        eliminarHabitacion(idHabitacion){


            alertify.confirm("Mantenimiento Clientes","¿Está seguro de eliminar el registro?",
            ()=>{
                fetch(`private/Modulos/habitaciones/procesos.php?proceso=eliminarHabitacion&habitacion=${idHabitacion}`).then( resp=>resp.json() ).then(resp=>{
                    this.buscarHabitaciones();
                });
                alertify.success('Registro Eliminado correctamente.');
            },
            ()=>{
                alertify.error('Eliminacion cancelada');
            });


        }
    },
    created(){
        this.buscarHabitaciones();
    }
});