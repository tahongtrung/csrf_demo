<?php 

session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){

	if( isset($_SESSION['token'])){

		if(!empty($_POST['token'])){
			if(hash_equals($_SESSION['token'],$_POST['token'])){
				#code
				unset($_SESSION['token']);
				$_SESSION['posted'] = true;
				$_SESSION['data']=$_POST['data'];
				
				//unset($_POST['token']);
				die('Form posted successfully');

			}else{
				unset($_SESSION['token']);
				die('Invalid CSRF token');
			}
		}else{
			die('CSRF token post not found');
		}
		
	}else{
		die('CSRF token session not found');
	}
}

?>