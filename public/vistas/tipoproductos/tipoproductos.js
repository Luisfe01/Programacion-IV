var apptipoproductos = new Vue({
    el:'#frm-tipoproductos',
    data:{
        tipoproducto:{
            idTipoproducto : 0,
            accion    : 'nuevo',
            nombre    : '',
            precio    : '',
            msg       : ''
        }
    },
    methods:{
        guardarTipoproductos(){
            fetch(`private/Modulos/tipoproductos/procesos.php?proceso=recibirDatos&tipoproducto=${JSON.stringify(this.tipoproducto)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarTipoproductos(){
            this.tipoproducto.idTipoproducto=0;
            this.tipoproducto.accion="nuevo";
            this.tipoproducto.nombre="";
            this.tipoproducto.precio="";
            this.tipoproducto.msg="";
        }
    }
});