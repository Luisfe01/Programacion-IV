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
            if (confirm('¿Está seguro de elimiar el registro?')) {
                fetch(`private/Modulos/pisos/procesos.php?proceso=eliminarPiso&piso=${idPiso}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarPisos();
            });          
            }
        }
    },
    created(){
        this.buscarPisos();
    }
});