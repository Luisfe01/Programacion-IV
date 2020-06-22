var apptipohabitaciones = new Vue({
    el:'#frm-tipohabitaciones',
    data:{
        tipohabitacion:{
            idTipohabitacion : 0,
            accion    : 'nuevo',
            nombre    : '',
            precio    : '',
            msg       : ''
        }
    },
    methods:{
        guardarTipohabitaciones(){
            fetch(`private/Modulos/tipohabitaciones/procesos.php?proceso=recibirDatos&tipohabitacion=${JSON.stringify(this.tipohabitacion)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarTipohabitaciones(){
            this.tipohabitacion.idTipohabitacion=0;
            this.tipohabitacion.accion="nuevo";
            this.tipohabitacion.nombre="";
            this.tipohabitacion.precio="";
            this.tipohabitacion.msg="";
        }
    }
});