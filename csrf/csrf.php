<?php

session_start();

class csrf{

	private $token = "";

	function __construct(){
		$this->generateToken();
	}

	function getToken(){
        return $this->token;
    }

    function checkToken($post_token, $session_token) {
    	#var_dump($_SERVER);
    	#check referrer in header http request
    	$referrer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"";
    	if( stripos($referrer,$_SERVER[ 'SERVER_NAME' ] ) === false ) {
			die('CSRF HTTP REFERRER detected!');
		}
		#check token
		if( $post_token!==$session_token) {
			//echo $post_token.'<br>'.$session_token;
			die( 'CSRF token is incorrect or missing..' );
			// header("Location:CSRF.html");
			// exit;
		}
		
		$this->generateToken();
		return true;
	}

	private function generateToken() {
		if( isset( $_SESSION[ 'token' ] ) ) {
			$_SESSION['old_token']=$_SESSION['token'];
			$this->destroyToken();
		}
		$_SESSION[ 'token' ] = md5(mt_rand().$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].'@#$%^+&*(-)'); //bin2hex 
	}

	private function destroyToken() {
		unset( $_SESSION[ 'token' ] );
	}

	function getTokenField() {
		echo "<input type='hidden' name='token' value='{$_SESSION['token']}' />";
	}

}
?>