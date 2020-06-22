    
/**
 * @file chat.js logica para el chat de comunicacion entre los usuarios.
 * @license MIT libre distribucion y modificacion para fine educativos.
 * @instance objeto de instancia de vue.js
 */

  var appchat = new Vue({
     /**
     * @property el element del DOM a enlazar.
     */
        el:'#frm-chat',
        data:{
            msg : '',
            msgs : []
        },
        methods:{
            enviarMensaje(){
                socket.emit('enviarMensaje', this.msg);
                this.msg = '';
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
        console.log(msg);
        $.notification("Enviando noficacion",msg, 'https://w7.pngwing.com/pngs/414/714/png-transparent-email-computer-icons-message-icon-design-bass-miscellaneous-angle-black.png');

        appchat.msgs.push(msg);
    });
    socket.on('chatHistory',msgs=>{
        appchat.msgs = [];
        msgs.forEach(item => {
            appchat.msgs.push(item.msg);
        });
    });