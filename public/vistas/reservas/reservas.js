Vue.component('v-select', VueSelect.VueSelect);

var appreservas = new Vue({
    el:'#frm-reservas',
    data:{
        reserva:{
            idReserva : 0,
            accion    : 'nuevo',
            habitacion   : {
                idHabitacion : 0,
                numhabitacion   : ''
            },
            cliente   : {
                idCliente : 0,
                nombre  : ''
            },

            
            fechainicio : '',
            fechafinal   : '',
            msg       : ''
        },
        clientes : {},
        habitaciones : {}
    },
    methods:{
        guardarReservas(){
            fetch(`private/Modulos/reservas/procesos.php?proceso=recibirDatos&reserva=${JSON.stringify(this.reserva)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarReservas(){
        }
    },
    created(){
        fetch(`private/Modulos/reservas/procesos.php?proceso=traer_clientes_habitaciones&reserva=''`).then( resp=>resp.json() ).then(resp=>{
            this.habitaciones = resp.habitaciones;
            this.clientes = resp.clientes;

        });
    }
});