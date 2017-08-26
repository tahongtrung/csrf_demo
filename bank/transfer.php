<?php

include_once('../csrf/csrf_lib.php');

#session_start();

require('gettransfer.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/jquery-3.2.1.min.js"></script>
</head>
<body style="margin-top:100px;">
<div class="container">
<center><img src="ptit.png" height="100px;" alt="PTITLOGO" title="Trap@@"></center>
<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="panel">
				<div class="panel-heading">
				<h1>CSRF TRANSFER</h1>
				</div>
				
				<p style="float: left"><a href="clear.php">Logout</a></p>
				<p style="float: right"><a href="transfer.php">Refresh</a></p>
				<hr>
				<p style="font-style:italic;">
					Welcome <b style="text-transform: uppercase;"><?php echo isset($_SESSION['username'])?$_SESSION['username']:"null"; ?> - <?php echo isset($_SESSION['balance'])?$_SESSION['balance']:"null" ?> $<b>
				</p>
				<?php 
					if(!empty($noti)){
						echo 	"<div class='alert alert-success'>
									<span>".$noti."</span>
								 </div>";
					}else{
						if(!empty($err)){
							echo 	"<div class='alert alert-danger'>
										<span>".$err."</span>
									 </div>";
						}
					}
				?>
				<form action="" method="get">
					<label class="label label-success">Reciver Username</label><br/>
					
					<input type="text" name="username" class="form-control" style="border-radius:0px;"> 

					<span class="label label-success">Transfer Amount</span>
					<input type="text" name="money" class="form-control" style="border-radius:0px;">
					
					<br/>
					<input type="submit" name="transfer" value="Transfer" class="btn btn-success btn-sm">
					
					<?php $csrf->getTokenField(); ?>
					
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>