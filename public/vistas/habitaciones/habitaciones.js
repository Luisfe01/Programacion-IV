Vue.component('v-select', VueSelect.VueSelect);

var apphabitaciones = new Vue({
    el:'#frm-habitaciones',
    data:{
        habitacion:{
            idHabitacion : 0,
            accion    : 'nuevo',
            tipohabitacion   : {
                idTipohabitaciones : 0,
                tipo   : ''
            },
            
            msg       : ''
        },
        tipohabitaciones : {}
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
            this.habitacion.msg="";
        }
    },
    created(){
        fetch(`private/Modulos/habitaciones/procesos.php?proceso=traer_tipohabitaciones&habitacion=''`).then( resp=>resp.json() ).then(resp=>{
            this.tipohabitaciones = resp.tipohabitaciones;
        });
    }
});