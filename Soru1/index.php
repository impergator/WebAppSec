<?php

$db 	=	new SQLite3('s3cret.db');
$db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,username varchar(255),password varchar(255));');
$check	=	$db->query('SELECT * from users;');
if(!$check->fetchArray()){
	$db->exec("INSERT INTO users (username,password) values ('root', '".md5('240610708')."' );");
}
if(isset($_POST['username']) and $_POST['username']!=''){
	$stmt	=	$db->prepare("SELECT * from users where username=?");
	$stmt->bindValue( 1, $_POST['username']);
	$result =	$stmt->execute();
  	$dat 	=	$result->fetchArray();
 
	if($dat['username']!="root"){
		echo "<h1><font color=red>Wrong Username</font></h1>";
	}elseif (md5($_POST['password'])==$dat['password']) { // Db den kontrole gerek yok
		echo "FLAG: impergator1 😄"; 
		die("");
	}else{
		echo "<h1><font color=red>Wrong Password</font></h1>";
	}
}
if(isset($_POST['username']) and $_POST['username']==''){
	die("<center><img src=icantread.gif><br><font color=red>Where is the username I canT read it !!</font>");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Center</title>
</head>
<body>
<!-- 
Hello 😉 

//TODO
//
//Make a todo list
//Sender:root@localhost

-->
<center><img src="keepout.jpg"><br><br>
	<form action="?" method="POST">
		<table>
			<td><tr>Username:</tr><tr><input type="text" name="username"></tr></td>
			<br><br>
			<td><tr>Password:</tr><tr><input type="text" name="password"></tr></td>
			<br><br>
			<input type="submit" value="Login">
		</table>
	</form>
</center>
</body>
</html>