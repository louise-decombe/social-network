// NB : quand on dit listen ou "écoute" cela signifie que mon "server web socket" prend note de toutes les infos sur lesquelles 
// on lui dit de canaliser son attention.


//connexion à la BDD
var mysql = require('mysql');
var connection = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: '',
	database: 'social-network'
});
connection.connect(function(err) {
    if (err) throw err;
    connection.query("SELECT * FROM messages", function (err, result, fields) {
      if (err) throw err;
      console.log(result);
    });
  });


const express = require('express');
const app = express();
//identifiant unique universel -> au début j'ai fait un chat avec des utilisateurs anonyme DONC besoin de les identifier, je leur accord une genre 
// d'id le temps de la connexion.
const uuid = require('uuid');

//Disable x-powered-by header
app.disable('x-powered-by')

//middlewares : En architecture informatique, 
//un middleware (anglicisme) est un logiciel tiers qui crée un réseau
//d'échange d'informations entre différentes applications informatiques : ICI EXPRESS.JS
app.use(express.static('public'));

//routes -> j'ai besoin d'une route pour savoir où diriger les infos de connexion, j'ai besoin de la VUE.
app.get('/', (req,res)=>{
    res.sendFile(__dirname + '/client/chat.php');
});

//Listen le port 5000 : on aurait pu mettre autre chose comme port, il en faut un pour le socket. 
server = app.listen( process.env.PORT || 3000);

//socket.io instantiation -> ici j'appele le module websocket.io avec une const.
const io = require("socket.io")(server);

let users = [];
let connnections = [];

//écoute toutes les connexions
io.on('connection', (socket) => {
    console.log('New user connected');
    connnections.push(socket)
    socket.username = 'Anonymous';



  var getLastComments = function(){
    connection.query('' +
        'SELECT * FROM messages', function(err, rows){
        if(err){
            socket.emit('error', err.code);
        } else {
            var messages = [];
            rows.reverse();
            for(k in rows){
                var row = rows[k];
                var message = {
                    message: row.message,
                  
                };
                messages.push(message)
            }
            socket.emit('new_message', messages)
        }
    })
};
getLastComments()


    //listen on change_username
    socket.on('change_username', data => {
        let id = uuid.v4(); // crée un UUID pour l'utilisateur connecté.
        socket.id = id;
        socket.username = data.nickName;
        users.push({id, username: socket.username});
        updateUsernames();
    })

    //update Usernames dans le client
    const updateUsernames = () => {
        io.sockets.emit('get users',users)
    }

    //listen on le new_message
    socket.on('new_message', (data) => {
        //émet le new message
        io.sockets.emit('new_message', {message : data.message, username : socket.username});
        var sql = `INSERT INTO messages (message, messageTo, messageFrom, created_at) VALUES ('${data.message}', '1', '1', NOW())`;
        connection.query(sql, function (err, result) {
          if (err) throw err;
          console.log("1 record inserted");
        })
    })

    //listen on typing
    socket.on('typing', data => {
        socket.broadcast.emit('typing',{username: socket.username})
    })

    //Déconnexion
    socket.on('disconnect', data => {

        if(!socket.username)
            return;
        //Cherche un utilisateur et le supprime (avec ce fameux id matérialisé par le uuid)
        let user = undefined;
        for(let i= 0;i<users.length;i++){
            if(users[i].id === socket.id){
                user = users[i];
                break;
            }
        }
        users = users.filter( x => x !== user);
//Met à jour les utilisateurs
        updateUsernames();
        connnections.splice(connnections.indexOf(socket),1);
    })
})

