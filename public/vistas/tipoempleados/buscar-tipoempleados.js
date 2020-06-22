var appbuscar_tipoempleados = new Vue({
    el: '#frm-buscar-tipoempleados',
    data:{
        mis_tipoempleados:[],
        valor:''
    },
    methods:{
        buscarTipoempleados(){
            fetch(`private/Modulos/tipoempleados/procesos.php?proceso=buscarTipoempleado&tipoempleado=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_tipoempleados = resp;
            });
        },
        modificarTipoempleado(tipoempleado){
            apptipoempleados.tipoempleado = tipoempleado;
            apptipoempleados.tipoempleado.accion = 'modificar';
        },
        eliminarTipoempleado(idTipoempleado){
            
            alertify.confirm("Mantenimiento Clientes","¿Está seguro de eliminar el registro?",
            ()=>{
                fetch(`private/Modulos/tipoempleados/procesos.php?proceso=eliminarTipoempleado&tipoempleado=${idTipoempleado}`).then( resp=>resp.json() ).then(resp=>{
                    this.buscarTipoempleados();
                });
                alertify.success('Registro Eliminado correctamente.');
            },
            ()=>{
                alertify.error('Eliminacion cancelada');
            });

        }
    },
    created(){
        this.buscarTipoempleados();
    }
});