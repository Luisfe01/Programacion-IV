var appbuscar_empleados = new Vue({
    el: '#frm-buscar-empleados',
    data:{
        mis_empleados:[],
        valor:''
    },
    methods:{
        buscarEmpleados: function(){
            fetch(`private/Modulos/empleados/procesos.php?proceso=buscarEmpleado&empleado=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_empleados = resp;
            });
        },
        modificarEmpleado:function(empleado){
            appempleados.empleado = empleado;
            appempleados.empleado.accion = 'modificar';
        },
        eliminarEmpleado:function(idEmpleado){
            fetch(`private/Modulos/empleados/procesos.php?proceso=eliminarEmpleado&empleado=${idEmpleado}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarEmpleados();
            });
        }
    },
    created:function(){
        this.buscarEmpleados();
    }
});