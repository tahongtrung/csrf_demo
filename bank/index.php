<?php
header('location:login.php');
include('../csrf/csrf_lib.php');
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
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="panel">
				<div class="panel-heading">
				<h1>CSRF PENTEST</h1>
				</div>
				<p style="font-style:italic;">
					Ví dụ kiểm thử lỗ hỏng CSRF
				</p>
				<form action="getting.php" method="post">
					<input type="text" name="data" class="form-control" style="border-radius:0px;"> 
					<br>
					<input type="submit" name="" value="Submit" class="btn btn-primary btn-sm">
					<?php $csrf->getTokenField() ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>