<?php 

//var_dump($_GET);
require('connectDB.php');

if(empty($_SESSION['username']) ){
	header('location:login.php');
}

$query = "select * from transfer";
$result=mysqli_query($con,$query);

#update balance
if(!isset($_GET['transfer'])){
	while($row = mysqli_fetch_assoc($result)){
		if($_SESSION['username']===$row['username']){
			$_SESSION['balance']=$row['balance'];
		}
	}
}
$token = isset($_GET['token'])? $_GET['token'] : "";
#authentication validate info 
if(isset($_GET['transfer'])  && $csrf->checkToken(@$_GET['token'], $_SESSION['old_token'])){

	$receiver=$_GET['username'];
	if($receiver===$_SESSION['username']){
		$err='you can not send yourself!';
		return;
	}

	$money=$_GET['money'];
	if($receiver == "" || $money==""){
		$err='invalid info';
	}
	$i=0;
	while($row = mysqli_fetch_assoc($result)){
		$i++;
	    if($row['username'] === $_SESSION['username']){
	    	if($money>$row['balance']){
	    		$err='info invalid!';
				return;
	    	}else{
	    		#update money
	    		$rest=$row['balance']-$money;
	    		$_SESSION['balance']=$rest;
	    		$id=$_SESSION['username'];
	    		$sql = "UPDATE transfer SET balance = '$rest' WHERE username = '$id'";
	    		mysqli_query($con,$sql);
	    	}
	    }
	    if($row['username'] === $receiver){
	    	#update money
	    	$new=$row['balance']+$money;
	    	$sql="UPDATE transfer SET balance = '$new' WHERE username = '$receiver'";
	    	mysqli_query($con,$sql);
	    }
	}
	if($i==0){
		$err="not found";
	}else{
		$noti="Chuyển tiền thành công";
	}
}


?>