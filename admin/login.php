<?php
include("global.php");
$admin_login = new USER();
if($admin_login->admin_is_loggedin()!="")
{
	$admin_login->redirect('admin.php');
}
$title = "الدخول للإدارة";
$body = "admin";	
$tpl->ADlogin();
?>
