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
            piso   : {
                idPiso : 0,
                numpiso  : ''
            },
            
            msg       : ''
        },
        pisos : {},
        tipohabitaciones : {}
    },
    methods:{
        guardarHabitaciones(){
            fetch(`private/Modulos/habitaciones/procesos.php?proceso=recibirDatos&habitacion=${JSON.stringify(this.habitacion)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarHabitaciones(){
            this.habitacion.idHabitacion=0;
            this.habitacion.tipohabitacion.label="";
            this.habitacion.piso.label="";
            this.habitacion.numhabitacion="";
            this.habitacion.numcamas="";
            this.habitacion.disponibilidad="";
            this.habitacion.precio="";
            this.habitacion.accion="nuevo";
            this.habitacion.msg="";
        }
    },
    created(){
        fetch(`private/Modulos/habitaciones/procesos.php?proceso=traer_pisos_tipohabitaciones&habitacion=''`).then( resp=>resp.json() ).then(resp=>{
            this.tipohabitaciones = resp.tipohabitaciones;
            this.pisos = resp.pisos;

        });
    }
});