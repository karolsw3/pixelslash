var express = require("express");
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var mysql = require("mysql");

let databaseConnection = {
	"host": "",
	"user": "",
	"password": "",
	"database": ""
};

var connection = mysql.createConnection(databaseConnection);

connection.connect();



var users = [];

io.use((socket, next) => {

	

	if(!socket.handshake.query.hasOwnProperty("token")) {
		return;
		
	}

	let user = users.filter((client) => {
		return client.handshake.query.token == socket.handshake.query.token;
	});


	
	if(user == []) {
		return;
	}
	
	let query = "select user from users where token=?";
	connection.query(query, socket.handshake.query.token, (error, results, fields) => {
		if(error) {
			throw error;
		}
	
		if(results[0] == null) {
			return;
			
		}
		socket.handshake.user = results[0].user;
	
		next();
	});
	
});

io.on('connection', (socket) => {
;
	users.push(socket);

	socket.on("message", (message) => {
		if(!message.hasOwnProperty("message") || !message.hasOwnProperty("reciever")){

			socket.emit("error-message", "invalid");
		}
		else{

			
			let query = "insert into messages (author, reciever, content) values (?, ?, ?)";
			connection.query(query, [socket.handshake.user, message.reciever, message.message], (error) => {
				if(error) {
					throw error;
				}

				sendMessage(message, socket);
	
			
			});
		}
	});

	socket.on("disconnect", () => {
		users = users.filter(user => user.handshake.user !== socket.handshake.user);

	});


});

sendMessage = (message, author) => {
	if(message.reciever == "all") {
		io.emit("message", { message: message.message, author: author.handshake.user });
	}
	else {
		let reciever = users.filter((user) => {
			return user.handshake.user == message.reciever;
		});

		author.emit("message", { message: message.message, author: author.handshake.user });

		if(reciever[0] != null) {
			reciever[0].emit("message", { message: message.message, author: author.handshake.user });
		}
	}

}



http.listen(8080, () => {
	console.log('listening on *:8080');
});
