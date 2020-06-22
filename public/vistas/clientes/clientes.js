var appclientes = new Vue({
    el:'#frm-clientes',
    data:{
        cliente:{
            idCliente : 0,
            accion    : 'nuevo',
            nombre    : '',
            apellido    : '',
            direccion : '',
            telefono  : '',
            dui  : '',
            msg       : ''
        }
    },
    methods:{
        guardarClientes(){
            fetch(`private/Modulos/clientes/procesos.php?proceso=recibirDatos&cliente=${JSON.stringify(this.cliente)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarClientes(){
            this.cliente.idCliente=0;
            this.cliente.accion="nuevo";
            this.cliente.nombre="";
            this.cliente.apellido="";
            this.cliente.direccion="";
            this.cliente.telefono="";
            this.cliente.dui="";
            this.cliente.msg="";
        }
    }
});