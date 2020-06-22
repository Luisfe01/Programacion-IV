var appbuscar_tipoproductos = new Vue({
    el: '#frm-buscar-tipoproductos',
    data:{
        mis_tipoproductos:[],
        valor:''
    },
    methods:{
        buscarTipoproductos(){
            fetch(`private/Modulos/tipoproductos/procesos.php?proceso=buscarTipoproducto&tipoproducto=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_tipoproductos = resp;
            });
        },
        modificarTipoproducto(tipoproducto){
            apptipoproductos.tipoproducto = tipoproducto;
            apptipoproductos.tipoproducto.accion = 'modificar';
        },
        eliminarTipoproducto(idTipoproducto){
            
            alertify.confirm("Mantenimiento Clientes","¿Está seguro de eliminar el registro?",
            ()=>{
                fetch(`private/Modulos/tipoproductos/procesos.php?proceso=eliminarTipoproducto&tipoproducto=${idTipoproducto}`).then( resp=>resp.json() ).then(resp=>{
                    this.buscarTipoproductos();
                });
                alertify.success('Registro Eliminado correctamente.');
            },
            ()=>{
                alertify.error('Eliminacion cancelada');
            });

        }
    },
    created(){
        this.buscarTipoproductos();
    }
});