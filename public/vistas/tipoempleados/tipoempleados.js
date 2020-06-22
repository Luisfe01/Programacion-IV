var apptipoempleados = new Vue({
    el:'#frm-tipoempleados',
    data:{
        tipoempleado:{
            idTipoempleado : 0,
            accion    : 'nuevo',
            nombre    : '',
            precio    : '',
            msg       : ''
        }
    },
    methods:{
        guardarTipoempleados(){
            fetch(`private/Modulos/tipoempleados/procesos.php?proceso=recibirDatos&tipoempleado=${JSON.stringify(this.tipoempleado)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarTipoempleados(){
            this.tipoempleado.idTipoempleado=0;
            this.tipoempleado.accion="nuevo";
            this.tipoempleado.nombre="";
            this.tipoempleado.precio="";
            this.tipoempleado.msg="";
        }
    }
});