Vue.component('v-select', VueSelect.VueSelect);

var appalquiler = new Vue({
    el:'#frm-alquiler',
    data:{
        alquileres:{
            idAlquiler : 0,
            accion    : 'nuevo',
            pelicula   : {
                idPelicula : 0,
                titulo   : ''
            },
            cliente    : {
                idCliente : 0,
                nombre   : ''
            },
            fechaPrestamo     : '',
            fechaDevolucion     : '',
            valor : '',
            msg       : ''
        },
        peliculas : {},
        clientes  : {}
    },
    methods:{
        guardarAlquileres(){
            fetch(`private/Modulos/alquiler/procesos.php?proceso=recibirDatos&alquileres=${JSON.stringify(this.alquileres)}`).then( resp=>resp.json() ).then(resp=>{
                this.alquileres.msg = resp.msg;
            });
        },
        limpiarAlquileres(){
            this.alquileres.idAlquiler=0;
            this.alquileres.accion="nuevo";
            this.alquileres.cliente.label="";
            this.alquileres.pelicula.label="";
            this.alquileres.fechaPrestamo="";
            this.alquileres.fechaDevolucion="";
            this.alquileres.valor="";
            this.alquileres.msg="";
        }
    },
    created(){
        fetch(`private/Modulos/alquiler/procesos.php?proceso=traer_peliculas_clientes&alquileres=''`).then( resp=>resp.json() ).then(resp=>{
            this.peliculas = resp.peliculas;
            this.clientes = resp.clientes;
        });
    }
});