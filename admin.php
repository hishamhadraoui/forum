<?php
include("global.php");
$title = "الادارة";
$body = "admin";
echo'
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=12.0, minimum-scale=.25, user-scalable=yes" name="viewport"/>
<link href="system/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="system/css/bootstrap888.css" rel="stylesheet" media="screen">
<link href="system/css/bootstrap-rtl.min.css" rel="stylesheet" media="screen">
<link href="system/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="system/js/jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="system/css/style.css" type="text/css"  />
<link rel="stylesheet" href="system/css/cairo.css">
<link rel="stylesheet" href="system/css/font-awesome.min.css">
<title>'.title_op.'-'.$title.'</title>
</head>
<body>';

if(!is_admin($me)){  
$title = "خطأ";
$body = "admin";
?><div class="alert alert-danger"><center>
	هذه الصفحة غير موجودة أو ربما <br>  &nbsp; ليس لديك صلاحيات لدخول الصفحة <br><a href='home.php'>العودة للرئيسية</a> 
</div><?php
}else{
 ?>
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="admin.php">الإدارة</a>
    </div>
    <ul class="nav navbar-nav">
      <li <?php print "".($op == "option" ? "class='active'" : "")." ";?>><a href="admin.php?op=option">الخيارات</a></li>
      <li <?php print "".($op == "forums" ? "class='active'" : "")." ";?>><a href="admin.php?op=forums">المنتديات</a></li>
      <li <?php print "".($op == "users" ? "class='active'" : "")." ";?>><a href="admin.php?op=users">الأعضاء</a></li>
      <li <?php print "".($op == "#" ? "class='active'" : "")." ";?>><a href="#">.....</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-left">          
		  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <?php	echo " <img src='".avatar($useravatar,$usergender)."' width='28px' height='28px'>"; ?>&nbsp; <?php echo $username; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
			   
				  <li><a target="_blank" href="home.php"><span class="glyphicon glyphicon-home"></span>&nbsp;الموقع</a></li>
			  
                
                <li><a href="logout.php?admin_logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;الخروج</a></li>
              </ul>
            </li>
    </ul>
 </div>
</nav><?php

$error = array();
					if(empty($_GET['op'])){
											$op = 'admin';
										  }
									  else{
											$op = $_GET['op'];
										  }	
	if(file_exists('admin/'. $op .'.php')){
											include('admin/'. $op .'.php');
										  }
									 else {
											echo 'admin/'. $op .'.php';
											include('admin/404.php');
										  }
			


}			



include('system/footer.php'); 

?>
