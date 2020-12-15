



$(function () {
    //connexion !
    let socket = io.connect('http://localhost:3001');

    //buttons and inputs
    let message = $("#message");
    let send_message = $("#send_message");
    let chatroom = $("#chatroom");
    let feedback = $("#feedback");
    let usersList = $("#users-list");
    let nickName = $("#nickname-input");



    //Emit message
    // si le btn envoyé est cliqué
    send_message.click(function(){
        socket.emit('new_message', {message : message.val()})
    });
    // ou si la touche entrée est tappée.
    message.keypress( e => {
        let keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13'){
            socket.emit('new_message', {message : message.val()})
        }
    })

    //affiche anciens messages de la conversation
    

    //Listen le new_message
    socket.on("new_message", (data) => {
        feedback.html('');
        message.val('');
        //append le nouveau message envoyé
        chatroom.append(`
                        </div>
                        <div class="box-message">
                        <img src="../images/default-profile.png" class="circle-profile" alt="image-profil">
                        <p  class="chat-text user-nickname">${data.username}</p>
                        <br/>
                        <p> ${data.message}
                        </p>
                        <br/>
                     </div>
                     <p>${data.created_on}</p>

                        `)
        ChatEnBas()
    });

// affichage ancien message



    //Emit un username
    nickName.keypress( e => {
        let keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13'){
            socket.emit('change_username', {nickName : nickName.val()});
            socket.on('get users', data => {
                let html = '';
                for(let i=0;i<data.length;i++){
                    html += `<li class="list-item" style="color: ${data[i].color}">${data[i].username}</li>`;
                }
                usersList.html(html)
            })
        }
    });

    //Emit typing quelque chose
    message.on("keypress", e => {
        let keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode != '13'){
            socket.emit('typing')
        }
    });

    //On listen si qqn tape quelque chose et le dit avec son username;
    socket.on('typing', (data) => {
        feedback.html("<p><i>" + data.username + " is typing a message..." + "</i></p>")
    });
});

// STARTED FROM THE BOTTOM AND NOW WE'RE HERE. blague à part ... ici scroll s'il y a beaucoup de msg.
const ChatEnBas = () => {
    const chatroom = document.getElementById('chatroom');
    chatroom.scrollTop = chatroom.scrollHeight - chatroom.clientHeight;
}

