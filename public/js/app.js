var zindex = 1;
var socket = io.connect("http://localhost:3001",{'forceNew':true});

function init(){

    $("[class*='mirar']").click(function(e){
        let modulo = $(this).data("modulo"),
            form   = $(this).data("form");

        $(`#vistas-${form}`).load(`public/vistas/${modulo}/${form}.php`, function(){
            $(`#btn-close-${form}`).click(()=>{
                $(`#vistas-${form}`).html("");
            });
            zindex_ventana(form);
            init();
        });
    });


    $("[class*='enseñar']").click(function(e){
        let modulo = $(this).data("modulo"),
            form   = $(this).data("form");

        $(`#vistas-${form}`).load(`public/vistas/${modulo}/${form}.php`, function(){
            $(`#btn-close-${form}`).click(()=>{
                $(`#vistas-${form}`).html("");
            });
            zindex_ventana(form);
            init();
        }).draggable();
    });

    $("[class*='mostrar']").click(function(e){
        let modulo = $(this).data("modulo"),
            form   = $(this).data("form");

        $(`#vistas-${form}`).load(`public/vistas/${modulo}/${form}.html`, function(){
            $(`#btn-close-${form}`).click(()=>{
                $(`#vistas-${form}`).html("");
            });
            zindex_ventana(form);
            init();
        }).draggable();
    });
}
function zindex_ventana(app){
    $(`#frm-${app} .card-header`).click(()=>{
        $(`#vistas-${app}`).css("z-index", zindex++);
    });
}
init();
