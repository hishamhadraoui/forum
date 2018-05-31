<?php
include("global.php");
if($usergroup == 0){
	$user->redirect('index.php');
}else{
	
	
	require_once("inc____/class.session.php");
	$session = new AppSessionHandler();
	$logout = trim($_REQUEST['logout']);
	$admin_logout = trim($_REQUEST['admin_logout']);
	
	
	if($logout == true){
	
	session_start();
	
	unset($_SESSION['user_session']);
	$session->kill();
		header("Location: index.php");
	//if(session_destroy()){//}
	
		
		
	}
	
	if($admin_logout == true){
		
	session_start();
	unset($_SESSION['admin_name_session'] );
	
	if(session_destroy())
	{
		header("Location: home.php");
	}		
		
		
		
		
	}
	
	
	
	
}
	
?>