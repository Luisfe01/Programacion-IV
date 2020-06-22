var appbuscar_productos = new Vue({
    el: '#frm-buscar-productos',
    data:{
        mis_productos:[],
        valor:''
    },
    methods:{
        buscarProductos: function(){
            fetch(`private/Modulos/productos/procesos.php?proceso=buscarProducto&producto=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_productos = resp;
            });
        },
        modificarProducto:function(producto){
            appproductos.producto = producto;
            appproductos.producto.accion = 'modificar';
        },
        eliminarProducto:function(idProducto){

            alertify.confirm("Mantenimiento Clientes","¿Está seguro de eliminar el registro?",
            ()=>{
                fetch(`private/Modulos/productos/procesos.php?proceso=eliminarProducto&producto=${idProducto}`).then( resp=>resp.json() ).then(resp=>{
                    this.buscarProductos();
                });
                alertify.success('Registro Eliminado correctamente.');
            },
            ()=>{
                alertify.error('Eliminacion cancelada');
            });

        }
    },
    created:function(){
        this.buscarProductos();
    }
});