<?php

session_start();
require('connectDB.php');

if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$query = "SELECT username, password, balance FROM transfer WHERE username='$username' AND password='$password'";

	$result = mysqli_query($con,$query) or die(mysqli_error());
 	$num_row = mysqli_num_rows($result);

	if( $num_row === 1){
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username']=$username;
		$_SESSION['balance'] = $row['balance'];
		header('location:transfer.php');
	}else{
		echo 'Sai thông tin đăng nhập';
	}
	mysqli_close($con);
}else{
	echo "Bạn chưa submit";
	//header('location:login.php');
}


?>