

Vue.component('v-select', VueSelect.VueSelect);

var appproductos = new Vue({
    el:'#frm-productos',
    data:{
        producto:{
            idProducto : 0,
            accion    : 'nuevo',
            tipoproducto   : {
                idTipoproducto : 0,
                tipo   : ''
            },
            codigo : '',
            imagen    : '',
            nombre : '',
            descripcion: '',
            categoria : '',
            msg       : ''
        },
        tipoproductos : {}
    },
    methods:{
        guardarProductos(){
            fetch(`private/Modulos/productos/procesos.php?proceso=recibirDatos&producto=${JSON.stringify(this.producto)}`).then( resp=>resp.json() ).then(resp=>{
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarProductos(){
            this.producto.idProducto=0;
            this.producto.accion="nuevo";
            this.producto.msg="";
        }
    },
    created(){
        fetch(`private/Modulos/productos/procesos.php?proceso=traer_tipoproductos&producto=''`).then( resp=>resp.json() ).then(resp=>{
            this.tipoproductos = resp.tipoproductos;
        });
    }
});




$('#text1').on('change', function () {

    document.getElementById("eventTarg").value = "";
    
    var cadena1 = document.getElementById("text1").value;
    var cadena2 = cadena1.slice(12);

    document.getElementById("eventTarg").value = cadena2;
  

    setTimeout(function() {
        console.log ("Plugin");
        $("#eventTarg").sendkeys (" ") ;
        }, 1000);
    
      


});

$("#eventTarg").bind ("keydown keypress keyup change",  function (zEvent) {
    console.log ("Input event:", zEvent.type, zEvent);
    $("#eventLog").append ('<span>' + zEvent.type + ': ' + zEvent.which + ', </span>');
} );


