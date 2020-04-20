var apphabitaciones = new Vue({
    el:'#frm-habitaciones',
    data:{
        habitacion:{
            idHabitacion : 0,
            accion    : 'nuevo',
            numhabitacion   : '',
            numcamas    : '',
            disponibilidad : '',
            msg       : ''
        }
    },
    methods:{
        guardarHabitaciones(){
            fetch(`private/Modulos/habitaciones/procesos.php?proceso=recibirDatos&habitacion=${JSON.stringify(this.habitacion)}`).then( resp=>resp.json() ).then(resp=>{
                this.habitacion.msg = resp.msg;
            });
        },
        limpiarHabitaciones(){
            this.habitacion.idHabitacion=0;
            this.habitacion.accion="nuevo";
            this.habitacion.numhabitacion="";
            this.habitacion.numcamas="";
            this.habitacion.disponibilidad="";

        }
    }
});