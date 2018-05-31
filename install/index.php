<!DOCTYPE html PUBLIC "-//W3C//Ddiv XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=12.0, minimum-scale=.25, user-scalable=yes" name="viewport"/>
	<link href="../system/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../system/css/bootstrap-rtl.min.css" rel="stylesheet" media="screen">
	<link href="../system/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="../system/js/jquery-1.11.3-jquery.min.js"></script>
	<script src="../system/js/jquery.min.js"></script>
	<link rel="stylesheet" href="../system/css/style.css" type="text/css"  />
	<link rel="stylesheet" href="../system/css/cairo.css">
	<link rel="stylesheet" href="../system/css/font-awesome.min.css">
	<title><?= '*forum*-التنصيب'?></title>
</head>
<body>

<?php
	$op = trim($_GET['op'] ?? '');
	define("op", $op);
	
	$opi = trim($_GET['opi'] ?? '');
	define("opi", $opi);

				echo '<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">تنصيب النسخة فووريم</a></li>
<li ' . ($op == "" ? "class='active'" : "") . ' ><a href="#">بداية التنصيب</a></li>
</ul>
</div>
</nav>';
if ($op == "") {

			echo '
<div class="container-fluid">
<div class=""><center>
  <h4>أهلا بك في صفحة تنصيب النسخة فووريم</h4>
  <p>قم بإنشاء قاعدة بيانات جديدة وأدخل المعلومات المطلوبة في الاسفل</p>
  
</div>
</div>
';

                    ?>
					<form method="post" action="index.php?op=0">
	                <center>
	                <table width="60%" border="1">
	                   <tr class="normal">
	                       <td colSpan="10"><div class="list-group-item active"><center><font color="#fff" size="5">معلومات قاعدة البيانات</font></div><br><br>
								<table align=center>
									<tr>
	                       <td>الهوست</td><td><input type="text" name="dbhost">
						   <i class="fa fa-question-circle" aria-hidden="true" onclick="alert('أكتب اسم الهوست\n\r eg: localhost');"></i>
						   </td>
									</tr>
									<tr>
	                       <td>مستخدم القاعدة</td><td><input type="text" name="dbuser">
						   <i class="fa fa-question-circle" aria-hidden="true" onclick="alert('مستخدم القاعدة\n\r eg: root');" ></i></td>
									</tr>
									<tr>
	                       <td>باس المستخدم</td><td><input type="password" name="dbpass">
						   <i class="fa fa-question-circle" aria-hidden="true" onclick="alert('اليوزر باس\n\r eg: pass');" ></i></td>
									</tr>
									<tr>
	                       <td>قاعدة البيانات</td><td><input type="text" name="dbname">
						   <i class="fa fa-question-circle" aria-hidden="true" onclick="alert('اسم قاعدة البيانات\n\r eg: df');" ></i></td>
									</tr>
									<tr>
	                       <td>بادئة القاعدة</td><td><input type="text" name="dbprefix" value="f__">
						   <i class="fa fa-question-circle" aria-hidden="true" onclick="alert('ضع بريفيكس القاعدة\n\r eg: f__');" ></i></td>
									</tr>
										
									<tr>
	                       <td align="center" colspan="2"><input type="submit" value="ادخال المعلومات"></td>
									</tr>
									
								</table>
						   <br><br>
	                       </td>
	                   </tr>
	                </table>
	                </center>
					</form><?


}

if ($op == "0") {



$dbhost = htmlspecialchars(trim($_POST[dbhost]));
$dbuser = htmlspecialchars(trim($_POST[dbuser]));
$dbpass = htmlspecialchars(trim($_POST[dbpass]));
$dbname = htmlspecialchars(trim($_POST[dbname]));
$Prefix = htmlspecialchars(trim($_POST[dbprefix]));

if($dbhost != "" && $dbuser != "" && $dbpass != "" && $dbname != "" && $Prefix != ""){
		$connection_file = '../inc____/class.database.php';
		$tmp_file = '../inc____/class.database.php.tmp';

		$reading = fopen($connection_file, 'r');
		$writing = fopen($tmp_file, 'w');
		$replaced = false;

		while (!feof($reading)) {
		  $line = fgets($reading);
		  if (stristr($line,'private $host =')) {
			$line = 'private $host = "'.$dbhost.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'private $username =')) {
			$line = 'private $username = "'.$dbuser.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'private $password =')) {
			$line = 'private $password = "'.$dbpass.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'private $db_name =')) {
			$line = 'private $db_name = "'.$dbname.'";'."\n";
			$replaced = true;
		  }
		  if (stristr($line,'$prx =')) {
			$line = '$prx = "'.$Prefix.'";'."\n";
			$replaced = true;
		  }
		  fputs($writing, $line);
		}
		fclose($reading); fclose($writing);
if ($replaced) 
		{
					  @file_put_contents($connection_file, file_get_contents($tmp_file)) or die ('
							<center>
							<table width="60%" border="1">
							   <tr class="normal">
								   <td class="list_center" colSpan="10"><font size="5"><br></font><br><br>
								   هناك خطأ ما..<br><br>
								   <a href="index.php">أنقر هنا للعودة</a><br><br>
								   </td>
							   </tr>
							</table>
							</center>');
		  unlink($tmp_file);
		}

}

				echo '
<div class="container-fluid">
<div class=""><center>  
<p>الانتقال للمرحة التالية</p>
  <p>التنصيب يكون مرة واحدة فقط، بعدها إذا أردت التعديل أو إضافة برمجيات للنسخة فيجب أن يكون لذيك خبرة في البرمجة</p>
  <p><a class="btn btn-primary btn-lg" href="install.php?op=dbconfig" role="button">تنصيب الجداول</a></p>
</div>
</div>
';
}












?>