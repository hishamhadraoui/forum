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
	<title><?= '*forum*-التنصيب' ?></title>
</head>
<body>
<?php

	$op = trim($_GET['op'] ?? '');
	define("op", $op);
	
	$opi = trim($_GET['opi'] ?? '');
	define("opi", $opi);

@require_once('../inc____/class.database.php');
$dbc = new Database();
function update_option($op_name, $op_value) {
				global $dbc;
				try {
								$stmt = $dbc->runQuery("UPDATE ".prx."options SET option_value=:op_value WHERE option_name=:op_name");
								$stmt->bindparam(":op_value", $op_value);
								$stmt->bindparam(":op_name", $op_name);
								$stmt->execute();
								return $stmt;
				}
				catch (PDOException $e) {
								echo $e->getMessage();
				}
}

if (op == "dbconfig") {
				echo '<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">تنصيب النسخة فووريم</a></li>
<li><a href="#">بداية التنصيب</a></li>
<li ' . ($op == "dbconfig" ? "class='active'" : "") . ' ><a href="#">معلومات القاعدة</a></li>
</ul>
</div>
</nav>';
				echo '
<div class="container">
<center>
<div class="col-lg-6">

<div class="row"> 
  
  <div class="bg-success col-lg-6">الهوست</div>
  <div class="bg-info col-lg-6">';
				echo $dbc->______getvar('host');
				echo '</div>
  <div class="bg-success col-lg-6">اسم القاعدة</div>
  <div class="bg-info col-lg-6">';
				echo $dbc->______getvar('db_name');
				echo '</div>
  <div class="bg-success col-lg-6">اليوزر</div>
  <div class="bg-info col-lg-6">';
				echo $dbc->______getvar('username');
				echo '</div>
  <div class="bg-success col-lg-6">باس اليوزر</div>
  <div class="bg-info col-lg-6">';
				echo $dbc->______getvar('password');
				echo '</div>  
  
  
 </div>
 </div>
 
 
 <p>إذا كانت هذه هي المعلومات التي أدخلتها يمكنك البدأ بتنصيب الجداول</p>
 <p><a class="btn btn-primary btn-lg" href="install.php?op=addtables" role="button">تنصيب الجداول</a></p>
 
 
 </div>
';
} //op == "dbconfig"
				elseif (op == "addtables") {
				echo '<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">تنصيب النسخة فووريم</a></li>
<li><a href="#">بداية التنصيب</a></li>
<li><a href="#">معلومات القاعدة</a></li>
<li ' . ($op == "addtables" ? "class='active'" : "") . ' ><a href="#">تنصيب الجداول</a></li>
</ul>
</div>
</nav>';
				echo '<center><div class="col-sm-12 col-lg-12"><div class="row">
<div class="alert alert-info col-sm-6 col-lg-6"><center>';
				try {
								include('Db.php');
								$dbc->exec($forums);
								echo  "<div class='alert alert-success' role='alert'>الجدول forums تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($forums1);
								echo  "<div class='alert alert-success' role='alert'>الجدول forums1 تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($friends);
								echo  "<div class='alert alert-success' role='alert'>الجدول friends تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($messages);
								echo  "<div class='alert alert-success' role='alert'>الجدول messages تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($moderators);
								echo  "<div class='alert alert-success' role='alert'>الجدول moderators تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($msg);
								echo  "<div class='alert alert-success' role='alert'>الجدول msg تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($notifications);
								echo  "<div class='alert alert-success' role='alert'>الجدول notifications تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($options);
								echo  "<div class='alert alert-success' role='alert'>الجدول options تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($options1);
								echo  "<div class='alert alert-success' role='alert'>الجدول options1 تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($permissions);
								echo  "<div class='alert alert-success' role='alert'>الجدول permissions تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($replys);
								echo  "<div class='alert alert-success' role='alert'>الجدول replys تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($replys_likes);
								echo  "<div class='alert alert-success' role='alert'>الجدول replys_likes تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($replys_op);
								echo  "<div class='alert alert-success' role='alert'>الجدول replys_op تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($replys_op1);
								echo  "<div class='alert alert-success' role='alert'>الجدول replys_op1 تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($topics);
								echo  "<div class='alert alert-success' role='alert'>الجدول topics تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($topics_likes);
								echo  "<div class='alert alert-success' role='alert'>الجدول topics_likes تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($topics_op);
								echo  "<div class='alert alert-success' role='alert'>الجدول topics_op تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($topics_op1);
								echo  "<div class='alert alert-success' role='alert'>الجدول topics_op1 تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($ugroups);
								echo  "<div class='alert alert-success' role='alert'>الجدول ugroups تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($ugroups1);
								echo  "<div class='alert alert-success' role='alert'>الجدول ugroups1 تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($users);
								echo  "<div class='alert alert-success' role='alert'>الجدول users تم تنصيبه بنجاح تام!</div>";
								$dbc->exec($xreplys);
								echo  "<div class='alert alert-success' role='alert'>الجدول xreplys تم تنصيبه بنجاح تام!</div>";
				}
				catch (PDOException $e) {
								echo $e->getMessage();
				}
				echo '</div>
<div class="alert alert-success col-sm-6 col-lg-6">';
				echo '
 <p>تم تنصيب جميع الجداول وإذخال بعض المعلومات الأولية فيها باق عملية تسجيل عضوية المدير</p>
 <p><a class="btn btn-primary btn-lg" href="install.php?op=adminregister" role="button">تسجيل المدير الأول</a></p>
 ';
				echo '</div></div></div></center><br><br><br>';
} //op == "addtables"
				elseif (op == "adminregister") {
				echo '<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">تنصيب النسخة فووريم</a></li>
<li><a href="#">بداية التنصيب</a></li>
<li><a href="#">معلومات القاعدة</a></li>
<li><a href="#">تنصيب الجداول</a></li>
<li ' . ($op == "adminregister" ? "class='active'" : "") . ' ><a href="#">تسجيل المدير الأول</a></li>
</ul>
</div>
</nav>';
				echo '<center><tr><table width="92%"><tr>
<td class="alert alert-success" width="50%"><center>';
				if (isset($_POST['btn-signup'])) {
								$uname   = strip_tags($_POST['txt_uname']);
								$umail   = strip_tags($_POST['txt_umail']);
								$upass   = strip_tags($_POST['txt_upass']);
								$uage    = strip_tags($_POST['txt_uage']);
								$ugender = strip_tags($_POST['txt_ugender']);
								$ugroup  = 7;
								$isadmin = 1;
								if ($uname == "") {
												$error[] = error('no_name');
								} //$uname == ""
								else if ($umail == "") {
												$error[] = error('no_email');
								} //$umail == ""
								else if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
												$error[] = 'الرجاء ادخال اميل صالح !';
								} //!filter_var($umail, FILTER_VALIDATE_EMAIL)
								else if ($upass == "") {
												$error[] = "لم تكتب كلمة المرور !";
								} //$upass == ""
								else if (strlen($upass) < 6) {
												$error[] = "كلمة المرور يجب ان تكون أكثر من 6 أحرف";
								} //strlen($upass) < 6
								else {
												try {
																$stmt = $dbc->runQuery("SELECT user_name, user_email FROM ".prx."users WHERE user_name=:uname OR user_email=:umail");
																$stmt->execute(array(
																				':uname' => $uname,
																				':umail' => $umail
																));
																$row = $stmt->fetch(PDO::FETCH_ASSOC);
																if ($row['user_name'] == $uname) {
																				$error[] = "للأسف الاسم مسجل من قبل !";
																} //$row['user_name'] == $uname
																else if ($row['user_email'] == $umail) {
																				$error[] = "الاميل مسجل من قبل !";
																} //$row['user_email'] == $umail
																else {
																				
																				try {
																								$new_password = password_hash($upass, PASSWORD_DEFAULT);
																								$stmt         = $dbc->runQuery("INSERT INTO ".prx."users(user_name,user_email,user_pass,user_age,user_gender,user_group, is_admin) 
																		   VALUES(:uname, :umail, :upass, :uage, :ugender, :ugroup, :isadmin)");
																								$stmt->bindparam(":uname", $uname);
																								$stmt->bindparam(":umail", $umail);
																								$stmt->bindparam(":upass", $new_password);
																								$stmt->bindparam(":uage", $uage);
																								$stmt->bindparam(":ugender", $ugender);
																								$stmt->bindparam(":ugroup", $ugroup);
																								$stmt->bindparam(":isadmin", $isadmin);
																								$stmt->execute();
																								//return $stmt;
																								header("Location: install.php?op=adminregister&opi=joined");
																				}
																				catch (PDOException $e) {
																								echo $e->getMessage();
																				}
																}
												}
												catch (PDOException $e) {
																echo $e->getMessage();
												}
								}
				} //isset($_POST['btn-signup'])
				
?>



<div class="container">
    	
        <form method="post"   class="form-signin">
            <h2 class="form-signin-heading">معلومات المدير الأول</h2><hr />
            <?php
				if (isset($error)) {
								foreach ($error as $error) {
?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php
												echo $error;
?>
                     </div>
                     <?php
								} //$error as $error
				} //isset($error)
				else if (opi == "joined") {
?>
             <div class="alert alert-info">
                <i class="glyphicon glyphicon-log-in"></i> &nbsp; تم تسجيل عضوية جديدة بنجاح 
				<br><strong><a href='install.php?op=optionsite'>الإنتقال للمرحلة التالية</a></strong><br>
              </div>
             <?php
				} //opi == "joined"
?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="اسم المستخدم" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="البريد الإلكتروني" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="كلمة المرور" />
            </div>
            
            
            			
            			
			<div class="form-group">
            	<input type="number" class="form-control" name="txt_uage" min="13" max="100" placeholder="العمر (من 13 الى 100) سنة" />
            </div>			
			<div class="form-group">
			<select id="selectbasic" name="txt_ugender" class="form">
			  <option value="1">ذكر</option>
			  <option value="2">أنثى</option>
			</select>
			</div>

			
            
            
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;تسجيل
                </button>
            </div>
            <br />
           </form>
       </div>
</div>

<?php
				echo '</td></tr></table></tr></center><br><br><br>';
				
				
} //op == "adminregister"
				elseif (op == "optionsite") {
				echo '<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">تنصيب النسخة فووريم</a></li>
<li><a href="#">بداية التنصيب</a></li>
<li><a href="#">معلومات القاعدة</a></li>
<li><a href="#">تنصيب الجداول</a></li>
<li><a href="#">تسجيل المدير الأول</a></li>
<li ' . ($op == "optionsite" ? "class='active'" : "") . ' ><a href="#">معلومات الموقع</a></li>
</ul>
</div>
</nav>';

@require_once('../inc____/__func.php');
				echo '<center><tr><table width="92%"><tr>
<td class="alert alert-success" width="50%"><center>';
				if (isset($_POST['btn-option'])) {
								$title       = strip_tags($_POST['txt_title_op']);
								$adress      = strip_tags($_POST['txt_adress_op']);
								$description = strip_tags($_POST['txt_description_op']);
								$logo        = strip_tags($_POST['txt_logo_op']);
								try {
												if (update_option(title_nm, $title) && update_option(adress_nm, $adress) && update_option(description_nm, $description) && update_option(logo_nm, $logo)) {
?>
							 <div class="alert alert-info">
						&nbsp; تم ادخال المعلومات بنجاح 
						<br><strong><a href='install.php?op=theend'>الإنتقال للمرحلة الأخيرة</a></strong><br>
						
							 </div>
							 <?php
												} //update_option(title_nm, $title) && update_option(adress_nm, $adress) && update_option(description_nm, $description) && update_option(logo_nm, $logo)
								}
								catch (PDOException $e) {
												echo $e->getMessage();
								}
				} //isset($_POST['btn-option'])
?>
<form method="post" class="form-home form-horizontal">
             <div class="form-group">
			<label for="exampleInputName2"  class="col-sm-3 list-group-item active">اسم الموقع</label>
            <div class="col-sm-9"><input type="text" class="form-control" name="txt_title_op" value="<?php echo title_op; ?>" placeholder="<?php
				echo title_op;
?>"  />
            </div>
			</div>
			<div class="form-group">
			<label for="exampleInputName2"  class="col-sm-3 list-group-item active">رابط الموقع</label>
            <div class="col-sm-9"><input type="text" class="form-control" name="txt_adress_op" value="<?php echo adress_op; ?>"  placeholder="<?php
				echo adress_op;
?>" />
            </div>
			</div>
            <div class="form-group">
            <label for="exampleInputName2"  class="col-sm-3 list-group-item active">وصف الموقع</label>
			<div class="col-sm-9"><input type="text" class="form-control" name="txt_description_op" value="<?php echo description_op; ?>"  placeholder="<?php
				echo description_op;
?>"   />
            </div>
			</div>
			
			<div class="form-group">
            <label for="exampleInputName2"  class="col-sm-3 list-group-item active">رابط لوغو الموقع</label>
			<div class="col-sm-9"><input type="text" class="form-control" name="txt_logo_op" value="<?php echo logo_op; ?>"  placeholder="<?php
				echo logo_op;
?>"  />
            </div>
			</div>			
		
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-option">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>
<?php
				echo '</td></tr></table></tr></center><br><br><br>';
} //op == "optionsite"
				elseif (op == "theend") {
				require_once('../inc____/class.session.php');
				$session->kill();
				
				echo '<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">تنصيب النسخة فووريم</a></li>
<li><a href="#">بداية التنصيب</a></li>
<li><a href="#">معلومات القاعدة</a></li>
<li><a href="#">تنصيب الجداول</a></li>
<li><a href="#">تسجيل المدير الأول</a></li>
<li><a href="#">معلومات الموقع</a></li>
<li ' . ($op == "theend" ? "class='active'" : "") . ' ><a href="#">المرحلة النهائية</a></li>
</ul>
</div>
</nav>';
				echo '<center><tr><table width="92%"><tr>
<td class="alert alert-success" width="50%"><center>';
				echo ' 
<div class="alert alert-info">
                &nbsp; ألف مبروك تم تنصيب النسخة بنجاح الآن يمكنك الدخول لموقعك
				<br><br><strong><a href="../index.php">الإنتقال لرئيسية الموقع</a></strong><br>
				<br><strong><font color="red">   لا تنسى حذف الملف install أو إعادة تسميته باسم مغاير.</font></strong><br>
				
</div>
';
@unlink("new.php");
				echo '</td></tr></table></tr></center><br><br><br>';
} //op == "theend"
?>