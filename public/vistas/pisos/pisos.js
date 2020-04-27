var apppisos = new Vue({
    el:'#frm-pisos',
    data:{
        piso:{
            idPiso : 0,
            accion    : 'nuevo',
            nombre    : '',
            precio    : '',
            msg       : ''
        }
    },
    methods:{
        guardarPisos(){
            fetch(`private/Modulos/pisos/procesos.php?proceso=recibirDatos&piso=${JSON.stringify(this.piso)}`).then( resp=>resp.json() ).then(resp=>{
                this.piso.msg = resp.msg;
            });
        },
        limpiarPisos(){
            this.piso.idPiso=0;
            this.piso.accion="nuevo";
            this.piso.nombre="";
            this.piso.precio="";
            this.piso.msg="";
        }
    }
});