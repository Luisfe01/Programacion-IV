var socket = io.connect("http://localhost:3001",{'forceNew':true}),
    appchat = new Vue({
        el:'#frm-chat',
        data:{
            user: '',
            msg : '',
            msgs : []
        },
        methods:{
            enviarMensaje(){
                socket.emit('enviarMensaje', this.user, this.msg);
                this.msg = '';
                document.getElementById("nombre").disabled = true;

            },
            limpiarChat(){
                this.msg = '';
            }
        },
        created(){
            socket.emit('chatHistory');
        }
    });
    socket.on('recibirMensaje',msg=>{
        usuario = document.getElementById("nombre").value;

        appchat.msgs.push(usuario + " : " + msg);
    });
    socket.on('chatHistory',msgs=>{
        appchat.msgs = [];
        msgs.forEach(item => {
            appchat.msgs.push(item.user + " : " + item.msg);
        });
    });
