var appbuscar_reservas = new Vue({
    el: '#frm-buscar-reservas',
    data:{
        mis_reservas:[],
        valor:''
    },
    methods:{
        buscarReservas(){
            fetch(`private/Modulos/reservas/procesos.php?proceso=buscarReserva&reserva=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_reservas = resp;
            });
        },
        modificarReserva(reserva){
            appreservas.reserva = reserva;
            appreservas.reserva.accion = 'modificar';
        },
        eliminarReserva(idReserva){


            alertify.confirm("Mantenimiento reservas","¿Está seguro de eliminar el registro?",
            ()=>{
                fetch(`private/Modulos/reservas/procesos.php?proceso=eliminarReserva&reserva=${idReserva}`).then( resp=>resp.json() ).then(resp=>{
                    this.buscarReservas();
                });
                alertify.success('Registro Eliminado correctamente.');
            },
            ()=>{
                alertify.error('Eliminacion cancelada');
            });


        }
    },
    created(){
        this.buscarReservas();
    }
});