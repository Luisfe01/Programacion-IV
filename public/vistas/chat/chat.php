<?php 

session_start();


?>



<form class="form-inline" v-on:submit.prevent="enviarMensaje" v-on:reset="limpiarChat" id="frm-chat">
    <div class="card" style="max-width: 30rem;">
        <h3 class="card-header"><center>
            CHAT

            <button type="button" id="btn-close-chat" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
       </center>

        </h3>
        <div class="card-body">

            <div class="container">
            <section id="messenger">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">

            <div class="col" v-for="msg in msgs" id="messages">
              <p class="p-3 mb-2 bg-secondary text-white"><i class="nc-icon nc-circle-09"></i>Nombre:  {{ msg }}</p>
            </div>
                </div>
            <div class="col" id="InputMessages">
                    <input type="text" id="user" name="user" class="form-control" value="<?php echo $_SESSION["user"] ?>" disabled>
                    <input type="text" v-model="msg" placeholder="Escribe tu Mensaje" class="form-control">
                    <input type="submit" value="Enviar" class="btn btn-success">
         
            </div>
            </section>
        </div>
        </div>
    </div>
</form>
<script src="public/vistas/chat/chat.js"></script>