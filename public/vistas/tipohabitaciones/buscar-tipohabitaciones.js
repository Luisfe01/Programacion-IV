var appbuscar_tipohabitaciones = new Vue({
    el: '#frm-buscar-tipohabitaciones',
    data:{
        mis_tipohabitaciones:[],
        valor:''
    },
    methods:{
        buscarTipohabitaciones(){
            fetch(`private/Modulos/tipohabitaciones/procesos.php?proceso=buscarTipohabitacion&tipohabitacion=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_tipohabitaciones = resp;
            });
        },
        modificarTipohabitacion(tipohabitacion){
            apptipohabitaciones.tipohabitacion = tipohabitacion;
            apptipohabitaciones.tipohabitacion.accion = 'modificar';
        },
        eliminarTipohabitacion(idTipohabitacion){
            if (confirm('¿Está seguro de elimiar el registro?')) {
                fetch(`private/Modulos/tipohabitaciones/procesos.php?proceso=eliminarTipohabitacion&tipohabitacion=${idTipohabitacion}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarTipohabitaciones();
            });          
            }
        }
    },
    created(){
        this.buscarTipohabitaciones();
    }
});