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
            if (confirm('¿Está seguro de elimiar el registro?')) {
                fetch(`private/Modulos/habitaciones/procesos.php?proceso=eliminarHabitacion&habitacion=${idHabitacion}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarHabitaciones();
            });          
            }
        }
    },
    created(){
        this.buscarHabitaciones();
    }
});