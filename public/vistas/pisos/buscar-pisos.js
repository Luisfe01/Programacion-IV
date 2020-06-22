var appbuscar_pisos = new Vue({
    el: '#frm-buscar-pisos',
    data:{
        mis_pisos:[],
        valor:''
    },
    methods:{
        buscarPisos(){
            fetch(`private/Modulos/pisos/procesos.php?proceso=buscarPiso&piso=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_pisos = resp;
            });
        },
        modificarPiso(piso){
            apppisos.piso = piso;
            apppisos.piso.accion = 'modificar';
        },
        eliminarPiso(idPiso){

            alertify.confirm("Mantenimiento Clientes","¿Está seguro de eliminar el registro?",
            ()=>{
                fetch(`private/Modulos/pisos/procesos.php?proceso=eliminarPiso&piso=${idPiso}`).then( resp=>resp.json() ).then(resp=>{
                    this.buscarPisos();
                });
                alertify.success('Registro Eliminado correctamente.');
            },
            ()=>{
                alertify.error('Eliminacion cancelada');
            });

        }
    },
    created(){
        this.buscarPisos();
    }
});