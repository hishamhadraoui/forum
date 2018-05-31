<?php
/*
include("autoload.php");
//session_start();
$user = new USER();
$topics = new USER();
$forum = new USER();
$u = trim($_REQUEST['u']);
*/






if($u == ""){

if($type == ""){




$title = "قائمة الاعضاء";
$body = "users";
//include ("header.php");

$stmt = $dbc->runQuery("select * from ".prx."users ORDER BY user_id desc");
$stmt->execute();
//$rowusers=$stmt->fetch(PDO::FETCH_ASSOC);


?>




<ul class="list-group">
<li class="list-group-item active">
<font color="#fff">&nbsp; قائمة الاعضاء</font>
</li>

                <div class="form-home">
				<div class="row">

<?php
while($user_row = $stmt->fetch(PDO::FETCH_ASSOC)){
// target="_blank"
$u_posts = $user_row['user_to'] + $user_row['user_re'];

?>

<div class="col-lg-4 sm-lg-4  form-signin"><div class="row">

<div class="col-lg-8 sm-lg-8">
<div class=""><a href="users.php?u=<?php echo $user_row['user_id'];?>"><?php echo $user_row['user_name'];?></a></div>
<div class="desc"><?php echo moderator($user_row['user_id']); ?></div>
<div class="desc"><?php echo $user_row['user_email']; ?></div>
<div class="desc">المشاركات <span class="badge"><?php echo $u_posts; ?></span></div>
<div class="desc">تاريخ التسجيل : <?php echo $user_row['joining_date']; ?></div>
</div>
<div class="col-lg-4 sm-lg-4">
<img alt="" src="<?php echo avatar($user_row['user_avatar'],$user_row['user_gender']); ?>" width="80" height="80">
</div>
</div>
<?php if($user_row['user_group'] < 7){  ?>
<div><a href="admin.php?op=users&type=edit&u=<?php echo $user_row['user_id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;تعديل العضوية</a></div>
<div><a href="admin.php?op=users&type=upgrad&u=<?php echo $user_row['user_id'];?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;التعيين في منصب</a></div>
<div><a href="admin.php?op=users&type=degrad&u=<?php echo $user_row['user_id'];?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;التنحية من منصب</a></div>
<?php } ?>


</div>
	<?php

	}
	?>         </div>
    </tbody></table></div></div><br />
<?php

	}else{
		
		
	
	
	$title = "خطأ";
						$body = "users";

						echo'
										<tr><center><table>
										<tr>
											<td class="alert alert-danger" smspan="4" width="600"><center>	<br>
													<br>يجب أن تختار عضوا لتطيق عليه العملية	<br>
													<a href="admin.php?op=users">العودة لقائمة الأعضاء</a>
												</td>
											</tr>
										</table></tr>

';
}


	}else{                // u != ""










$stmt = $dbc->runQuery("select * from ".prx."users WHERE user_id=:u");
$stmt->execute(array(':u'=>$u));

$numu = $stmt->rowCount();




if($numu == 0){
$title = "خطأ";
$body = "users";
//include ("header.php");
echo'
				<tr><center><table>
				<tr>
					<td class="alert alert-danger" smspan="4" width="600"><center>	<br>
						رقم العضوية خاطئ
							<br>	<br>
							<a href="home.php">العودة للرئيسية</a>
						</td>
					</tr>
				</table></tr>

';
}else{




$user_row=$stmt->fetch(PDO::FETCH_ASSOC);

$u_posts = $user_row['user_to'] + $user_row['user_re'];

$title = $user_row['user_name'];
$body = "users";
//include ("header.php");


?>

 </div>
	<div class="container">
		 <div class="row">
	<div class="col-lg-3 form-signin">

            <div class="card hovercard">
              <div class="cardheader" style="background: url(<?php echo " ".($user_row['user_bg'] != "" ? "".$user_row['user_bg']."" : "img/bg_x.png")." "; ?>);">

                </div>
                <div class="avatar">
                <img alt="" src="<?php echo avatar($user_row['user_avatar'],$user_row['user_gender']); ?>">
                </div>
                <div class="info">
                    <div class="title">
                        <a href="users.php?u=<?php echo $user_row['user_id'];?>"><?php echo $user_row['user_name'];?></a>
                    </div>
                    <div class="desc"><?php echo moderator($user_row['user_id']); ?></div>
                    <div class="desc"><?php echo $user_row['user_email']; ?></div>

                    <div class="desc">المشاركات <span class="badge"><?php echo $u_posts; ?></span></div>

                </div>


				<div class="info">
				<div class="desc">تاريخ التسجيل : <?php echo $user_row['joining_date']; ?></div>
				</div>
            </div>

	     </div>










<?php








$user_to_edit = $user_row['user_id'];

if($u == 1){
						$title = "خطأ";
						$body = "users";

						echo'
										<tr><center><table>
										<tr>
											<td class="alert alert-danger" smspan="4" width="600"><center>	<br>
												للأسف لايمكنك تعديل هذه العضوية لأنها محمية من طرف النظام
													<br>	<br>
													<a href="admin.php?op=users">العودة لقائمة الأعضاء</a>
												</td>
											</tr>
										</table></tr>

';

}else{



if($type == "edit"){

?>

	<div class="col-lg-9 form-home">
<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; تعديل عضوية <?php echo $user_row['user_name'];?></font></li>
<?php

		$title = "تعديل صفحتي";



	if(isset($_POST['btn-editprofile']))
{



	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
//	$nupass = strip_tags($_POST['txt_upass']);

//	$ugroup = strip_tags($_POST['txt_ugroup']);

	$uavatar = strip_tags($_POST['txt_avatar']);
	$ubg = strip_tags($_POST['txt_userbg']);
	$ufb = strip_tags($_POST['txt_mfb']);
	$utw = strip_tags($_POST['txt_mtw']);
	$ugp = strip_tags($_POST['txt_mgp']);
	$uyo = strip_tags($_POST['txt_myo']);
	$id = $user_to_edit;


	 if($uavatar == "") {
				$error[] = "فضلا ادخل رابط الصورة الشخصية";
			}
	else if($ubg == "") {
				$error[] = "انت لم تدخل رابط صورة غلافك";
			}
	else if($id != $user_to_edit) {
				$error[] = "لقد غيرت رقم العضوية فكيف تريد التغيير ؟";
			}
	else if($uname=="")	{
		$error[] = "لم تختر اسم المستخدم";
	}
	else if($umail=="")	{
		$error[] = "لم تكتب اميل !";
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'الرجاء ادخال اميل صالح !';
	}
/*	else if($nupass=="")	{

	$upass == $user_row['user_pass'];

	}else if($nupass!=""){

		$upass == password_hash($nupass, PASSWORD_DEFAULT);
	}
	else if(strlen($upass) < 6){
		$error[] = "كلمة المرور يجب ان تكون أكثر من 6 أحرف";
	}
*/
			else
			{
	try
		{
				//$upass,$ugroup,
				if($user->edituser($uname,$umail,$uavatar,$ubg,$ufb,$utw,$ugp,$uyo,$id)){


							?>

				<tr>
					<td class="alert alert-info" colspan="4" width="600"><center>
					  <div class="alert alert-info">
						تم التعديل بنجاح....
							<br>
							<a href="admin.php?op=users&type=edit&u=<?php echo $user_to_edit; ?>">العودة للبروفيل</a>
							<br>
							<a href="admin.php?op=users">العودة لقائمة الأعضاء</a>
						  </div></center></td>
					</tr>
				</table></tr>

		<?php




				}

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
}
}

			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}


?>

<form method="post" class="form-home">
<div style="width:100%;">
<br><br></span>

<div class="row form-home">

الاسم	   <input type="text" class="form-control" name="txt_uname"  value="<?php echo $user_row['user_name'];?>" />
البريد الالكتروني	   <input type="text" class="form-control" name="txt_umail"  value="<?php echo $user_row['user_email'];?>" />
<!--   كلمة المرور	   <input type="text" class="form-control" name="txt_upass"  />  -->

</div>
<br>
<div class="row form-home">
المجموعة	    &nbsp;  &nbsp;  <?php $ug = $user_row['user_group']; echo ul_group($ug);?>
<?php
	/*	echo'<select id="selectbasic" name="txt_ugroup" class="form">';
			$ug = $user_row['user_group'];
				$i=1;
					echo '<option value="'.$ug.'">'.ul_group($ug).'</option>';
			if($ug == 7){}elseif($ug <= 6){
				while($i <= 6){
						if($i == $ug){
							$i++;
						}
					echo '<option value="'.$i.'">'.ul_group($i).'</option>';
				$i++;
				}
			}
		echo '</select>';
		*/
 ?>
</div>
 <br>
<div class="row form-home">
<br>

صورة الغلاف	   <input type="text" class="form-control" name="txt_userbg"  value="<?php echo " ".($user_row['user_bg'] != "" ? "".$user_row['user_bg']."" : "img/bg_x.png")." "; ?>" />
الصورة الرمزية		<input type="text" class="form-control" name="txt_avatar"  value="<?php echo avatar($user_row['user_avatar'],$user_row['user_gender']); ?>" />
فيسبوك	   <input type="text" class="form-control" name="txt_mfb"  value="<?php echo $user_row['user_mfb'];?>" />
تويتر		<input type="text" class="form-control" name="txt_mtw"  value="<?php echo $user_row['user_mtw'];?>" />
جوجل +	   <input type="text" class="form-control" name="txt_mgp"  value="<?php echo $user_row['user_mgp'];?>" />
يوتيوب		<input type="text" class="form-control" name="txt_myo"  value="<?php echo $user_row['user_myo'];?>" />




</div>
<br><br><br>
</div>
	            <div class="clearfix"></div><hr />
            <div class="form-group"><center>
            	<button type="submit" class="btn btn-primary" name="btn-editprofile">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />

        </form>



<br><br><br><br><br>





</ul>

	     </div>
		      </div>

	<?php





	}






if($type == "upgrad"){
$user_to_edit = $user_row['user_id'];
?>

<div class="col-lg-9 form-home">
<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; ترقية عضوية <?php echo $user_row['user_name'];?></font></li>

<?php
$title = "الترقية";



	if(isset($_POST['btn-upgrad']))
	{
	$ugroup = strip_tags($_POST['txt_ugroup']);
	$forum = strip_tags($_POST['txt_forum']);
		try
			{  if($user->upgraduser($ugroup,$forum,$u)){
										?>
										<tr>
											<td class="alert alert-info" colspan="4" width="600"><center>
											  <div class="alert alert-info">تم الترقية بنجاح....
												<br>
												<a href="admin.php?op=users&type=upgrad&u=<?php echo $user_to_edit; ?>">العودة للبروفيل</a>
												<br>
												<a href="admin.php?op=users">العودة لقائمة الأعضاء</a>
											  </div></center></td>
											</tr>
										</table></tr>
										<?php

				}else{
					?>
					<tr>
						<td class="alert alert-danger" colspan="4" width="600"><center>
						  <div class="alert alert-danger">
							هناك خطأ ما
							ربما اخترت منتدى معين مسبقا
								<br>
								<a href="admin.php?op=users&type=upgrad&u=<?php echo $user_to_edit; ?>">العودة للبروفيل</a>
								<br>
								<a href="admin.php?op=users">العودة لقائمة الأعضاء</a>
							  </div></center></td>
						</tr>
					</table></tr>
					<?php
					 }

			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
?>
<form method="post" class="form-home">
<div style="width:100%;">
<br><br><br>
<div class="row form-home"> إختر المجموعة الجديدة للعضو	    &nbsp;  &nbsp;
<?php

			$ug = $user_row['user_group'];
			$estmt = $dbc->runQuery("SELECT * FROM ".prx."ugroups");
			$estmt->execute();
			//$nnn=$estmt->rowCount();

			
echo'<select id="selectbasic" name="txt_ugroup" class="form">';			
echo '<option value="'.$ug.'">'.group_op($ug,'name').'</option>';			

	

			while($ugrow=$estmt->fetch(PDO::FETCH_ASSOC))
			{
				$ugr_l = $ugrow['group_l'];
				$ugr_name = $ugrow['group_name'];
			if($ugr_l != $ug){	
										
						echo '<option value="'.$ugr_l.'">'.$ugr_name.'</option>';
				
			}	
			}
			
echo '</select>';
 ?>
</div>
 <br>
<div class="row form-home">

<?php

echo' <div class="form-group"> إختر الفئة أو المنتدى المعني &nbsp;  &nbsp;
	  
		<select id="selectbasic" name="txt_forum" class="form">';
echo '<option value="0"><h6>جميع المنتديات</h6></option>';
	$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums");
	$stmt->execute();
	// $row=$stmt->fetch(PDO::FETCH_ASSOC);
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	if($row['f_type'] == '0'){
	echo '<option value="'.$row['f_id'].'">***<b>'.$row['f_name'].'</b>***</option>';
	}else{
	echo '<option value="'.$row['f_id'].'">'.$row['f_name'].'</option>';	
	}
	}
	echo '
				</select>
		
		</div>
	
	';
?>	
<hr />
* في حالة تريد  تعيين مشرف فلابد أن تختار منتدى
<br>
* في حالة تريد تعيين نائب أو مراقب فيجب تحديد فئة
<br>
* في حالة المشرف العام أو المراقب العام فهناك إحتمالين
<br>
**1- جعله مشرفا عاما او مراقبا عاما على كل المنتديات وهنا تختر/ كل المنتديات
<br>**2 جعله مشرفا عاما أو مراقبا عاما على فئات محددة بتعيينه فيها كل واحدة على حدى مع الابقاء على المجموعة نفسها



</div>

</div>
	            <div class="clearfix"></div><hr />
            <div class="form-group"><center>
            	<button type="submit" class="btn btn-primary" name="btn-upgrad">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />

        </form>



<br><br><br><br><br>





</ul>

	     </div>
		      </div>

	<?php






























}

if($type == "degrad"){
	
	
	
?>

	<div class="col-lg-9 form-home">
<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; تنحية عضوية <?php echo $user_row['user_name'];?></font></li>

<div style="width:100%;">
<br><br>
        
        <div class="content-loader">
        
        <table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
        
        <th>الاقسام أو المنتديات المعنية</th>
        <th>إزالة</th>
        </tr>
        </thead>
        <tbody>
        <?php
 
        
        $stmt = $dbc->runQuery("select m.mod_id,m.f_id,m.user_id, f.f_id, f.f_name from ".prx."moderators as m left join ".prx."forums as f on (m.f_id = f.f_id) WHERE m.user_id=:u");
$stmt->execute(array(':u'=>$u));
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
		
			<td><?php 
			if($row['f_id'] == 0){
			echo'كل المنتديات';	
			}else{
			echo $row['f_name']; 
			}
			
			?></td>
			<td align="center"><a id="<?php echo $row['mod_id']; ?>" class="delete-link" href="#" title="Delete">
			<img src="admin/delete.png" width="20px" />
            </a></td>
			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
        <br><br><br><br><br><br><br>
	</div></div>
<script type="text/javascript" src="admin/js/crud.js"></script>
<script type="text/javascript" src="admin/js/datatables.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

	$('#example')
	.removeClass( 'display' )
	.addClass('table table-bordered');
});
</script>	
<?php	
}   //endedgrad











}
}
}
?>
