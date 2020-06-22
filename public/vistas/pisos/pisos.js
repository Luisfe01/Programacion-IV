var apppisos = new Vue({
    el:'#frm-pisos',
    data:{
        piso:{
            idPiso : 0,
            accion    : 'nuevo',
            numpiso    : '',
            nombre    : '',
            msg       : ''
        }
    },
    methods:{
        guardarPisos(){
            fetch(`private/Modulos/pisos/procesos.php?proceso=recibirDatos&piso=${JSON.stringify(this.piso)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarPisos(){
            this.piso.idPiso=0;
            this.piso.accion="nuevo";
            this.piso.numpiso="";
            this.piso.nombre="";
            this.piso.msg="";
        }
    }
});