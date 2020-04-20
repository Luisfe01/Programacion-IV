var appservicios = new Vue({
    el:'#frm-servicios',
    data:{
        servicio:{
            idServicio : 0,
            accion    : 'nuevo',
            nombre    : '',
            precio    : '',
            msg       : ''
        }
    },
    methods:{
        guardarServicios(){
            fetch(`private/Modulos/servicios/procesos.php?proceso=recibirDatos&servicio=${JSON.stringify(this.servicio)}`).then( resp=>resp.json() ).then(resp=>{
                this.servicio.msg = resp.msg;
            });
        },
        limpiarServicios(){
            this.servicio.idServicio=0;
            this.servicio.accion="nuevo";
            this.servicio.nombre="";
            this.servicio.precio="";
            this.servicio.msg="";
        }
    }
});