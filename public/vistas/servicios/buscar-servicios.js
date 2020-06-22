var appbuscar_servicios = new Vue({
    el: '#frm-buscar-servicios',
    data:{
        mis_servicios:[],
        valor:''
    },
    methods:{
        buscarServicios(){
            fetch(`private/Modulos/servicios/procesos.php?proceso=buscarServicio&servicio=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_servicios = resp;
            });
        },
        modificarServicio(servicio){
            appservicios.servicio = servicio;
            appservicios.servicio.accion = 'modificar';
        },
        eliminarServicio(idServicio){
            if (confirm('¿Está seguro de elimiar el registro?')) {
                fetch(`private/Modulos/servicios/procesos.php?proceso=eliminarServicio&servicio=${idServicio}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarServicios();
            });          
            }
        }
    },
    created(){
        this.buscarServicios();
    }
});