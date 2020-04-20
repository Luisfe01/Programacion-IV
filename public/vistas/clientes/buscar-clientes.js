var appbuscar_clientes = new Vue({
    el: '#frm-buscar-clientes',
    data:{
        mis_clientes:[],
        valor:''
    },
    methods:{
        buscarClientes(){
            fetch(`private/Modulos/clientes/procesos.php?proceso=buscarCliente&cliente=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_clientes = resp;
            });
        },
        modificarCliente(cliente){
            appclientes.cliente = cliente;
            appclientes.cliente.accion = 'modificar';
        },
        eliminarCliente(idCliente){
            if (confirm('¿Está seguro de elimiar el registro?')) {
                fetch(`private/Modulos/clientes/procesos.php?proceso=eliminarCliente&cliente=${idCliente}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarClientes();
            });          
            }
        }
    },
    created(){
        this.buscarClientes();
    }
});