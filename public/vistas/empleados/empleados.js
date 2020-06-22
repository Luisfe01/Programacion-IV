Vue.component('v-select', VueSelect.VueSelect);

var appempleados = new Vue({
    el:'#frm-empleados',
    data:{
        empleado:{
            idEmpleado : 0,
            accion    : 'nuevo',
            tipoempleado   : {
                idTipoempleado : 0,
                tipo   : ''
            },
            
            fechanacimiento     : '',
            msg       : ''
        },
        tipoempleados : {}
    },
    methods:{
        guardarEmpleados(){
            fetch(`private/Modulos/empleados/procesos.php?proceso=recibirDatos&empleado=${JSON.stringify(this.empleado)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarEmpleados(){
            this.empleado.idEmpleado=0;
            this.empleado.accion="nuevo";
            this.empleado.msg="";
        }
    },
    created(){
        fetch(`private/Modulos/empleados/procesos.php?proceso=traer_tipoempleados&empleado=''`).then( resp=>resp.json() ).then(resp=>{
            this.tipoempleados = resp.tipoempleados;
        });
    }
});