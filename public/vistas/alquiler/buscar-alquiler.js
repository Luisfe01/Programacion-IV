var appbuscar_alquiler = new Vue({
    el: '#frm-buscar-alquiler',
    data:{
        mis_alquiler:[],
        valor:''
    },
    methods:{
        buscarAlquileres(){
            fetch(`private/Modulos/alquiler/procesos.php?proceso=buscarAlquiler&alquileres=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mis_alquiler = resp;
            });
        },
        modificarAlquiler(alquileres){
            appalquiler.alquileres = alquileres;
            appalquiler.alquileres.accion = 'modificar';
        },
        eliminarAlquiler(idAlquiler){
            if (confirm('¿Está seguro de elimiar el registro?')) {
                fetch(`private/Modulos/alquiler/procesos.php?proceso=eliminarAlquiler&alquileres=${idAlquiler}`).then( resp=>resp.json() ).then(resp=>{
                    this.buscarAlquileres();
            });
            }
        }
    },
    created(){
        this.buscarAlquileres();
    }
});