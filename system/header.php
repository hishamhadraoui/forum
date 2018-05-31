<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=12.0, minimum-scale=.25, user-scalable=yes" name="viewport"/>
<link href="system/css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php  //if($body != 'msg'){    ?>
<link href="system/css/bootstrap-rtl.min.css" rel="stylesheet" media="screen">
<?php  //}  ?>	
<link href="system/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="system/js/jquery-1.11.3-jquery.min.js"></script>
<script src="system/js/jquery.min.js"></script>

<link rel="stylesheet" href="system/css/style.css" type="text/css"  />

<!--<link rel="stylesheet" href="system/css/w3.css" type="text/css"  />
<link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">-->
<link rel="stylesheet" href="system/css/cairo.css">
<link rel="stylesheet" href="system/css/font-awesome.min.css">

<script type="text/javascript" >
$(document).ready(function()
{
$("#notificationLink").click(function()
{
$("#notificationContainer").fadeToggle(300);
$("#notification_count").fadeOut("slow");
return false;
});

//Document Click
$(document).click(function()
{
$("#notificationContainer").hide();
});
//Popup Click
$("#notificationContainer").click(function()
{
return false
});

});
</script>

<title><?php echo title_op ?>-<?php echo $title ?></title>
</head>

<body>

<?php 	// if(show_in("admin") == 1){    ?>
<?php 	 if($body != 'msg'){    ?>
<?php  	include('navbar.php');    ?>

<?php	include('sidebar.php');    ?>
     
<?php  }  ?>	